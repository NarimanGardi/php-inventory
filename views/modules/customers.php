<div class="content-wrapper">

  <section class="content-header">

  <h1 class="pull-right">کڕیارەکان<small>پەڕەیی</small></h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Customers</li>

    </ol>

  </section>
<br>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button style="font-family: NRT;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addCustomer">

        زیادکردنی کریار

        </button>

      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr style="font-family: NRT;">
             
             <th style="width:10px">#</th>
             <th>ناو</th>
             <th>ژمارەی مۆبایل</th>
             <th>ناونیشان</th>
             <th>کۆی کڕینەکان</th>
             <th>کۆتا کڕین</th>
             <?php	if($_SESSION["profile"] == "administrator") {
			echo '
             <th>کردارەکان</th>'; }
?>
            </tr> 

            </thead>

            <tbody>
                <?php 
                $item = null;
                $value = null;
                $showCustomers = CustomerController::ctrShowCustomers($item,$value);

                foreach ($showCustomers as $key => $value) {
                    echo '<tr>

                    <td>'.($key+1).'</td>
    
                    <td>'.$value["name"].'</td>
    
                    <td>'.$value["phone"].'</td>
    
                    <td>'.$value["address"].'</td>
    
                    <td>'.$value["totalpurchase"].'</td>
    
                    <td>'.$value["last_purchase"].'</td>
    
    
                    <td>';
                   if($_SESSION["profile"] == "administrator") {
                      echo '
                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditCustomer" idCustomer="'.$value["id"].'" data-toggle="modal" data-target="#editCustomer"><i class="fa fa-pencil"></i></button>
    
                      <button class="btn btn-danger  btnDeleteCustomer" idCustomer="'.$value["id"].'"><i class="fa fa-times"></i></button>
    
                    </div>'; } 
                echo'
                  </td>
    
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
MODAL ADD CUSTOMER
======================================-->

<div id="addCustomer" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

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
                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Write name" required>
              </div>
            </div>

            <!-- PHONE INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="newPhone" placeholder="phone" data-inputmask="'mask':'(9999) 999-9999'" data-mask required>
              </div>
            </div>

            <!-- ADDRESS INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>
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
        
      </form>
      <?php 
        $createCustomer = new CustomerController();
        $createCustomer->ctrAddCustomer();
        
        ?>
     
    </div>

  </div>

</div>

<!--=====================================
MODAL EDit CUSTOMER
======================================-->

<div id="editCustomer" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        MODAL HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Edit Customer</h4>

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
                <input class="form-control input-lg" type="hidden" name="idCustomer" id="idCustomer"  required>
                <input class="form-control input-lg" type="text" name="editCustomer" id="editCustomer1"  required>
              </div>
            </div>

            <!-- PHONE INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="editPhone" id="editPhone"  data-inputmask="'mask':'(9999) 999-9999'" data-mask required>
              </div>
            </div>

            <!-- ADDRESS INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="editAddress" id="editAddress" required>
              </div>
            </div>


          </div>

        </div>

        <!--=====================================
        MODAL FOOTER
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit Customer</button>
        </div>
        
      </form>
      <?php 
      $editCustomer = new CustomerController();
      $editCustomer->ctrEditCustomer();
      ?>
    </div>

  </div>

</div>
<?php 
      $deleteCustomer = new CustomerController();
      $deleteCustomer->ctrDeleteCustomer();
      ?>

