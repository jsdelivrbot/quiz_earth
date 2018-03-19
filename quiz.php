<!doctype html>
<html lang="en">
<head>
<?php 
include('config.php');
$quiz_title = $_GET[quiz_title];
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
                    <a class="navbar-brand" href="#"> MAP QUIZ ONLINE by GISTNU</a>
                </div>
                <div class="collapse navbar-collapse">

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-4 col-md-5">
                        <div class="card">
                            <div class="header">
                                <h5 class="title">ชุดแบบทดสอบ  <a class="btn btn-danger" title="" data-toggle="collapse" data-target="#demo1"><i class="fa fa-plus"></i> เพิ่มแบบทดสอบใหม่</a></h5>
                                                <div id="demo1" class="collapse"> <hr>
                                                <form action="assets/new_quiz.php" method="get" accept-charset="utf-8">
                                                      <input type="text" class="form-control border-input" placeholder="กรุณาใส่ชื่อแบบทดสอบ" value="" name="quiz_start"> <br>
                                                      <div class="text-center">
                                                         <button type="submit" class="btn btn-success btn-fill">บันทึกการสร้างแบบทดสอบ</button> <hr>
                                                      </div>
                                                </form>

                                                </div>
                               
                            </div>
                            <div class="content">
                                <ul class="list-unstyled team-members">
<?php 
    $sql1 = pg_query("select * from quiz_name order by id_quiz_name desc");

    while( $object = pg_fetch_array($sql1) ){

?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                       <?php echo $object[quiz_title]; ?>
                                                    </div>

                                                    <div class="col-xs-4 text-right">
                                                        <form action="">
                                                        <div class="btn-group">
                                                          <button name="quiz_title" value="<?php echo $object[quiz_title]; ?>" formaction="quiz.php" type="submit" class="btn  btn-sm <?php 
                                                                if ($object[status_quiz] == 'ปิดแบบทดสอบ') {
                                                                    echo "btn-danger";
                                                                }else{
                                                                    echo "btn-success";
                                                                }
                                                            ?> btn-fill"> <?php 
                                                                if ($object[status_quiz] == 'ปิดแบบทดสอบ') {
                                                                    echo "<span class='ti-lock'></span>";
                                                                }else{
                                                                    echo "<span class='ti-check-box'></span>";
                                                                }
                                                            ?></button>
                                                        </div>
                                                      </form>
                                                    </div>
                                                </div>
                                            </li>
    <?php } ?>
                                           
                                        </ul>
                            </div>
                        </div>
                    </div>
<div class="col-md-8">
    <?php 
    $sql2 = pg_query("select * from quiz_name
        where quiz_title like '%$quiz_title' order by id_quiz_name desc;");

     $object2 = pg_fetch_array($sql2) ;

?>
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php echo $object2[quiz_title]; ?></h4>
                                <p class="category"></p>
                                <center>
                                <div class="btn-group">
                                  <a href="new_quiz.php?quiz_start=<?php echo $object2[quiz_title]; ?>" type="button" class="btn btn-primary btn-fill"><i class="fa fa-plus"> </i>สร้างคำถามเพิ่ม</a>

                            <?php if ($object2[status_quiz] == 'ปิดแบบทดสอบ') { echo "<!--"; } ?>
                                <button type="button" class="btn btn-primary btn-fill"   data-toggle="collapse" data-target="#a<?php echo $object2[id_quiz_name]; ?>"><i class="fa fa-qrcode"></i> ส่งออกแบบทดสอบ</button>
                            <?php if ($object2[status_quiz] == 'ปิดแบบทดสอบ') { echo "--!>"; } ?>


                                  <div class="btn-group">
                                    <button type="button" class="btn <?php if ($object2[status_quiz] == 'ปิดแบบทดสอบ') { echo "btn-danger"; }else{ echo "btn-success" ; } ?> dropdown-toggle btn-fill" data-toggle="dropdown">
                                    สถานะแบบทดสอบ : <?php echo $object2[status_quiz]; ?><span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                      <li><a href="assets/update_status.php?status=เปิดแบบทดสอบ&id=<?php echo $object2[id_quiz_name]; ?>&quiz_start=<?php echo $object2[quiz_title]; ?>">เปิดแบบทดสอบ</a></li>
                                      <li><a href="assets/update_status.php?status=ปิดแบบทดสอบ&id=<?php echo $object2[id_quiz_name]; ?>&quiz_start=<?php echo $object2[quiz_title]; ?>">ปิดแบบทดสอบ</a></li>
                                    </ul>
                                  </div>
                                </div>
                                                        <div id="a<?php echo $object2[id_quiz_name]; ?>" class="collapse">
                                                            <center><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $object2[token]; ?>&choe=UTF-8" title="Link to Google.com" />
                                                            <h3>token key : <?php echo $object2[token]; ?> 
                                                            </h3></center> 

                                                        </div>
                                </center>

                            </div>
                            <div class="content table-responsive table-full-width">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#home">รายชื่อคำถาม</a></li>
                                  <li><a data-toggle="tab" href="#menu1">รายชื่อนักเรียนที่ร่วมทดสอบ</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div id="home" class="tab-pane fade in active">
                                            <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                           
                                            <tbody>



<?php 
    $sql3 = pg_query("select ROW_NUMBER() OVER(ORDER BY id_quiz ASC) AS row ,* from quiz where quiz_title like '%$object2[quiz_title]' order by id_quiz asc;");
    while( $object3 = pg_fetch_array($sql3) ){

?>
                                                <tr>
                                                    <td width="5%"><?php echo  $object3[row]; ?></td>
                                                    <td><?php echo $object3[quiz_name]; ?></td>
                                                    <td width="20%">
                                                        <div class="btn-group">
                                                          <button type="button" class="btn btn-sm  btn-primary btn-fill"   data-toggle="modal" data-target="#map<?php echo $object3[id_quiz]; ?>"><i class="fa fa-search"></i></button>
                                                          <a href="edit_quiz.php?id_quiz=<?php echo $object3[id_quiz]; ?>" formaction="quiz.php" type="submit" class="btn  btn-sm btn-primary btn-fill"><i class="fa fa-wrench"></i></a>
                                                        </div></td>
                                                </tr>
<?php } ?>
                                           


                                             
                                            </tbody>
                                        </table>
                                  </div>
                                  <div id="menu1" class="tab-pane fade">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><small>เลขประจำตัว</small></th>
                                                    <th><small>ชื่อ - นามสกุล</small></th>
                                                    <th><small>ลำดับชั้น</small></th>
                                                    <th><small>สถานะตอบคำถาม</small></th>
                                                    <th><small>คะแนน</small></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>data</td>
                                                    <td>data</td>
                                                    <td>data</td>
                                                    <td>data</td>
                                                    <td>data</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                  </div>
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




<?php 
    $sql4 = pg_query("select ROW_NUMBER() OVER(ORDER BY id_quiz ASC) AS row ,* from quiz where quiz_title like '%$object2[quiz_title]' order by id_quiz asc;");
    while( $object4 = pg_fetch_array($sql4) ){

?>
<!-- Modal -->
<div id="map<?php echo $object4[id_quiz]; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <iframe src="map_view_marker.php?id_quiz=<?php echo $object4[id_quiz]; ?>" width="100%" height="350px" frameborder="0"></iframe>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php } ?>



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

    L.Control.Watermark = L.Control.extend({
    onAdd: function(map) {
        var img = L.DomUtil.create('img');

        img.src = '../../docs/images/logo.png';
        img.style.width = '200px';

        return img;
    },

    onRemove: function(map) {
        // Nothing to do here
    }
});

</script>
</html>
