<?php 
if($_SESSION["profile"] != "administrator") {
echo '<script>
window.location = "home";

</script>
return;';
}
?>

<div class="content-wrapper">

  <section class="content-header">

  <h1 class="pull-right" >
      راپۆرتەکان<small>ژووری</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Report</li>

    </ol>

  </section>
<br>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

          <div class="input-group">

            <button type="button" class="btn btn-default" id="daterange-btn2">

              <span  style="font-family: NRT;"><i class="fa fa-calendar"></i> بەرواری راپۆرت</span>

              <i class="fa fa-caret-down"> </i>

            </button>

          </div>

          <div style="margin-top:5px" class="box-tools pull-right">
        <?php 
          if(isset($_GET["startDate"])){
            echo '<a href="views/modules/report-to-excel.php?report=report&startDate='.$_GET["startDate"].'&endDate='.$_GET["endDate"].'">';
          }else {
            echo '<a href="views/modules/report-to-excel.php?report=report">';
          }
        ?>
            

                <button  style="font-family: NRT;" class="btn btn-success">راپۆرت بە فایلی ئێکسڵ</button>

            </a>

          </div>

      </div>

      <div class="box-body">

        <div class="row">

          <div class="col-xs-12">
            <?php 
            include "reports/sales-graph.php";
            ?>
          </div>

          <div class="col-md-6 col-xs-12">

            <?php

            include "reports/bestseller-products.php";

            ?>

          </div>
          <div class="col-md-6 col-xs-12">
           
           <?php

           include "reports/sellers.php";

           ?>

        </div>

        <div class="col-md-6 col-xs-12">
          
           <?php

           include "reports/buyers.php";

           ?>

        </div>

        </div>

      </div>



    </div>

  </section>

</div>