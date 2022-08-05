<?php 
require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class ajaxProduct{
    public $idCategore;
    /*=============================================
code for Products per category 
=============================================*/
    public function ajaxProductCode(){
        $item = "id_category";
        $value = $this->idCategore;
        $answer = ProductController::ctrShowProducts($item,$value);
        echo json_encode($answer);
    }
    /*=============================================
Edit Product 
=============================================*/
    public $idProduct;
    public $bringProducts;
    public $nameProduct;
    public function ajaxEditProduct(){

        if($this->bringProducts == "ok"){
            $item = null;
        $value = null;
        $answer = ProductController::ctrShowProducts($item,$value);
        echo json_encode($answer);
        } 
        else if($this->nameProduct != ""){
            $item = "description";
        $value = $this->nameProduct;
        $answer = ProductController::ctrShowProducts($item,$value);
        echo json_encode($answer);
        }
        else{
        $item = "id";
        $value = $this->idProduct;
        $answer = ProductController::ctrShowProducts($item,$value);
        echo json_encode($answer);
        }
    }

    
}
if(isset($_POST["idCategore"])){
    $productCode = new ajaxProduct();
    $productCode->idCategore = $_POST["idCategore"];
    $productCode->ajaxProductCode();
}

if(isset($_POST["idProduct"])){
    $editproduct = new ajaxProduct();
    $editproduct->idProduct = $_POST["idProduct"];
    $editproduct->ajaxEditProduct();
}

/*=============================================
add products from devices
=============================================*/

if(isset($_POST["bringProducts"])){
    $bringproduct = new ajaxProduct();
    $bringproduct->bringProducts = $_POST["bringProducts"];
    $bringproduct->ajaxEditProduct();
}
/*=============================================
select products from devices
=============================================*/
if(isset($_POST["nameProduct"])){
    $selectproduct = new ajaxProduct();
    $selectproduct->nameProduct = $_POST["nameProduct"];
    $selectproduct->ajaxEditProduct();
}
?> 
