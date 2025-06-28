from flask import Flask, request, jsonify, redirect
from flask_cors import CORS
import ee
import json

app = Flask(__name__)
CORS(app)

# Inisialisasi Earth Engine
service_account = 'earthengine-service@ee-godlife.iam.gserviceaccount.com'
key_file = '/var/www/Cendrawasih/python/ee-godlife-46d35f9d9fcd.json'
credentials = ee.ServiceAccountCredentials(service_account, key_file)
ee.Initialize(credentials)

# Cek apakah titik ada di daratan
def is_land(lat, lon):
    try:
        point = ee.Geometry.Point([lon, lat])
        land = ee.FeatureCollection("USDOS/LSIB_SIMPLE/2017")
        return land.filterBounds(point).size().getInfo() > 0
    except Exception as e:
        print(f"Error checking land: {e}")
        return False

# Cek apakah titik berada di lingkungan alami (bukan bangunan/jalan)
def is_natural_environment(lat, lon):
    try:
        point = ee.Geometry.Point([lon, lat])
        
        # Dynamic World untuk label
        dw_collection = ee.ImageCollection("GOOGLE/DYNAMICWORLD/V1") \
            .filterBounds(point) \
            .filterDate('2024-01-01', '2024-12-31') \
            .select('label')

        if dw_collection.size().getInfo() == 0:
            print("Tidak ada data Dynamic World")
            return False

        mode_image = dw_collection.reduce(ee.Reducer.mode())
        sampled = mode_image.sample(region=point, scale=10).first()
        if sampled is None:
            print("Sampling Dynamic World gagal")
            return False

        label = sampled.get("label_mode").getInfo()
        print(f"Label DW: {label}")

        built_labels = ["built area", "bare", "water"]
        if label in built_labels:
            print("Titik berada di area buatan dari Dynamic World")
            return False

        # Tambahan pengecekan NDVI dari Landsat
        landsat = ee.ImageCollection('LANDSAT/LC08/C02/T1_L2') \
            .filterDate('2024-01-01', '2024-12-31') \
            .filterBounds(point) \
            .filter(ee.Filter.lt('CLOUD_COVER', 60)) \
            .map(lambda img: img.updateMask(img.select('QA_PIXEL').bitwiseAnd(1 << 3).eq(0)))

        if landsat.size().getInfo() == 0:
            print("Tidak ada citra Landsat")
            return False

        median = landsat.median()
        sr_b5 = median.select('SR_B5').multiply(0.0000275).add(-0.2)
        sr_b4 = median.select('SR_B4').multiply(0.0000275).add(-0.2)
        ndvi = sr_b5.subtract(sr_b4).divide(sr_b5.add(sr_b4)).rename('NDVI')
        
        sample = ndvi.sample(region=point, scale=30).first()
        if sample is None:
            print("NDVI tidak bisa disampling")
            return False

        ndvi_value = sample.get('NDVI').getInfo()
        print(f"NDVI value: {ndvi_value}")

        # NDVI rendah artinya bukan vegetasi
        if ndvi_value is None or ndvi_value < 0.1:
            print("NDVI terlalu rendah, kemungkinan besar buatan manusia")
            return False

        return True

    except Exception as e:
        print(f"Error checking natural environment: {e}")
        return False

# Sampling GEE
def sample_gee_value(image, band, point, scale):
    try:
        img = image.select(band)
        sample = img.sample(region=point, scale=scale).first()
        if sample is None:
            return None
        val = sample.get(band)
        return val.getInfo() if val is not None else None
    except Exception as e:
        print(f"Error sampling band {band}: {e}")
        return None

# NDVI dari Landsat 8
def get_landsat_ndvi(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    collection = ee.ImageCollection('LANDSAT/LC08/C02/T1_L2') \
        .filterDate('2024-01-01', '2024-12-31') \
        .filterBounds(point) \
        .filter(ee.Filter.lt('CLOUD_COVER', 60)) \
        .map(lambda image: image.updateMask(image.select('QA_PIXEL').bitwiseAnd(1 << 3).eq(0)))

    if collection.size().getInfo() == 0:
        return None

    median = collection.median()
    sr_b5 = median.select('SR_B5').multiply(0.0000275).add(-0.2)
    sr_b4 = median.select('SR_B4').multiply(0.0000275).add(-0.2)
    ndvi = sr_b5.subtract(sr_b4).divide(sr_b5.add(sr_b4)).rename('NDVI')

    val = sample_gee_value(ndvi, 'NDVI', point, scale=30)
    return round(val, 4) if val is not None else None

# NDWI
def get_ndwi(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    collection = ee.ImageCollection('LANDSAT/LC08/C02/T1_L2') \
        .filterDate('2024-01-01', '2024-12-31') \
        .filterBounds(point) \
        .sort('system:time_start')

    if collection.size().getInfo() == 0:
        return None

    image = collection.first()
    ndwi_img = image.normalizedDifference(['SR_B3', 'SR_B5']).rename('NDWI')
    val = sample_gee_value(ndwi_img, 'NDWI', point, scale=30)
    return round(val, 4) if val is not None else None

# DSM (elevasi)
def get_dsm(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    image = ee.Image("USGS/SRTMGL1_003")
    val = sample_gee_value(image, 'elevation', point, scale=30)
    return round(val, 2) if val is not None else None

# Curah hujan
def get_rainfall(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    collection = ee.ImageCollection("UCSB-CHG/CHIRPS/DAILY") \
        .filterDate('2024-01-01', '2024-12-31') \
        .filterBounds(point)

    if collection.size().getInfo() == 0:
        return None

    image = collection.mean()
    val = sample_gee_value(image, 'precipitation', point, scale=5000)
    return round(val, 2) if val is not None else None

# Endpoint root
@app.route('/')
def index():
    return jsonify({'message': 'Flask API for SPK Cendrawasih is running.'})

# Endpoint utama
@app.route('/extract', methods=['GET'])
def extract():
    try:
        lat = float(request.args.get('lat'))
        lon = float(request.args.get('lng'))

        if not (-90 <= lat <= 90) or not (-180 <= lon <= 180):
            return jsonify({'error': 'Koordinat tidak valid.'}), 400

        if not is_land(lat, lon):
            return jsonify({'error': 'Titik berada di laut. Tidak ada data lingkungan.'}), 400

        if not is_natural_environment(lat, lon):
            return jsonify({'error': 'Titik berada di area buatan atau tidak ada lingkungan alami.'}), 400

        response = {
            'ndvi': get_landsat_ndvi(lat, lon),
            'ndwi': get_ndwi(lat, lon),
            'dsm': get_dsm(lat, lon),
            'rainfall': get_rainfall(lat, lon)
        }

        return jsonify(response)

    except Exception as e:
        print(f"Error in /extract: {e}")
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
