<div class="content-wrapper">

  <section class="content-header">

  <h1 class="pull-right" >
      فرۆشتنەکان<small>ژووری</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Sales</li>

    </ol>

  </section>
<br>
  <section class="content">

    <div class="row">

      <!--=============================================
      THE FORM
      =============================================-->
      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="saleForm">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                    =            SELLER INPUT           =
                    ======================================-->


                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" name="newSeller" id="newSeller"
                      value="<?php echo $_SESSION["name"]; ?>" readonly>

                    <input type="hidden" name="idSeller" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div>


                <!--=====================================
                    CODE INPUT
                    ======================================-->


                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>


                    <?php 
                          $item = null;
                          $value = null;

                          $sales = SaleController::ctrShowSales($item, $value);

                          if(!$sales){

                            echo '<input type="text" class="form-control" name="newSale" id="newSale" value="10001" readonly>';
                          }
                          else{

                            foreach ($sales as $key => $value) {
                              
                            }

                            $code = $value["code"] + 1;

                            echo '<input type="text" class="form-control" name="newSale" id="newSale" value="'.$code.'" readonly>';

                          }

                        ?>

                  </div>


                </div>


                <!--=====================================
                    =            CUSTOMER INPUT           =
                    ======================================-->


                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select style="font-family: NRT;" class="form-control select2" name="selectCustomer" id="selectCustomer" required>

                      <option style="font-family: NRT;" value="">دیاریکردنی کریار</option>
                      <?php 
                            $item =null;
                            $value = null;
                            $showCustomers = CustomerController::ctrShowCustomers($item,$value);
                            foreach ($showCustomers as $key => $value) {
                              echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                            }
                            
                            ?>
                    </select>

                    <span style="font-family: NRT;" class="input-group-addon"><button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#modalAddCustomer" data-dismiss="modal">زیادکردنی کریار</button></span>

                  </div>

                </div>

                <!--=====================================
                    =            PRODUCT INPUT           =
                    ======================================-->


                <div class="form-group row newProduct">


                </div>

                <input type="hidden" name="productsList" id="productsList">

                <!--=====================================
                    =            ADD PRODUCT BUTTON          =
                    ======================================-->

                <button style="font-family: NRT;" type="button" class="btn btn-default hidden-lg btnAddProduct">زیادکردنی کاڵا</button>

                <hr>

                <div class="row">

                  <!--=====================================
                        TAXES AND TOTAL INPUT
                      ======================================-->

                  <div class="col-lg">

                    <table class="table">

                      <thead style="font-family: NRT;">

                        <th>داشکان</th>
                        <th>کۆی گشتی</th>

                      </thead>


                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="number" class="form-control" name="newDiscountSale" id="newDiscountSale"
                                placeholder="0" min="0" >

                              <input type="hidden" name="newDiscountPrice" id="newDiscountPrice" >

                              <input type="hidden" name="newNetPrice" id="newNetPrice" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>
                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control" name="newSaleTotal" totalSale="" id="newSaleTotal"
                                placeholder="00000" totalSale="" readonly required>

                              <input type="hidden" name="saleTotal" id="saleTotal" required>

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <hr>

                </div>

                <hr>

                <!--=====================================
                      PAYMENT METHOD
                      ======================================-->

                <div class="form-group row">

                  <div class="col-xs-6" style="padding-right: 0">

                    <div class="input-group">

                      <select style="font-family: NRT;" class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>

                        <option value="">شێوازی پارەدان</option>
                        <option value="cash">نەقد</option>
                        <option value="قەرد">قەرد</option>
                      </select>

                    </div>

                  </div>

                  <div class="paymentMethodBoxes"></div>

                  <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required>

                </div>

                <br>

              </div>

            </div>

            <div class="box-footer">
              <button style="font-family: NRT;" type="submit" class="btn btn-primary pull-right">فرۆشتن</button>
            </div>
          </form>

          <?php

            $saveSale = new SaleController();
            $saveSale -> ctrCreateSale();
            
          ?>

        </div>

      </div>


      <!--=============================================
      =            PRODUCTS TABLE                   =
      =============================================-->


      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tableSales">

              <thead>

                <tr style="font-family: NRT;">

                  <th style="width:10px">#</th>
                  <th>وێنە</th>
                  <th style="width:30px">باڕکۆد</th>
                  <th>ناو</th>
                  <th>عدد</th>
                  <th>کردارەکان</th>

                </tr>


              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>


<!--=====================================
=            module add Customer            =
======================================-->

<!-- Modal -->
<div id="modalAddCustomer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="POST">

        <!--=====================================
MODAL HEADER
======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Add Customer</h4>

        </div>

        <!--=====================================
MODAL BODY
======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- NAME INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control input-lg" type="text" name="newCustomer1" placeholder="Write name" required>
              </div>
            </div>


            <!-- PHONE INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="newPhone1" placeholder="phone"
                  data-inputmask="'mask':'(9999) 999-9999'" data-mask required>
              </div>
            </div>

            <!-- ADDRESS INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="newAddress1" placeholder="Address" required>
              </div>
            </div>


          </div>

        </div>

        <!--=====================================
MODAL FOOTER
======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Customer</button>
        </div>
        <?php

        $createCustomer = new CustomerController();
        $createCustomer -> ctrAddCustomerFromSales();

      ?>
      </form>
       
      
    </div>

  </div>
</div>

<!--====  End of module add Customer  ====-->