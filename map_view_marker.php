
<!DOCTYPE html>
<html>
<head><?php 
include('config.php');
$id_quiz = $_GET[id_quiz];
?>
	<title>Quick Start - Leaflet</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>


	
</head>
<body>



<div id="mapid" style="width: 100%; height: 320px;"></div>
<script>

<?php 
	$sql1 = pg_query("SELECT * from quiz where id_quiz = '$id_quiz';");
	$object = pg_fetch_array($sql1);
?>

	var mymap = L.map('mapid').setView([<?php echo $object[lat],',',$object[lon] ; ?>], 15);

	 L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(mymap);




	L.marker([<?php echo $object[lat],',',$object[lon] ; ?>]).addTo(mymap)
		.bindPopup("<b>หัวข้อ : <?php echo $object[quiz_name]; ?></b><br />1. <?php echo $object[chioce_1]; ?><br>2. <?php echo $object[chioce_2]; ?><br>3. <?php echo $object[chioce_3]; ?><br>4. 	<?php echo $object[chioce_4]; ?><br>เฉลย :	<?php echo $object[check_chioce]; ?>").openPopup();





	var popup = L.popup();


</script>



</body>
</html>
