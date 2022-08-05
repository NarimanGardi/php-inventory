<?php 
$item = null;
$value = null;
$sale = SaleController::ctrAddTotalSales();
$category = CategoryController::ctrShowCategories($item,$value);
$CountCategory = count($category);
$Product = ProductController::ctrShowProducts($item,$value);
$CountProduct = count($Product);
$Customer = CustomerController::ctrShowCustomers($item,$value);
$CountCustomer = count($Customer);
?>


<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3><?php echo  number_format($sale["totalprice"]); ?></h3>

            <p>فرۆشراوەکان</p>
        </div>
        <div class="icon">
            <i class="ion ion-social-usd"></i>
        </div>
        <a href="manage-sales" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> زانیاری زیاتر</a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3><?php echo $CountCategory ?></h3>

            <p>بابەتەکان</p>
        </div>
        <div class="icon">
            <i class="ion ion-clipboard"></i>
        </div>
        <a href="categories" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> زانیاری زیاتر</a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo $CountCustomer ?></h3>

            <p>کڕیارەکان</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="customers" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> زانیاری زیاتر</a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
        <div class="inner">
            <h3><?php echo $CountProduct ?></h3>

            <p>کاڵاکان</p>
        </div>
        <div class="icon">
            <i class="ion ion-ios-cart"></i>
        </div>
        <a href="products" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i> زانیاری زیاتر</a>
    </div>
</div>
<!-- ./col -->