from flask import Flask, request, jsonify
import rasterio
from rasterio.warp import transform
from rasterio.crs import CRS

app = Flask(__name__)

def get_value_from_tif(tif_path, lon, lat):
    try:
        with rasterio.open(tif_path) as src:
            file_crs = src.crs
            if file_crs is None:
                print(f"[WARNING] File {tif_path} tidak punya CRS!")
                file_crs = CRS.from_epsg(4326)  # EPSG:4326 sebagai fallback

            # Proses transformasi koordinat
            x, y = transform(CRS.from_epsg(4326), file_crs, [lon], [lat])
            row, col = src.index(x[0], y[0])

            # Debugging informasi lokasi
            print(f"File: {tif_path}")
            print(f"Bounds: {src.bounds}")
            print(f"CRS: {file_crs}")
            print(f"Coordinate transformed: {x[0]}, {y[0]}")
            print(f"Pixel location: row={row}, col={col}")
            
            if not (0 <= row < src.height and 0 <= col < src.width):
                print("📛 Koordinat di luar raster.")
                return None

            value = src.read(1)[row, col]
            nodata = src.nodata
            if nodata is not None and value == nodata:
                return None
            if value == 255:  # Sering menjadi nilai default untuk NoData
                return None
            return float(value)
    except FileNotFoundError:
        print(f"[ERROR] File {tif_path} tidak ditemukan!")
        return None
    except rasterio.errors.RasterioIOError as e:
        print(f"[ERROR] Kesalahan IO pada file {tif_path}: {str(e)}")
        return None
    except Exception as e:
        print(f"[ERROR] Terjadi kesalahan tak terduga: {str(e)}")
        return None

@app.route('/extract', methods=['GET'])
def extract():
    try:
        # Validasi input lon dan lat
        lon = float(request.args.get('lon'))
        lat = float(request.args.get('lat'))

        if not (-180 <= lon <= 180) or not (-90 <= lat <= 90):
            return jsonify({"error": "Koordinat tidak valid. Longitude harus di antara -180 dan 180, latitude antara -90 dan 90."}), 400

        response = {
            "ndvi": get_value_from_tif("python/geotiff/ndvi_georeferenced.tif", lon, lat),
            "ndwi": get_value_from_tif("python/geotiff/ndwi_georeferenced.tif", lon, lat),
            "dsm": get_value_from_tif("python/geotiff/dsm_georeferenced.tif", lon, lat),  # Perbaikan di sini
            "rainfall": get_value_from_tif("python/geotiff/rainfall_georeferenced.tif", lon, lat)
        }

        print("✔️ Response:", response)
        return jsonify(response)
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
