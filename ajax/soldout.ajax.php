<?php 
require_once "../controllers/soldout.controller.php";
require_once "../models/soldout.model.php";
class ajaxSoldOut {
    public $idProductStock;
    public function ajaxRenewProductStock(){
        $item = "id";
        $value = $this->idProductStock;
        $answer = SoldOutController::ctrShowSoldOut($item,$value);
        echo json_encode($answer);
    }
}
if(isset($_POST["idProductStock"])){
    $renewStock = new ajaxSoldOut();
    $renewStock->idProductStock = $_POST["idProductStock"];
    $renewStock->ajaxRenewProductStock();
}

?>