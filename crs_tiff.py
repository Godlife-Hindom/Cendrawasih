import rasterio
from rasterio.transform import from_origin
from rasterio.crs import CRS

def fix_geotiff(tif_path, output_path, crs_epsg=4326, top_left_lon=131.0, top_left_lat=-1.0, pixel_size=0.00025):
    with rasterio.open(tif_path) as src:
        data = src.read()
        count = src.count
        dtype = src.dtypes[0]

    transform = from_origin(top_left_lon, top_left_lat, pixel_size, pixel_size)
    
    new_profile = {
        'driver': 'GTiff',
        'height': data.shape[1],
        'width': data.shape[2],
        'count': count,
        'dtype': dtype,
        'crs': CRS.from_epsg(crs_epsg),
        'transform': transform
    }

    with rasterio.open(output_path, 'w', **new_profile) as dst:
        dst.write(data)

# Contoh penggunaan (pakai asumsi koordinat & pixel size, sesuaikan sendiri!):
fix_geotiff('python/geotiff/ndvi.tif', 'python/geotiff/ndvi_fixed1.tif')
fix_geotiff('python/geotiff/ndwi.tif', 'python/geotiff/ndwi_fixed2.tif')
fix_geotiff('python/geotiff/dsm.tif', 'python/geotiff/dsm_fixed3.tif')
fix_geotiff('python/geotiff/rainfall.tif', 'python/geotiff/rainfall_fixed4.tif')
