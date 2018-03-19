<!doctype html>
<html lang="en">
<head>
    <?php 
include('config.php');

$quiz_start = $_GET[quiz_start];
?>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>MAP QUIZ | by GISTNU</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!--  Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.1.0/dist/leaflet.css" integrity="sha512-wcw6ts8Anuw10Mzh9Ytw4pylW8+NAD4ch3lqm9lzAsTxg0GFeJgoAtxuCLREZSC5lUXdVyo/7yfsqFjQ4S+aKw==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js" integrity="sha512-mNqn2Wg7tSToJhvHcqfzLMU6J4mkOImSPTxVZAdo+lcPlk+GhZmYgACEe0x35K7YzW1zJ7XyJV/TT1MrdXvMcA==" crossorigin=""></script>

    
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    <img src="assets/img/logo_gist_black.png" width="90%" alt="">
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="./">
                        <i class="ti-panel"></i>
                        <p><h6>หน้าแรก</h6></p>
                    </a>
                </li>
                <li class="active">
                    <a href="quiz.php">
                        <i class="ti-write"></i>
                        <p><h6>คลังคำถาม</h6></p>
                    </a>
                </li>
                <li>
                    <a href="student.php">
                        <i class="ti-id-badge"></i>
                        <p><h6>รายชื่อนักเรียน</h6></p>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="ti-user"></i>
                        <p><h6>ข้อมูลส่วนตัว</h6></p>
                    </a>
                </li>
                <li>
                    <a href="contect.php">
                        <i class="ti-comments"></i>
                        <p><h6>ติดต่อผู้ดูแล</h6></p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"> MAP QUIZ ONLINE</a>
                </div>
                <div class="collapse navbar-collapse">

                </div>
            </div>
        </nav>
<?php 
    $sql1 = pg_query("select * from quiz_name where quiz_title = '$quiz_start';");
    $object = pg_fetch_array($sql1);
?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><a href="quiz.php" class="btn btn-link " title="">กลับ</a> แบบทดสอบ : <?php echo $object[quiz_title]; ?></h4>
                            </div>
                            <div class="content">
                             </div>
                          </div>
                        </div>
<form action="assets/add_quiz.php" method="get">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="content">
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>หัวข้อคำถาม</label>
                                                <input type="text" class="form-control border-input" placeholder="กรุณาใส่คำถาม" value="" name="quiz_name" required>
                                                <label><small>*ทำเครื่องหมายหน้าข้อที่ถูกต้อง</small></label>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="radio" name="answer" id="1" value="1" checked="" required>
                                                <label for="1">ตัวเลือกที่ 1</label>
                                                <input type="text" class="form-control border-input" placeholder="" value="" name="choice1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="radio" name="answer" value="2" id="2" required>
                                                <label for="2">ตัวเลือกที่ 2</label>
                                                <input type="text" class="form-control border-input" placeholder=" " value="" name="choice2" required>
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="radio" name="answer" value="3" id="3"  required>
                                                <label for="3">ตัวเลือกที่ 3</label>
                                                <input type="text" class="form-control border-input" placeholder="" value="" name="choice3" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="radio" name="answer" value="4" id="4" required
                                                <label for="4">ตัวเลือกที่ 4</label>
                                                <input type="text" class="form-control border-input" placeholder="" value="" name="choice4" required>
                                            </div> <br><br><br>
                                        </div>
                                    <div class="clearfix"></div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="content">
                              
                                <small>การเพิ่มตำแหน่งในแผนที่  พิมพ์ค้นหาสถานที่ --> เลือกจากรายชื่อที่แสดง --> ขยับหมุดไปยังตำแหน่งของคำถาม</small>
                              <br>
                                <input type="text" class="form-control" placeholder="พิมพ์ค้นหาสถานที่หรือตำแหน่งใกล้เคียง ที่นี้" id="mapsearch" style="margin-top: 50px">
                                <div class="container" id="map-canvas" style="height:400px; width: 100%"></div>
                                    <br>
                                    <div> ให้ค่าพิกัดตำแหน่งแสดงก่อนกดบันทึก<br>
                                        Latitude: <input id="lat" name="lat" type="text" value="" required/>
                                        Longitude: <input id="long" name="lon" type="text" value="" required/>
                                    </div>
                                  
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                              
                                    <div class="text-center">
                                        <input type="hidden" value="<?php echo $quiz_start; ?>" name="quiz_title">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">สร้างคำถาม</button>
                                    </div>
                                
                            </div>
                        </div>
                    </div>


 </form>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, Regional Center of Geo-Informatics and Space Technology, Lower Northern Region,
Naresuan University <i class="fa fa-heart heart"></i> <a href="http://www.cgistln.nu.ac.th">GISTNU</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsvL3kPxD7LEvkAVJeRgys314Zcbm2Eqg&v=3.exp&sensor=false&libraries=places"></script>



<script>
                

        
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
                                                  center: {
                                                    lat: 16.745275050351548,
                                                    lng: 100.19087559364016
                                                  },
                                                  zoom: 5
                                                });
                                               
                                           
        
        var searchBox = new google.maps.places.SearchBox(document.getElementById('mapsearch'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('mapsearch'));
        google.maps.event.addListener(searchBox, 'places_changed', function(){
        
    
            searchBox.set('map', null);
            //console.log(searchBox.getPlaces());
            var places = searchBox.getPlaces();
            
            //bounds
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            
            for (i = 0; place = places[i]; i++) {
                (function(place) {
                    var marker = new google.maps.Marker({
                               position: place.geometry.location,
                               draggable: true,
                               title: "Move Your location!!!"

                             });
                             
                             marker.bindTo('map', searchBox, 'map');
                                google.maps.event.addListener(marker, 'dragend', function(event) {
                                document.getElementById("lat").value = event.latLng.lat();
                                document.getElementById("long").value = event.latLng.lng();
                               if (!this.getMap()) {
                                 this.unbindAll();
                               } 
                             });
                            bounds.extend(place.geometry.location);
                            marker.setPosition(place.geometry.location);
                             //google.maps.event.addDomListener(window, "load", initialize());

                }(place));
                

            //console.log(place.geometry.location);
            }
             map.fitBounds(bounds);
             searchBox.set('map', map);
             map.setZoom(Math.min(map.getZoom(),15));
        });
        
</script>
</html>
