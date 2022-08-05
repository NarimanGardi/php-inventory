<?php
  session_start();
?>

<!DOCTYPE html>
<html >
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="views/img/template/icono-negro.png">

  <!--=================================
  =            Plugins CSS            =
  ==================================-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="views/bower_components/fontawesome-pro-5.14.0-web/css/all.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css"> 

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> 
  <!-- Select2 -->
  <link rel="stylesheet" href="views/bower_components/select2/dist/css/select2.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Morris chart -->
  <link rel="stylesheet" href="views/bower_components/morris.js/morris.css">
  <!--====  End of Plugins CSS  ====-->
  
  <!--========================================
  =            plugins javascript            =
  =========================================-->
  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Bootstrap 5
  <script src="views/bower_components/bootstrap-5.0.2/js/bootstrap.js"></script> -->
  <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

    <!-- jquery number -->
    <script src="views/plugins/jquery-number/jquery-number.js"></script>

  <!-- sweet alert -->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- By default sweetalert2 doesn't support IE. To enable IE 11 support, include Promise polyfill -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  
  <!-- InPut mask for forms -->
  <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- selec2 for choose option in forms -->
  <script src="views/bower_components/select2/dist/js/select2.full.min.js"></script>

    <!-- date-range-picker -->
  <script src="views/bower_components/moment/min/moment.min.js"></script>
  <script src="views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
    <script src="views/bower_components/raphael/raphael.min.js"></script>
    <script src="views/bower_components/morris.js/morris.min.js"></script>
 <!-- chart js -->
    <script src="views/bower_components/chart.js/Chart.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

<!-- Site wrapper -->

  <?php

    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "ok"){

      echo '<div class="wrapper">';

      /*=============================================
      =            header          =
      =============================================*/  

      include "modules/header.php";

      /*=============================================
      =            sidebar          =
      =============================================*/ 

      include "modules/sidebar.php";

      /*=============================================
      =            Content          =
      =============================================*/ 

      if(isset($_GET["route"])){

        if ($_GET["route"] == 'home' || 
            $_GET["route"] == 'users' ||
            $_GET["route"] == 'categories' ||
            $_GET["route"] == 'products' ||
            $_GET["route"] == 'customers' ||
            $_GET["route"] == 'soldout' ||
            $_GET["route"] == 'qarz' ||
            $_GET["route"] == 'backup' ||
            $_GET["route"] == 'manage-sales' ||
            $_GET["route"] == 'create-sales' ||
            $_GET["route"] == 'edit-sales' ||
            $_GET["route"] == 'sales-report' ||
            $_GET["route"] == 'logout'){

          include "modules/".$_GET["route"].".php";

        }else{

           include "modules/404.php";

        }

      }else{

        include "modules/home.php";

      }

      /*=============================================
      =            Footer          =
      =============================================*/ 

      include "modules/footer.php";

      echo '</div>';

    }else{
      /*=============================================
      =            login          =
      =============================================*/ 

      include "modules/login.php";
    }
        
  ?>

  
<!-- ./wrapper -->

<script type="text/javascript" src="views/js/template.js"></script>
<script type="text/javascript" src="views/js/users.js"></script>
<script type="text/javascript" src="views/js/category.js"></script>
<script type="text/javascript" src="views/js/products.js"></script>
<script type="text/javascript" src="views/js/soldout.js"></script>
<script type="text/javascript" src="views/js/customers.js"></script>
<script type="text/javascript" src="views/js/sales.js"></script>
<script type="text/javascript" src="views/js/reports.js"></script>
<script type="text/javascript" src="views/js/qarz.js"></script>
</body>
</html>
