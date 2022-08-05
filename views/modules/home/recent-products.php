<?php 
$item = null;
$value = null;

$Products = ProductController::ctrShowLatestProducts($item,$value);

?>

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title pull-right">نوێترین کاڵای هاتوو</h3>
            </div>
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <?php 
                   for ($i=0; $i < 10; $i++) { 
                    $item = "id";
                    $value = $Products[$i]["id_category"];
                    $category = CategoryController::ctrShowCategories($item,$value);
                    
                        echo '<li class="item">
                        <div class="product-img">
                          <img src="'.$Products[$i]["image"].'" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">'.$category["category"].'
                            <span style="padding:5px;" class="label label-primary pull-right">IQD '.$Products[$i]["sell_price"].'</span></a>
                          <span class="product-description">
                          '.$Products[$i]["description"].'
                              </span>
                        </div>
                      </li>';
                    }
                
                ?>
                
              </ul>
            </div>

            <div class="box-footer text-center">
              <a href="products" >بینینی هەموو کاڵاکان</a>
            </div>

          </div>

        </div>