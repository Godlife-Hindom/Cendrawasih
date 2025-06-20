from flask import Flask, request, jsonify
import ee

app = Flask(__name__)

# Inisialisasi Earth Engine
ee.Initialize(project='ee-godlife')  # Ganti dengan project kamu jika perlu

# Fungsi untuk sampling nilai dari gambar Earth Engine
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

def get_landsat_ndvi(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    
    # Pilih koleksi Landsat 8/9 Level 2 Tier 1
    collection = ee.ImageCollection('LANDSAT/LC08/C02/T1_L2') \
        .filterDate('2024-01-01', '2024-12-31') \
        .filterBounds(point) \
        .filter(ee.Filter.lt('CLOUD_COVER', 20)) \
        .map(lambda img: img.updateMask(img.select('QA_PIXEL').bitwiseAnd(1 << 3).eq(0)))  # Mask awan (optional)
    
    if collection.size().getInfo() == 0:
        return None

    # Ambil citra pertama (paling awal)
    image = collection.first()

    # Konversi DN ke reflectance (skala 0.0–1.0)
    image = image.multiply(0.0000275).add(-0.2)

    # Hitung NDVI = (NIR - RED) / (NIR + RED)
    ndvi = image.normalizedDifference(['SR_B5', 'SR_B4']).rename('NDVI')

    val = sample_gee_value(ndvi, 'NDVI', point, scale=30)
    if val is not None:
        return round(val, 4)  # NDVI sudah dalam skala -1.0 hingga 1.0
    return None


# NDWI dari Landsat 8
def get_ndwi(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    collection = ee.ImageCollection('LANDSAT/LC08/C02/T1_L2') \
        .filterDate('2024-01-01', '2024-12-31') \
        .filterBounds(point) \
        .sort('system:time_start')

    if collection.size().getInfo() == 0:
        return None

    image = collection.first()

    try:
        # Hitung NDWI = (Green - NIR) / (Green + NIR)
        ndwi_img = image.normalizedDifference(['SR_B3', 'SR_B5']).rename('NDWI')
        sample = ndwi_img.sample(region=point, scale=30).first()
        if sample is None:
            return None
        val = sample.get('NDWI').getInfo()
        return round(val, 4)
    except Exception as e:
        print(f"Error calculating NDWI: {e}")
        return None

# DSM dari SRTM
def get_dsm(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    image = ee.Image("USGS/SRTMGL1_003")
    val = sample_gee_value(image, 'elevation', point, scale=30)
    if val is not None:
        return round(val, 2)
    return None

# Rainfall dari CHIRPS
def get_rainfall(lat, lon):
    point = ee.Geometry.Point([lon, lat])
    collection = ee.ImageCollection("UCSB-CHG/CHIRPS/DAILY") \
        .filterDate('2024-01-01', '2024-12-31') \
        .filterBounds(point)

    if collection.size().getInfo() == 0:
        return None

    image = collection.mean()
    val = sample_gee_value(image, 'precipitation', point, scale=5000)
    if val is not None:
        return round(val, 2)
    return None

# Endpoint utama API
@app.route('/extract', methods=['GET'])
def extract():
    try:
        lat = float(request.args.get('lat'))
        lon = float(request.args.get('lon'))

        # Validasi input koordinat
        if not (-90 <= lat <= 90) or not (-180 <= lon <= 180):
            return jsonify({'error': 'Koordinat tidak valid.'}), 400

        response = {
            'ndvi': get_landsat_ndvi(lat, lon),
            'ndwi': get_ndwi(lat, lon),
            'dsm': get_dsm(lat, lon),
            'rainfall': get_rainfall(lat, lon)
        }

        return jsonify(response)

    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
