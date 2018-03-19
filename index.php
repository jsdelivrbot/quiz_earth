<!doctype html>
<html lang="en">
<head>
<?php 
include('config.php');
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


<link href="https://fonts.googleapis.com/css?family=Kanit:300" rel="stylesheet">

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
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
                <li class="active">
                    <a href="./">
                        <i class="ti-panel"></i>
                        <p><h6>หน้าแรก</h6></p>
                    </a>
                </li>
                <li>
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
                    <a class="navbar-brand" href="#"> MAP QUIZ ONLINE by GISTNU</a>
                </div>
                <div class="collapse navbar-collapse">

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-6 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="assets/img/faces/face-2.jpg" alt="..."/>
                                  <h4 class="title">นายธีระยุทธ อินทร์จันทร์<br />
                                     <a href="#"><small>@อาจารย์ผู้สอน</small></a>
                                  </h4>
                                </div>
                                <p class="description text-center">
                                    "สถานภูมิภาคเทคโนโลยีอวกาศและภูมิสารสนเทศ <br> มหาวิทยาลัยนเรศวร <br> พิษณุโลก"
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>12<br /><small>แบบทดสอบ</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>47<br /><small>คำถาม</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>25<br /><small>นักเรียน</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                 <div class="col-lg-6 col-md-5">
                    <div class="col-lg-12 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="ti-receipt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>แบบทดสอบ</p>
                                            105GB
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-help-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>คำถาม</p>
                                            $1,345
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-calendar"></i> Last day
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="icon-big icon-danger text-center">
                                            <i class="ti-user"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="numbers">
                                            <p>นักเรียน</p>
                                            23
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> In the last hour
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>


                </div>
                <div class="row">
                    






                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ตำแหน่งคำถามทั้งหมด</h4>
                                <p class="category">รวมทุกแบบทดสอบ</p>
                            </div>
                            <div class="content">
                               <div id="mapid" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h5 class="title">แบบทดสอบ  </h5>
                                                <div id="demo1" class="collapse"> <hr>
                                                <form action="new_quiz.php" method="get" accept-charset="utf-8">
                                                      <input type="text" class="form-control border-input" placeholder="กรุณาใส่ชื่อแบบทดสอบ" value="" name="quiz_headder"> <br>
                                                      <div class="text-center">
                                                         <button type="submit" class="btn btn-success btn-fill">บันทึกการสร้างแบบทดสอบ</button> <hr>
                                                      </div>
                                                </form>

                                                </div>
                               
                            </div>
                            <div class="content">
                                <ul class="list-unstyled team-members">


                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                        DJ Khaled

                                                    </div>

                                                    <div class="col-xs-4 text-right">
                                                        <div class="btn-group">
                                                          <button type="button" class="btn btn-sm  btn-primary btn-fill"   data-toggle="collapse" data-target="#qr1"><i class="fa fa-qrcode"></i></button>
                                                          <button type="button" class="btn  btn-sm btn-primary btn-fill"><i class="fa fa-search"></i></button>
                                                        </div>
                                                      
                                                    </div>
                                                        <div id="qr1" class="collapse">
                                                            <center><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.cgistln.nu.ac.th%2F&choe=UTF-8" title="Link to Google.com" /></center> 
                                                        </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                        DJ Khaled

                                                    </div>

                                                    <div class="col-xs-4 text-right">
                                                        <div class="btn-group">
                                                          <button type="button" class="btn btn-sm  btn-primary btn-fill"   data-toggle="collapse" data-target="#qr2"><i class="fa fa-qrcode"></i></button>
                                                          <button type="button" class="btn  btn-sm btn-primary btn-fill"><i class="fa fa-search"></i></button>
                                                        </div>
                                                      
                                                    </div>
                                                        <div id="qr2" class="collapse">
                                                            <center><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.cgistln.nu.ac.th%2F&choe=UTF-8" title="Link to Google.com" /></center> 
                                                        </div>
                                                </div>
                                            </li>

                                           
                                        </ul>
                            </div>
                        </div>
                    </div>



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


<script>

    var mymap = L.map('mapid').setView([16.749978, 100.194910], 5);

    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(mymap);
<?php 
    $sql1 = pg_query("SELECT * from quiz ;");
  while( $object = pg_fetch_array($sql1) )   {
?>

    L.marker([<?php echo $object[lat],',',$object[lon] ; ?>]).addTo(mymap)
        .bindPopup("<b>หัวข้อ : <?php echo $object[quiz_name]; ?></b><br />1. <?php echo $object[chioce_1]; ?><br>2. <?php echo $object[chioce_2]; ?><br>3. <?php echo $object[chioce_3]; ?><br>4.  <?php echo $object[chioce_4]; ?><br>เฉลย :  <?php echo $object[check_chioce]; ?>");
<?php } ?>

</script>
</html>
