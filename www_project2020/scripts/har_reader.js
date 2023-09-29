var JsonObj = null 
var entries = [];
var ipGeolocationTable = [];
var file;
var userGeo = null;
var userISP = null;

class Entry{
    // Class constructor
    constructor(startedDateTime, serverIPAddress, wait, method, url, status, statusText, content_type, cache_control,
                pragma, expires, age, last_modified, host, userISP, userGeolocation){
        this.startedDateTime = startedDateTime;
        this.serverIPAddress = serverIPAddress;
        this.wait = wait;
        this.method = method;
        this.url = url;
        this.status = status;
        this.statusText = statusText;
        this.content_type = content_type;
        this.cache_control = cache_control;
        this.pragma = pragma;
        this.expires = expires;
        this.age = age;
        this.last_modified = last_modified;
        this.host = host;
        this.serverIPgeolocation = null;
        this.userISP = userISP;
        this.userGeolocation = userGeolocation;
    }
    setIPgeo(geolocation){
        this.serverIPgeolocation = geolocation;
    }
}

// A class that stores unique IPs and their geolocations
// as well as the positions they appear on the entry table
class IPGeolocation{
    constructor(ipAddress){
        this.ipAddress = ipAddress;
        this.geolocation = null;
        this.entryIndexes = [];
    }
    // Methods
    addEntryIndex(entryIndex){
        this.entryIndexes.push(entryIndex);
    }
    setGeolocation(geoloc){
        this.geolocation = geoloc;
        //console.log("Updating geolocation for entries with IP: ", this.ipAddress);
        for (i=0 ; i<this.entryIndexes.length ; i++) {
            entries[this.entryIndexes[i]].setIPgeo(geoloc);
        }
    }
}

function createEntriesFile(){
    file = new Blob([JSON.stringify(entries, null, 2)], {type: "text/json"});
    a = document.createElement("a"),url = URL.createObjectURL(file);
    a.href = url;
    a.download = "HarFile.har";

    console.log("Entries Table:");
    for (i=0;i<entries.length;i++)
      console.log(entries[i]);
}

function getIPGeolocationObject(ip){
    for (i=0 ; i<ipGeolocationTable.length; i++){
        if(ip == ipGeolocationTable[i].ipAddress)
            return ipGeolocationTable[i];
    }
    return null;
}

function getGeolocations(start){
    // Get the first 100 values of ipGeolocationTable 
    // and remove them from that table
    let newGeoTable = ipGeolocationTable.slice(start,start+100);
    // Get the addresses from the spliced table's objects
    let IPs = newGeoTable.map(geoObj => geoObj.ipAddress);
    //console.log(newGeoTable);
    var endpoint = 'http://ip-api.com/batch?fields=lat,lon';
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Result array
            var response = JSON.parse(this.responseText);
            //console.log(response);
            response.forEach(function (item, index) {
                let geo = 'POINT(' + item.lat + ' ' + item.lon + ')';
                //console.log(geo);
                
                // If our IPs are more than 100, after the first time 
                // we use splice, our index will be in the wrong range,
                // so we have to use % 100 to normalize our values in 
                // the 0 - 100 range
                newGeoTable[index%100].setGeolocation(geo);
            });
            // Finisihed setting all geolocations
            if (start>=ipGeolocationTable.length-100){
                createEntriesFile();
            }
        }
    };
    var data = JSON.stringify(IPs);

    xhr.open('POST', endpoint, true);
    xhr.send(data);
}

