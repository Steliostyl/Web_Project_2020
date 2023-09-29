let mymap = L.map('map');
let tiles =
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
, {foo: 'bar'});
mymap.addLayer(tiles);
mymap.setView([35.51421970760275, 24.020116986885373], 3);

$.ajax({
    type: "POST",
    url: '../getHeatmapData.php',

    success: function (obj) {
                let maxReq = 0;
                let parsedObj = JSON.parse(obj);
                let reqCount;
                for (let i = 0; i<parsedObj.length; i++){
                    reqCount = parseInt(parsedObj[i]["count"]);
                    if (reqCount > maxReq)
                        maxReq = reqCount;
                }
                let ipData = {
                    max: maxReq/2, data: parsedObj
                };
                createHeatmap(ipData);
            }
});

function createHeatmap(ipData){
    let cfg = {"radius": 40,
        "maxOpacity": 0.8,
        "scaleRadius": false,
        "useLocalExtrema": false,
        latField: 'lat',
        lngField: 'lon',
        valueField: 'count'
    };
    let heatmapLayer = new HeatmapOverlay(cfg);
    mymap.addLayer(heatmapLayer);
    heatmapLayer.setData(ipData);
}