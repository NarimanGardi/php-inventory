<style>
  a {
    font-family: 'NRT';
  }
</style>
<div class="content-wrapper">

  <section class="content-header">

    <h1 class="pull-right">سەرەکی<small>پەڕەیی</small></h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>
 <br>
  <section class="content">

    <div class="row">
      <?php 
      
      include "home/box-info.php";
      
      ?>
    </div>
    <div class="row">
      <div class="col-lg-12">
      <?php 
 
            include "reports/sales-graph.php";

      ?>
      </div>
      <div class="col-lg-6">
      <?php

        include "reports/bestseller-products.php";

      ?>
      </div>
      <div class="col-lg-6">
      <?php

        include "home/recent-products.php";

      ?>
      </div>
    </div>

  </section>

</div>
