<?php 
session_start();
error_reporting(0);
include('dbconnection.php');

$id = $_SESSION['login_id'];
  if (strlen($_SESSION['login_id']==0)) {
  header('location:logout.php');
  }else {
  

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Arecanut Disease</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    body {
      background-image: url('assets/img/areca.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
  </style>
</head>

<body>

  <main>
    <div class="d-flex d-flex justify-content-end p-4" >
    <a href="logout.php" class="btn btn-warning">Sign out</a>
    </div>
    
    <div class="container">

      <section class="section">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
  
            <div class="card" style="top: 10px;">

              <div class="card-header" style="background-color: #ffc107;">
                <div class="pt-3">
                  <h5 class="card-title text-center">Result</h5>
                </div>
              </div>

              <div class="card-body mt-4">
              <h5 class="card-title" style="text-align: center; font-size: 20px;">Predicted Result is</h5>
              <div class="d-flex justify-content-center">
   <?php $query1=mysqli_query($con,"select * from tbl_uploadimg order by id desc limit 1");
    
     while ($row1=mysqli_fetch_array($query1)) { ?>
			<img src="images/<?php echo $row1['uploadimg'] ?>" style="height:300px;width:300px;">
	 <?php }?>
              </div>
                <div class="d-flex justify-content-center">
				<?php $query1=mysqli_query($con,"select * from tbl_result");
    
     while ($row1=mysqli_fetch_array($query1)) { ?>
                  <p><?php echo $row1['predicted'] ?></p>
	 <?php } ?>
                </div>
				
              </div>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-center" style="margin-top: 10px;">
            <a href="uploadimg.php"  class="btn btn-warning w-20 mt-4">Check another Result</a>
          </div>
          </div>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
  <?php }?>