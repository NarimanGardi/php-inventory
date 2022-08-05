<?php 
require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

Class TableProducts {
    public function showProductsTable(){
        $item = null;
        $value = null;
        $showProducts=  ProductController::ctrShowProducts($item,$value);
                
        $JsonData = '{
            "data": [';
                        for ($i=0; $i < count($showProducts); $i++) { 
                            $item = "id";
                            $value = $showProducts[$i]["id_category"];
                            $category = CategoryController::ctrShowCategories($item,$value);
                            $iamge = "<img src='".$showProducts[$i]["image"]."' width='40px'>";
                            $bottons = "<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='".$showProducts[$i]["id"]."' data-toggle='modal' data-target='#EditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeleteProduct' idProduct='".$showProducts[$i]["id"]."' codeProduct='".$showProducts[$i]["code"]."' imageProduct='".$showProducts[$i]["image"]."' ><i class='fa fa-times'></i></button></div>";
                            if($showProducts[$i]["stock"] <= 5){
                                $stock = "<button class='btn btn-danger'>".$showProducts[$i]["stock"]."</button>";
                            }else if($showProducts[$i]["stock"] > 5 && $showProducts[$i]["stock"] <= 10){
                                $stock = "<button class='btn btn-warning'>".$showProducts[$i]["stock"]."</button>";
                            }else {
                                $stock = "<button class='btn btn-success'>".$showProducts[$i]["stock"]."</button>";
                            }
                            
                            $JsonData .= '[
                                "'.($i + 1).'",
                                "'.$iamge.'",
                                "'.$showProducts[$i]["code"].'",
                                "'.$showProducts[$i]["description"].'",
                                "'.$category["category"].'",
                                "'.$stock.'",
                                "IQD '.number_format($showProducts[$i]["buy_price"]).'",
                                "IQD '.number_format($showProducts[$i]["sell_price"]).'",
                                "'.$showProducts[$i]["date"].'",
                                "'.$bottons.'"
                                
                            ],';
                        }
                        $JsonData = substr($JsonData, 0, -1);
    $JsonData .=  ']
                }';
    echo $JsonData;

    }
}
$activeProducts = new TableProducts();
$activeProducts->showProductsTable();
?>