<div class="content-wrapper">

  <section class="content-header">
  <?php 
                        $item = "id";
                        $value = $_GET["idSale"];

                        $sales = SaleController::ctrShowSales($item, $value);

                        $sellerItem = "id";
                        $sellerValue = $sales["idSeller"];
                        $Seller = ControllerUsers::ctrShowUsers($sellerItem,$sellerValue);
                        
                        $customerItem = "id";
                        $customerValue = $sales["idCustomer"];
                        $Customer = CustomerController::ctrShowCustomers($customerItem,$customerValue);

                        $printDiscountPercent = $sales["discount"] * 100 / $sales["net"];
                        ?>
    <h1>

      Sales management

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Create Sale</li>

    </ol>

  </section>

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
                      value="<?php echo $Seller["name"]; ?>" readonly>

                    <input type="hidden" name="idSeller" value="<?php echo $Seller["id"]; ?>">

                  </div>

                </div>


                <!--=====================================
                    CODE INPUT
                    ======================================-->


                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control" name="editSale" id="newSale" value="<?php echo $sales["code"] ?>" readonly>


                  </div>


                </div>


                <!--=====================================
                    =            CUSTOMER INPUT           =
                    ======================================-->


                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control select2" name="selectCustomer" id="selectCustomer" required>

                      <option value="<?php echo $Customer["id"]; ?>"><?php echo $Customer["name"]; ?></option>
                      <?php 
                            $item =null;
                            $value = null;
                            $showCustomers = CustomerController::ctrShowCustomers($item,$value);
                            foreach ($showCustomers as $key => $value) {
                              echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                            }
                            
                            ?>
                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs"
                        data-toggle="modal" data-target="#modalAddCustomer" data-dismiss="modal">Add
                        Customer</button></span>

                    </div>

                </div>

                <!--=====================================
                    =            PRODUCT INPUT           =
                    ======================================-->


                <div class="form-group row newProduct">
                    <?php 
                    $listProducts = json_decode($sales["products"],true);
                    foreach ($listProducts as $key => $value) {
                        $itemProduct = "id";
                        $valueProduct = $value["id"];
                        $product = ProductController::ctrShowProducts($itemProduct,$valueProduct);
                        // 3dady froshraw lagal 3dady mawa kodakretawa la kate edit sale
                        $oldStock =  $product["stock"] + $value["quantity"];
                        echo '
                <div class="row" style="padding:5px 15px">

                <!-- Product description -->

                <div class="col-xs-6" style="padding-right:0px">

                <div class="input-group">

                <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                <input type="text" class="form-control newProductDescription" idProduct="'.$value["id"].'" name="addProductSale" value="'.$value["description"].'" readonly required>

                </div>

                </div>

                <!-- Product quantity -->

                <div class="col-xs-3">

                <input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="'.$value["quantity"].'" stock="'.$oldStock.'" newStock="'.$value["stock"].'" required>

                </div>

                <!-- product price -->

                <div class="col-xs-3 enterPrice" style="padding-left:0px">

                <div class="input-group">

                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                <input type="text" class="form-control newProductPrice" realPrice="'.$product["sell_price"].'" name="newProductPrice" value="'.$value["totalprice"].'" readonly required>

                </div>

                </div>

                </div>
                        ';
                    }
                    ?>

                </div>

                <input type="hidden" name="productsList" id="productsList">

                <!--=====================================
                    =            ADD PRODUCT BUTTON          =
                    ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAddProduct">Add Product</button>

                <hr>

                <div class="row">

                  <!--=====================================
                        TAXES AND TOTAL INPUT
                      ======================================-->

                  <div class="col-lg">

                    <table class="table">

                      <thead>

                        <th>داشکان</th>
                        <th>koy gshty</th>

                      </thead>


                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="number" class="form-control" name="newDiscountSale" id="newDiscountSale"
                                value="<?php echo $printDiscountPercent; ?>" min="0" >

                              <input type="hidden" name="newDiscountPrice" value="<?php echo $sales["discount"] ?>" id="newDiscountPrice" >

                              <input type="hidden" name="newNetPrice" value="<?php echo $sales["net"] ?>" id="newNetPrice" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>
                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control" name="newSaleTotal" totalSale="" id="newSaleTotal"
                                value="<?php echo $sales["total"] ?>" totalSale="" readonly required>

                              <input type="hidden" name="saleTotal" value="<?php echo $sales["total"] ?>" id="saleTotal" required>

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

                      <select class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>

                        <option value="<?php echo $sales["paymentMethod"] ?>"><?php if($sales["paymentMethod"] =="cash"){echo 'naqd';}else{echo 'qard';}?></option>
                        <option value="cash">naqd</option>
                        <option value="qard">qard</option>
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
              <button type="submit" class="btn btn-primary pull-right">Edit sale</button>
            </div>
          </form>

          <?php

            $editSale = new SaleController();
            $editSale -> ctrEditSales();
            
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

                <tr>

                  <th style="width:10px">#</th>
                  <th>Image</th>
                  <th style="width:30px">Code</th>
                  <th>Description</th>
                  <th>Stock</th>
                  <th>Actions</th>

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

            <!-- I.D DOCUMENT INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="newIdDocument1"
                  placeholder="Write your ID" required>
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