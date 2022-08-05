<div class="content-wrapper">

  <section class="content-header">

  <h1 class="pull-right">فرۆشراوەکان<small>ژووری</small></h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Sold</li>

    </ol>

  </section>
<br>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="create-sales">
          <button style="font-family: NRT;"  class="btn btn-primary">

            بفرۆشە

          </button>
        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span style="font-family: NRT;"><i class="fa fa-calendar"> </i>  بەرواری فرۆشتن
            </span>
            <i class="fa fa-caret-down"> </i>
        </button>

      </div>
      

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">

          <thead>
          
            <tr style="font-family: NRT;">

              <th style="width:10px">#</th>
              <th>کۆدی پسولە</th>
              <th>کریار</th>
              <th>فرۆشیار</th>
              <th>شێوازی پارەدان</th>
              <th>کۆی گشتی</th>
              <th>داشکان</th>
              <th>کۆی گشتی دوای داشکان</th>
              <th>بەروار</th>
              <th>کردارەکان</th>

            </tr>

          </thead>

          <tbody><?php 
          if(isset($_GET["startDate"])){
            $startDate = $_GET["startDate"];
            $endDate = $_GET["endDate"];
          }else {
            $startDate = null;
            $endDate = null;
          }
                
                $showSales = SaleController::ctrShowRangeSales($startDate,$endDate);

                foreach ($showSales as $key => $value) {
                  echo '
                  <tr>
              <td>'.($key+1).'</td>
              <td>'.$value["code"].'</td>';
              $itemCustomer = "id";
              $valueCustomer = $value["idCustomer"];
              $bringCustomer = CustomerController::ctrShowCustomers($itemCustomer,$valueCustomer);
             echo '<td>'.$bringCustomer["name"].'</td>';
              $itemSeller = "id";
              $valueSeller = $value["idSeller"];
              $bringSeller = ControllerUsers::ctrShowUsers($itemSeller,$valueSeller);
              echo '<td>'.$bringSeller["name"].'</td>
              <td >'.$value["paymentMethod"].'</td>
              <td >IQD '.number_format($value["net"]).'</td>
              <td >IQD '.number_format($value["discount"]).'</td>
              <td >IQD '.number_format($value["total"]).'</td>
              <td>'.$value["date"].'</td>
              <td>
              <div class="btn-group">
                        
                        <button class="btn btn-info btnPrintBill" codeSale="'.$value["code"].'"><i class="fa fa-print"></i></button>';
                        if($_SESSION["profile"] == "administrator") {
                          echo '
                        <button class="btn btn-warning btnEditSale" idSale="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnDeleteSale" idSale="'.$value["id"].'" ><i class="fa fa-times"></i></button>'; } 
                          echo'
                      </div>  
              </td>
            </tr>
                  ';
                }
          ?></tbody>

        </table>

      </div>

    </div>

  </section>

</div><?php 

$deleteSale = new SaleController();
$deleteSale->ctrDeleteSale();

?>