// Function to download data to a file
function download() {
    var filename = "HarFile.json";
    //var file = new Blob([JSON.stringify(entries, null, 2)], {type: type});
    if (window.navigator.msSaveOrOpenBlob) // IE10+
        window.navigator.msSaveOrOpenBlob(file, filename);
    else { // Others
        var a = document.createElement("a"),url = URL.createObjectURL(file);
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        setTimeout(function() {
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);  
        }, 0); 
    }
}

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    f = files[0];
    var reader = new FileReader();

    reader.onload = (function(theFile) {
        return function(e) {
            JsonObj = JSON.parse(e.target.result);
            var content_type=null,cache_control=null,pragma=null,expires=null,age=null,last_modified=null,host = null,url = null,serverIPAddress = null;

            for(let i=0; i<JsonObj["log"].entries.length; i++){
                for(let j=0;j<JsonObj["log"].entries[i].response.headers.length;j++){
                    if(JsonObj["log"].entries[i].response.headers[j].name==="content-type")
                        content_type = JsonObj["log"].entries[i].response.headers[j].value;
                    else if(JsonObj["log"].entries[i].response.headers[j].name==="cache-control")
                        cache_control = JsonObj["log"].entries[i].response.headers[j].value;
                    else if(JsonObj["log"].entries[i].response.headers[j].name==="pragma")
                        pragma = JsonObj["log"].entries[i].response.headers[j].value;
                    else if(JsonObj["log"].entries[i].response.headers[j].name==="expires")
                        expires = JsonObj["log"].entries[i].response.headers[j].value;
                    else if(JsonObj["log"].entries[i].response.headers[j].name==="age")
                        age = JsonObj["log"].entries[i].response.headers[j].value;
                    else if(JsonObj["log"].entries[i].response.headers[j].name==="last-modified")
                        last_modified = JsonObj["log"].entries[i].response.headers[j].value;
                }
                host = null;
                let k=0;
                while(host==null && k<JsonObj["log"].entries[i].request.headers.length){
                    if(JsonObj["log"].entries[i].request.headers[k].name==="Host")
                        host=JsonObj["log"].entries[i].request.headers[k].value;
                    k++;
                }
                startedDateTime = JsonObj["log"].entries[i].startedDateTime;

                if(JsonObj["log"].entries[i].request.url!=null){
                    url = JsonObj["log"].entries[i].request.url.replace('http://','').replace('https://','').split(/[/?#]/)[0];
                }
                if(JsonObj["log"].entries[i].serverIPAddress!=null)
                    serverIPAddress = JsonObj["log"].entries[i].serverIPAddress.replace('[','').replace(']','');
                else if(JsonObj["log"].entries[i].response.serverIPAddress!=null)
                    serverIPAddress = JsonObj["log"].entries[i].response.serverIPAddress.replace('[','').replace(']','');
                if(serverIPAddress!=null && serverIPAddress!="" && serverIPAddress!=" "){
                    IPgeoObject = getIPGeolocationObject(serverIPAddress);
                    if( IPgeoObject == null){
                        IPgeoObject = new IPGeolocation(serverIPAddress);
                        ipGeolocationTable.push(IPgeoObject);
                    }
                    IPgeoObject.addEntryIndex(i);
                }

                entries[i] = new Entry(
                    JsonObj["log"].entries[i].startedDateTime,
                    serverIPAddress,
                    JsonObj["log"].entries[i].timings.wait,
                    JsonObj["log"].entries[i].request.method,
                    url,
                    JsonObj["log"].entries[i].response.status,
                    JsonObj["log"].entries[i].response.statusText,
                    content_type,
                    cache_control,
                    pragma,
                    expires,
                    age,
                    last_modified,
                    host,
                    userISP,
                    userGeo
                )
            }

            // Find geolocation for every (unique) IP in the ipGeo table
            for(let j=0;j<ipGeolocationTable.length;j+=100)
                getGeolocations(j);
      };
    })(f);
    // Read the  file as Text.
    reader.readAsText(f);
}

// Ajax function
$("#upload").live("click",function(){
    var data = new FormData();
    data.append('file', file);
    $.ajax({
        type:"POST",  
        url:"upload.php",
        data: data,
        contentType: false,
        processData: false,
        success:function(data){  
            alert(data);
        }
    });
});


document.getElementById('inputfile').addEventListener('change', handleFileSelect, false); 
document.getElementById('download').addEventListener('click', download, false); 
request = $.getJSON('http://ip-api.com/json?callback=?', function(ipData) {
    //console.log(JSON.stringify(ipData, null, 2));
    userISP = ipData["isp"];
    userGeo = 'POINT(' + ipData['lat'] + ' ' + ipData['lon'] + ')';
    //console.log(userGeo);
});
//getIPaddressesLocation("8.8.8.8");