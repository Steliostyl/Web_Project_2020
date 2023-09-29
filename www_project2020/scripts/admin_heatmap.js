let mymap = L.map('map');
let tiles =
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
        , { foo: 'bar' });
mymap.addLayer(tiles);
mymap.setView([35.51421970760275, 24.020116986885373], 3);

function getPointID(point, points_array) {
    for (let i = 0; i < points_array.length; i++) {
        if (point.lat == points_array[i].lat && point.lon == points_array[i].lon) return i;
    }
    points_array.push(point);
    return points_array.length;
}

function createFlowMap(initialObject) {
    var features_array = [];
    let unique_origin_points = []
    let unique_dest_points = []

    for (let i = 1; i < Object.keys(initialObject).length; i++) {
        let origin_lon = initialObject[i]['origin_lon']
        let origin_lat = initialObject[i]['origin_lat']
        let destination_lon = initialObject[i]['destination_lon']
        let destination_lat = initialObject[i]['destination_lat']

        // Disregard null data
        if (origin_lon === null || origin_lat === null || destination_lon === null || destination_lat === null) {
            // console.log("Found null on line " + i)
            // console.log(initialObject[i])
            continue;
        }

        let destination_id = getPointID({ "lat": destination_lat, "lon": destination_lon }, unique_dest_points);
        let origin_id = getPointID({ "lat": destination_lat, "lon": destination_lon }, unique_origin_points);

        let geoJSONpoint = {
            "type": "Feature",
            "properties": {
                "origin_id": origin_id,
                "origin_lon": origin_lon,
                "origin_lat": origin_lat,
                "destination_id": destination_id,
                "destination_lon": destination_lon,
                "destination_lat": destination_lat
            },
            "geometry": {
                "type": "Point",
                "coordinates": [origin_lon, origin_lat]
            }
        }
        features_array.push(geoJSONpoint);
    }

    var featureCollection = {
        type: 'geojson',
        features: features_array
    };

    // Add flowmap layer to map
    L.canvasFlowmapLayer(featureCollection).addTo(mymap);
}

$.ajax({
    type: "POST",
    url: '../admin_getHeatmapData.php',

    success: function (obj) {
        createFlowMap(JSON.parse(obj));
    }
});