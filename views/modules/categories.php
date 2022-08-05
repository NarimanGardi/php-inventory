<div class="content-wrapper">

  <section class="content-header">

  <h1 class="pull-right" >
      بابەتەکان<small>ژووری</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Categories</li>

    </ol>

  </section>
<br>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button style="font-family: NRT;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addCategory">

          زیادکردنی بابەت

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">

          <thead>

            <tr style="font-family: NRT;">

              <th style="width:10px">#</th>
              <th>بابەتەکان</th>
              <th>کردارەکان</th>

            </tr>

          </thead>

          <tbody>

            
              <?php 
              $item = null;
              $value = null;
              $showCategories = CategoryController::ctrShowCategories($item,$value);

              foreach ($showCategories as $key => $value) {
                echo '
                <tr>
                <td>'.($key+1).'</td>

                <td>'.$value["category"].'</td>
                
                <div class="btn-group">
                  <td>
                  	
                    <button class="btn btn-warning btnEditCategory" idCategory="'.$value["id"].'" data-toggle="modal" data-target="#EditCategory"><i class="fa fa-pencil"></i></button>';
                    if($_SESSION["profile"] == "administrator") {
                      echo '
                    <button class="btn btn-danger btnDeleteCategory" idCategory="'.$value["id"].'"><i class="fa fa-times"></i></button>
                  </td>'; }
                  echo'
                </div>
  
                
                </tr>';
              }
              
              ?>
              

           

            

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>


<!--=====================================
=            module add Category            =
======================================-->

<!-- Modal -->
<div id="addCategory" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>

          <h4 class="modal-title pull-right">زیادکردنی بابەت</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--Input name -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input class="form-control input-lg" id="newCategory" type="text" name="newCategory" placeholder="بابەت" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div style="font-family: NRT;" class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">داخستن</button>

          <button type="submit" class="btn btn-primary">زیادکردن</button>

        </div>
        <?php 
        
        $createCategory = new CategoryController();
        $createCategory->ctrAddCategory();
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
=            module edit Category            =
======================================-->

<!-- Modal -->
<div id="EditCategory" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>

          <h4 class="modal-title pull-right">گۆرانکاری لە بابەت</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--Input name -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input class="form-control input-lg" type="text" id="editCategory" name="editCategory"  required>
                <input class="form-control input-lg" type="hidden" id="idCategory" name="idCategory"  required>

              </div>

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
        
        $editCategory = new CategoryController();
        $editCategory->ctrEditCategory();
        ?>

      </form>

    </div>

  </div>

</div>
<?php 
$deleteCategory = new CategoryController();
$deleteCategory->ctrDeleteCategory();

?>