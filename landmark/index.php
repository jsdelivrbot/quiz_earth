<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
      <?php
include('../config.php');

session_start();
$strpg = "SELECT * FROM user_id  WHERE email_user = '".$_SESSION['email_user']."' ";
    $objQuery = pg_query($db,$strpg);
    $objResult = pg_fetch_array($objQuery);

    $status = $objResult[status_user];

    $id = $_GET[user];
    $id_activities = $_GET[id_activities];
    $idproject = $_GET[idproject];


    if($_SESSION['email_user'] == "")
    {
        header('Location: ../login.html');
        exit();
    }

    else if($status != "user")
    {
        header('Location: ../login.html');
        exit();
    }

$id_project = $_GET[id_activities];

?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="assets/img/Network.png">


    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>army_plan</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script src="bower_components/Leaflet.draw/docs/examples/libs/leaflet-src.js"></script>
    <link rel="stylesheet" href="bower_components/Leaflet.draw/docs/examples/libs/leaflet.css" />

    <script src="bower_components/Leaflet.draw/src/Leaflet.draw.js"></script>
    <script src="bower_components/Leaflet.draw/src/Leaflet.Draw.Event.js"></script>
    <link rel="stylesheet" href="bower_components/Leaflet.draw/src/leaflet.draw.css" />

    <script src="bower_components/Leaflet.draw/src/Toolbar.js"></script>
    <script src="bower_components/Leaflet.draw/src/Tooltip.js"></script>

    <script src="bower_components/Leaflet.draw/src/ext/GeometryUtil.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/LatLngUtil.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/LineUtil.Intersect.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/Polygon.Intersect.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/Polyline.Intersect.js"></script>
    <script src="bower_components/Leaflet.draw/src/ext/TouchEvents.js"></script>

    <script src="bower_components/Leaflet.draw/src/draw/DrawToolbar.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Feature.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.SimpleShape.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Polyline.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Marker.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.CircleMarker.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Circle.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Polygon.js"></script>
    <script src="bower_components/Leaflet.draw/src/draw/handler/Draw.Rectangle.js"></script>

    <script src="bower_components/Leaflet.draw/src/edit/EditToolbar.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/EditToolbar.Edit.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/EditToolbar.Delete.js"></script>

    <script src="bower_components/Leaflet.draw/src/Control.Draw.js"></script>

    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Poly.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.SimpleShape.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Marker.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.CircleMarker.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Circle.js"></script>
    <script src="bower_components/Leaflet.draw/src/edit/handler/Edit.Rectangle.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="http://calvinmetcalf.github.io/leaflet-ajax/dist/leaflet.ajax.js"></script>
   

    <script src="../assets/leaflet_auto/src/js/leaflet-gplaces-autocomplete.js"></script>
    <link rel="stylesheet" href="../assets/leaflet_auto/src/css/leaflet-gplaces-autocomplete.css" />

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB987YluH4TMaazSj-q7b4nwypClnjQIbE&libraries=places"></script>

</head>

<body>



    <div class="content-wrapper">
        
          

                
                    <div class="map" id="map"></div>
               

           

        
        <!-- MENU SECTION END-->





    </div>


    <script src="assets/js/bootstrap.js"></script>



</body>
<script>
    

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
    center: new L.LatLng(12.565011, 101.244529),
    zoom: 6
});

var polygonLayer = new L.GeoJSON.AJAX("http://www2.cgistln.nu.ac.th/budgetview/landmark/geojson.php?type=polygon&idproject=<?php echo $idproject; ?>&idavtivities=<?php echo $id_activities; ?>",{ 
    onEachFeature: onEachFeature
}).addTo(map);

var lineLayer = new L.GeoJSON.AJAX("http://www2.cgistln.nu.ac.th/budgetview/landmark/geojson.php?type=polyline&idproject=<?php echo $idproject; ?>&idavtivities=<?php echo $id_activities; ?>",{ 
    onEachFeature: onEachFeature
}).addTo(map);

var markerLayer = new L.GeoJSON.AJAX("http://www2.cgistln.nu.ac.th/budgetview/landmark/geojson.php?type=marker&idproject=<?php echo $idproject; ?>&idavtivities=<?php echo $id_activities; ?>",{ 
    onEachFeature: onEachFeature
}).addTo(map);

function onEachFeature(feature, layer) {   
        var popupContent = '<table class="table"><tbody><tr><td>ชื่อโครงการ  </td><td>'+feature.properties.f3+'</td></tr><tr><td>กลุ่มโครงการ </td><td>'+feature.properties.f4+'</td></tr><tr><td>ห่วงโซ่คุณค่า  </td><td>'+feature.properties.f5+'</td></tr></tbody></table>' ;
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





            new L.Control.GPlaceAutocomplete({
                callback: function(place){
                    var loc = place.geometry.location;
                    map.panTo([loc.lat(), loc.lng()]);
                    map.setZoom(14);
                }
            }).addTo(map);






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
        idactivities: <?php echo $id_activities; ?>,
        idproject: <?php echo $idproject; ?>,
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
        var name_t = layer.toGeoJSON().properties.f1;
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
        var name_t = layer.toGeoJSON().properties.f1;
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

</script>


</html>