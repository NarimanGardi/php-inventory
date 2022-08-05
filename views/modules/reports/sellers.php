<?php

$item = null;
$value = null;

$sales = SaleController::ctrShowSales($item, $value);
$users = ControllerUsers::ctrShowUsers($item, $value);

$arraySellers = array();
$arraySellersList = array();

foreach ($sales as $key => $valueSales) {

  foreach ($users as $key => $valueUsers) {

    if($valueUsers["id"] == $valueSales["idSeller"]){

        #We capture sellers in an array
        array_push($arraySellers, $valueUsers["name"]);

        #We capture the names and net values in the same array
        $arraySellersList = array($valueUsers["name"] => $valueSales["total"]);

        #We add the netprice of each seller

        foreach ($arraySellersList as $key => $value) {

            $addingTotalSales[$key] += $value;

         }

    }
  
  }

}

#Avoiding repeated names
$dontrepeatnames = array_unique($arraySellers);

?>
<div class="box box-success">

    <div class="box-header with-border pull-right">

        <h3 class="box-title">فرۆشیارەکان</h3>

    </div>

    <div class="box-body chart-responsive">

        <div class="chart" id="bar-chart1" style="height: 300px;"></div>

    </div>

</div>

<script>
//BAR CHART
var bar = new Morris.Bar({
      element: 'bar-chart1',
      resize: true,
      data: [
        <?php
    
    foreach($dontrepeatnames as $value){

      echo "{y: '".$value."', a: '".$addingTotalSales[$value]."'},";

    }

  ?>
      ],
      barColors: ['#CD113B'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['فرۆشتن '],
      preUnits: 'IQD ',
      hideHover: 'auto'
    });
</script>