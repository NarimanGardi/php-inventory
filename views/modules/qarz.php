<div class="content-wrapper">

  <section class="content-header">

      <h1 class="pull-right">قەرزەکان<small>ژووری</small></h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

    <li class="active">Owe</li>

    </ol>

  </section>
<br>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">


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
              <th>بەروار</th>
              <th>کردارەکان</th>

            </tr>

          </thead>

          <tbody>
        <?php 
        $item= null;
        $value = null;
        $showQarz = QarzController::ctrShowQarz($item,$value);
        foreach ($showQarz as $key => $value) {
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
              <td >IQD '.number_format($value["total"]).'</td>
              <td>'.$value["date"].'</td>
              <td>
              <div class="btn-group">
                        
                        <button class="btn btn-info btnPrintBill" codeSale="'.$value["code"].'"><i class="fa fa-print"></i></button>
                        <button class="btn btn-warning btnEditQarz" idSale="'.$value["id"].'" data-toggle="modal" data-target="#qarzBack"><i class="fa fa-pencil"></i></button>
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

  </section>

</div>


<!--=====================================
=            module add user            =
======================================-->

<!-- Modal -->
<div id="qarzBack" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>

          <h4 class="modal-title pull-right">دانەوەی قەرز</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- payment method -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fad fa-money-bill-alt"></i></span>

                <select class="form-control input-lg" name="changePayment">

                  <option value="" id="changePayment"></option>
                  <option value="cash">نەقد</option>

                </select>

              </div>
              <input class="form-control input-lg" type="hidden" id="idPayment" name="idPayment"  required>

            </div>

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div  style="font-family: NRT;" class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">داخستن</button>

          <button type="submit" class="btn btn-primary">دانەوەی قەزر</button>

        </div>
        <?php 
        $editQarz = new QarzController();
        $editQarz->ctrEditQarz();
        ?>
      </form>

    </div>

  </div>

</div>

<!--====  End of module add user  ====-->
