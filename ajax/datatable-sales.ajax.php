<?php 
require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";


Class TableProductsSale {
    public function showProductsTableSale(){
        $item = null;
        $value = null;
        $showProducts=  ProductController::ctrShowProducts($item,$value);
                
        $JsonData = '{
            "data": [';
                        for ($i=0; $i < count($showProducts); $i++) { 
                            $iamge = "<img src='".$showProducts[$i]["image"]."' width='40px'>";
                            $bottons = "<div class='btn-group'><button class='btn btn-primary addProduct recoverButton' idProduct='".$showProducts[$i]["id"]."'>Add</button></div>";
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
                                "'.$stock.'",
                                "'.$bottons.'"
                                
                            ],';
                        }
                        $JsonData = substr($JsonData, 0, -1);
    $JsonData .=  ']
                }';
    echo $JsonData;

    }
}
$activeProductsSale = new TableProductsSale();
$activeProductsSale->showProductsTableSale();
?>