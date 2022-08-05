<?php 
error_reporting(0);
          if(isset($_GET["startDate"])){
            $startDate = $_GET["startDate"];
            $endDate = $_GET["endDate"];
          }else {
            $startDate = null;
            $endDate = null;
          }
                
                $showSales = SaleController::ctrShowRangeSales($startDate,$endDate);
                // arrayDate bo henany hamw froshakany haman mang
                $arrayDate = array();
                // arrayTotalSaleInMonths bo kokrdnaway hamw froshakany haman mang
                $arrayTotalSaleInMonths = array();
                // tawawkare array sarawa
                $sumTotalPricesInTheSameMonth = array();
                foreach ($showSales as $key => $value) {
                    // rashkrdnaway sa3at w rozh wa heshtanaway mang w sal bo away datakan ba gweray mang behenet 
                   $date = substr($value["date"],0,7);
                   array_push($arrayDate, $date);
                   $arrayTotalSaleInMonths = array($date => $value["total"]);
                   foreach ($arrayTotalSaleInMonths as $key => $value) {
                      $sumTotalPricesInTheSameMonth[$key] += $value;
                   }
                   
                }
                // bo away haman mang dubara la array da nabet taku btwani koe total pirce bkay
                $dontRepeatDates = array_unique($arrayDate);

?>

<div class="box box-solid bg-teal-gradient">
    <div class="box-header pull-right">
        
        <h2 class="box-title"> هێڵکاری فرۆشراوەکان </h2>
        <i class="fas fa-chart-bar"></i>
    </div>
    <div class="box-body border-radius-none newSalesGraph">
        <div class="chart" id="line-chart" style="height:250px;"></div>
    </div>

</div> 

<script>
    // LINE CHART 

    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            <?php 
            if ($dontRepeatDates != null) {
                foreach ($dontRepeatDates as $key) {
                    echo "{y: '".$key."', Sales: ".$sumTotalPricesInTheSameMonth[$key]."},";
                }
                echo "{y: '".$key."', Sales: ".$sumTotalPricesInTheSameMonth[$key]."}";
            }else {
                echo "{y: '0', Sales: 0}";
            }
                
                ?>

        ],
        xkey: 'y',
        ykeys: ['Sales'],
        labels: ['فرۆشتن '],
        lineColors       : ['#efefef'],
        lineWidth        : 2,
        hideHover        : 'auto',
        gridTextColor    : '#fff',
        gridStrokeWidth  : 0.4,
        pointSize        : 4,
        pointStrokeColors: ['#efefef'],
        gridLineColor    : '#efefef',
        gridTextFamily   : 'Open Sans',
        preUnits         : 'IQD ',
        gridTextSize     : 10
    });
</script>