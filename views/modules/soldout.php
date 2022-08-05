
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1 class="pull-right" >
      کاڵا تەواوبووەکان<small>ژووری</small>
    </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sold Out</li>
      </ol>
    </section>
<br>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tables" width="100%">
        
            <thead>

            <tr style="font-family: NRT;">

              <th style="width:10px">#</th>
              <th>وێنە</th>
              <th>باڕکۆد</th>
              <th>ناو</th>
              <th>بابەت</th>
              <th>عدد</th>
              <th>نرخی کرین</th>
              <th>نرخی فرۆشتن</th>
              <th>بەروار</th>
              <th>کردارەکان</th>

            </tr>

            </thead>

            <tbody>
              <?php 
              $item = null;
              $value = null;
              $showSoldOut = SoldOutController::ctrShowSoldOut($item,$value);

              foreach ($showSoldOut as $key => $value) {
                echo '
                <tr>
                <td>'.($key+1).'</td>
                <td><img src="'.$value["image"].'" class="img-thumbnail" width="40px"></td>
                <td>'.$value["code"].'</td>
                <td>'.$value["description"].'</td>';
                $item1 = "id";
                $value1 = $value["id_category"];
                $category = CategoryController::ctrShowCategories($item1,$value1);
                echo '<td>'.$category["category"].'</td>
                <td><button class="btn btn-danger">'.$value["stock"].'</button></td>
                <td>'.number_format($value["buy_price"]).'</td>
                <td>'.number_format($value["sell_price"]).'</td>
                <td>'.$value["date"].'</td>
                <td>
                <div class="btn-group">
                      
                <button class="btn btn-warning btnEditStock" idProductStock="'.$value["id"].'" data-toggle="modal" data-target="#reNewStock"><i class="fa fa-pencil"></i></button>

              </div>
              </td>
              </tr>
                ';
              }
              ?>
              
            
            </tbody>

          </table>

        </div>
      
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>


<!--=====================================
=            module renew stock            =
======================================-->

<!-- Modal -->
<div id="reNewStock" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="POST">
        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">نوێ کردنەوەی کاڵا</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <!--Input name -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input class="form-control input-lg" type="text" id="renewStock" name="renewStock" required>
                <input class="form-control input-lg" type="hidden" id="idstock" name="idstock"  required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">داخستن</button>
          <button type="submit" class="btn btn-primary">نوێ کردنەوە</button>
        </div>
        <?php 
        $editStock = new SoldOutController();
        $editStock->ctrEditStock();
        ?>
      </form>
    </div>

  </div>
</div>

<!--====  End of module add Categories  ====-->
