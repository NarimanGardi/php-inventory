<div class="content-wrapper">

  <section class="content-header">

  <h1 class="pull-right" >
      کاڵاکان<small>ژووری</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Products</li>

    </ol>

  </section>
<br>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button style="font-family: NRT;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addProducts">

          زیادکردنی کاڵا

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered tableProdcuts table-striped dt-responsive" width="100%">

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
              <?php	if($_SESSION["profile"] == "administrator") {
			echo '
              <th>کردارەکان</th>'; }?>

            </tr>

          </thead>

          

        </table>
  <input type="hidden" value="<?php echo $_SESSION['profile']; ?>" id="profileValue">
      </div>

    </div>

  </section>

</div>


<!--=====================================
=            module add Product           =
======================================-->

<!-- Modal -->
<div id="addProducts" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>

          <h4 class="modal-title pull-right">زیادکردنی کاڵا</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- input Category -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="newCategory1" name="newCategory">

                  <option value="">دیاریکردنی بابەت</option>
                  <?php 
                    $item = null;
                    $value = null;
                    $category = CategoryController::ctrShowCategories($item,$value);
                      foreach ($category as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["category"].'</option>';
                      }
                  ?>
                </select>

              </div>

            </div>

            <!--Input name -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="باڕکۆد"
                  readonly required>

              </div>

            </div>

            <!-- input Description -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fas fa-font-case"></i></span>

                <input class="form-control input-lg" type="text" name="newDescription" placeholder="ناوی کاڵا"
                  required>

              </div>

            </div>

            <!-- input stock -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input class="form-control input-lg" type="number" name="newStock" placeholder="عدد" min="0"
                  required>

              </div>

            </div>

            <!-- input buying price -->

            <div class="form-group row">

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input class="form-control input-lg" type="number" step="any" name="newBuy" min="0"
                    placeholder="نرخی کرین" required>

                </div>

              </div>


              <!-- input Selling price -->
              <div class="col-xs-6">

                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input class="form-control input-lg" type="number" step="any" name="newSell" min="0"
                    placeholder="نرخی فرۆشتن" required>

                </div>

              </div>

            </div>

            <div class="form-group">

              <div style="font-family: NRT;" class="panel">وێنە</div>

              <input id="newImage1" type="file" class="newImage" name="newImage">

              <p class="help-block">زۆرترین قەبارە : ٢ میگابایت</p>

              <img src="views/img/products/anonymous.png" class="img-thumbnail preview" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">داخستن</button>

          <button type="submit" class="btn btn-primary">زیادکردن</button>

        </div>
        <?php 
        $addProduct = new ProductController();
        $addProduct->ctrAddProduct();
        ?>

      </form>

    </div>

  </div>

</div>

<!--====  End of module add user  ====-->

<!--=====================================
=            module edit Product           =
======================================-->

<!-- Modal -->
<!-- Modal -->
<div id="EditProduct" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>

          <h4 class="modal-title pull-right">گۆرانکاری لە کاڵا</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- input Category -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg"  name="editCategory" readonly >

                  <option id="editCategory1" value=""></option>

                </select>

              </div>

            </div>

            <!--Input name -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" id="editCode" name="editCode" required readonly>

              </div>

            </div>

            <!-- input Description -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fas fa-font-case"></i></span>

                <input class="form-control input-lg" type="text" id="editDescription" name="editDescription" 
                  required>

              </div>

            </div>

            <!-- input stock -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input class="form-control input-lg" type="number" id="editStock" name="editStock" min="0"
                  required>

              </div>

            </div>

            <!-- input buying price -->

            <div class="form-group row">

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input class="form-control input-lg" type="number" step="any" id="editBuy" name="editBuy" min="0"
                    required>

                </div>

              </div>


              <!-- input Selling price -->
              <div class="col-xs-6">

                <div class="input-group">



                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input class="form-control input-lg" type="number" step="any" id="editSell" name="editSell" min="0" required>

                </div>

              </div>

            </div>

            <div class="form-group">

              <div style="font-family: NRT;" class="panel">وێنە</div>

              <input id="newImage2" type="file" class="newImage" name="editImage">

              <p class="help-block">زۆرترین قەبارە : ٢ مێگابایت</p>

              <img src="views/img/products/anonymous.png" class="img-thumbnail preview" width="100px">
              
              <input type="hidden" name="actualImage" id="actualImage">
            </div>

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div style="font-family: NRT;" class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">داخستن</button>

          <button type="submit" class="btn btn-primary">گۆرانکاری</button>

        </div>
      
      <?php 
       $editProduct = new ProductController();
       $editProduct->ctrEditProduct();
      ?>
      </form>

    </div>

  </div>
    <?php 
    
    $deleteProduct = new ProductController();
    $deleteProduct->ctrDeleteProduct();
    
    ?>
</div>

<!--====  End of module add user  ====-->