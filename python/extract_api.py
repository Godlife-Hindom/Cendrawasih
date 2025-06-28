from flask import Flask, request, jsonify
from flask_cors import CORS
import ee
import json

app = Flask(__name__)
CORS(app)  # ← penting agar bisa diakses dari Laravel

# Inisialisasi Earth Engine dengan Service Account
service_account = 'earthengine-service@ee-godlife.iam.gserviceaccount.com'  # Ganti dengan email SA kamu
key_file = '/var/www/Cendrawasih/python/ee-godlife-46d35f9d9fcd.json'        # Pastikan path benar
credentials = ee.ServiceAccountCredentials(service_account, key_file)
ee.Initialize(credentials)

# Cek apakah titik ada di daratan (gunakan batas negara)
def is_land(lat, lon):
    try:
        point = ee.Geometry.Point([lon, lat])
        land = ee.FeatureCollection("USDOS/LSIB_SIMPLE/2017")
        return land.filterBounds(point).size().getInfo() > 0
    except Exception as e:
        print(f"Error checking land: {e}")
        return False

# Fungsi sampling nilai pixel
def sample_gee_value(image, band, point, scale):
    try:
        img = image.select(band)
        sample = img.sample(region=point, scale=scale).first()
        if sample is None:
            return None
        val = sample.get(band)
        if val is None:
            return None
        return val.getInfo()
    except Exception as e:
        print(f"Error sampling band {band}: {e}")
        return None

# ✅ Perbaikan utama untuk NDVI
def get_landsat_ndvi(lat, lon):
    point = ee.Geometry.Point([lon, lat])

    collection = ee.ImageCollection('LANDSAT/LC08/C02/T1_L2') \
        .filterDate('2024-01-01', '2024-12-31') \
        .filterBounds(point) \
        .filter(ee.Filter.lt('CLOUD_COVER', 60)) \
        .map(lambda image: image.updateMask(image.select('QA_PIXEL').bitwiseAnd(1 << 3).eq(0)))  # Mask cloud

    size = collection.size().getInfo()
    if size == 0:
        print(f"Tidak ada citra Landsat valid di lokasi lat={lat}, lon={lon}")
        return None

    # Ambil komposit median
    median = collection.median()

    sr_b5 = median.select('SR_B5').multiply(0.0000275).add(-0.2)
    sr_b4 = median.select('SR_B4').multiply(0.0000275).add(-0.2)
    ndvi = sr_b5.subtract(sr_b4).divide(sr_b5.add(sr_b4)).rename('NDVI')

    val = sample_gee_value(ndvi, 'NDVI', point, scale=30)
    return round(val, 4) if val is not None else None

# NDWI (tanpa kalibrasi karena rasio)
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

# DSM dari SRTM
def get_dsm(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    image = ee.Image("USGS/SRTMGL1_003")
    val = sample_gee_value(image, 'elevation', point, scale=30)
    return round(val, 2) if val is not None else None

# Curah hujan dari CHIRPS
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
