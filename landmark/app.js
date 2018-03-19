

var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    osm = L.tileLayer(osmUrl, {
        maxZoom: 18,
        attribution: osmAttrib
    });

//create overlayers from wms
var prov = L.tileLayer.wms("http://cgi.uru.ac.th/gs-gb/ows?", {
    layers: 'nan:site_province',
    format: 'image/png',
    transparent: true,
    attribution: 'map by <a href="http://cgi.uru.ac.th">cgi</a>'
});

var amp = L.tileLayer.wms("http://cgi.uru.ac.th/gs-gb/ows?", {
    layers: 'nan:site_amphoe',
    format: 'image/png',
    transparent: true,
    attribution: 'map by <a href="http://cgi.uru.ac.th">cgi</a>'
});

var tam = L.tileLayer.wms("http://cgi.uru.ac.th/gs-gb/ows?", {
    layers: 'nan:site_tambon',
    format: 'image/png',
    transparent: true,
    attribution: 'map by <a href="http://cgi.uru.ac.th">cgi</a>'
});

//create geoJsonLayer
// var geoJsonLayer = L.geoJson(null, {
//     pmIgnore: false
// });

var map = new L.Map('map', {
    center: new L.LatLng(14.195586, 101.562189),
    zoom: 6
});

var polygonLayer = new L.GeoJSON.AJAX("http://localhost:8888/budgetview/landmark/geojson.php?type=polygon",{ 
    onEachFeature: onEachFeature
}).addTo(map);

var lineLayer = new L.GeoJSON.AJAX("http://localhost:8888/budgetview/landmark/geojson.php?type=polyline",{ 
    onEachFeature: onEachFeature
}).addTo(map);

var markerLayer = new L.GeoJSON.AJAX("http://localhost:8888/budgetview/landmark/geojson.php?type=marker",{ 
    onEachFeature: onEachFeature
}).addTo(map);

function onEachFeature(feature, layer) {   
        var popupContent = '<form role="form" id="form" class="form" enctype="multipart/form-data">'+
            'name: <input type="text" id="name_t" value = "'+feature.properties.name_t+'"><br>'+
            'desc: <input type="text" id="desc_t" value = "'+feature.properties.desc_t+'"><br>'+
            'type: <input type="text" id="type_g"  value = "'+feature.properties.type_g+'"><br>'+
            '<button type="submit">Submit</button>'+
            '</form>' ;
          layer.bindPopup(popupContent);
  };  

L.control.layers({
    'osm': osm.addTo(map),
    "google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
        attribution: 'google'
    })
}, {
    'ขอบเขตจังหวัด': prov,
    'ขอบเขตอำเภอ': amp,
    'ขอบเขตตำบล': tam,
    'polygonLayer': polygonLayer,
    'lineLayer': lineLayer,
    'markerLayer': markerLayer,
}).addTo(map);

var opt1 = {
    edit: {
        featureGroup: polygonLayer,
        poly: {
            allowIntersection: false,
        }
    },
    draw: {
        polygon: {
            allowIntersection: false,
            showArea: true
        },
        rectangle:false,
        polyline:false,
        circle:false,
        marker:false,        
        circlemarker:false
    }
}

var opt2 = {
    edit: {
        featureGroup: lineLayer,        
    },
    draw: {
        polygon:false,
        rectangle:false,
        polyline:{
            allowIntersection: false
        },
        circle:false,
        marker:false,        
        circlemarker:false
    }
}

var opt3 = {
    edit: {
        featureGroup: markerLayer,        
    },
    draw: {
        polygon:false,
        rectangle:false,
        polyline:false,
        circle:false,
        marker:true,        
        circlemarker:false
    }
}

map.addControl(new L.Control.Draw(opt1));
map.addControl(new L.Control.Draw(opt2));
map.addControl(new L.Control.Draw(opt3));




//map.on(L.Draw.Event.CREATED, function (e) {
map.on('draw:created', function (e) {
    var currentdate = new Date();
    var datetime = "ID" + currentdate.getDate() + "-" +
        (currentdate.getMonth() + 1) + "-" +
        currentdate.getFullYear() + "-" +
        currentdate.getHours() + "-" +
        currentdate.getMinutes() + "-" +
        currentdate.getSeconds();

    var layers = e.layer;
    

    var geom = (JSON.stringify(layers.toGeoJSON().geometry));
    console.log(layers);

    $.post("insert.php", {
        name_t: datetime,
        geom: geom,
        layerType: e.layerType
    }, function (data, status) {
        console.log(data);
        polygonLayer.refresh();
        lineLayer.refresh();
        markerLayer.refresh();
    });

});

map.on('draw:edited', function (e) {
    var layers = e.layers;
    //console.log(layers)
    layers.eachLayer(function (layer) {
        var name_t = layer.toGeoJSON().properties.name_t;
        var geom = (JSON.stringify(layer.toGeoJSON().geometry));
        $.post("update.php", {
            name_t: name_t,
            geom: geom
        }, function (data, status) {
            console.log(data);
        });
    });
});

map.on("draw:deleted", function(e) {
    
    var layers = e.layers;
    layers.eachLayer(function (layer) {
        var name_t = layer.toGeoJSON().properties.name_t;
        $.post("delete.php", {
            name_t: name_t
        }, function (data, status) {
            console.log(data);
        });
    });
});




function onClick_home () {
    map.setView([51.5, -0.09], 14);
}

var polylineDrawer = new L.Draw.polyline(map, this.opt2.polyline);

var polygonDrawer = new L.Draw.Polygon(map, this.opt1.polygon);

var markerDrawer =  new L.Draw.Marker(map, this.opt3.marker);



$('#draw_line').click(function() {
    polylineDrawer.enable();
});
$('#draw_polygon').click(function() {
    polygonDrawer.enable();
});
$('#draw_marker').click(function() {
    markerDrawer.enable();
});
