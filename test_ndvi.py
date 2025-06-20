import rasterio
from rasterio.transform import from_bounds
from rasterio.enums import Resampling

# Ubah path ini ke file asli kamu
input_path = "python/geotiff/rainfall.tif"
output_path = "python/geotiff/rainfall_georeferenced.tif"

# Ubah ke extent asli wilayah Fakfak dalam EPSG:4326
left = 131.0
right = 132.5
top = -1.0
bottom = -3.0

with rasterio.open(input_path) as src:
    data = src.read()
    count = src.count
    height = src.height
    width = src.width
    dtype = src.dtypes[0]

    transform = from_bounds(left, bottom, right, top, width, height)

    profile = src.profile
    profile.update({
        'crs': 'EPSG:4326',
        'transform': transform,
        'height': height,
        'width': width,
        'count': count,
        'driver': 'GTiff',
        'dtype': dtype
    })

    with rasterio.open(output_path, 'w', **profile) as dst:
        dst.write(data)
