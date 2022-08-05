<?php 
require_once "../controllers/qarz.controller.php";
require_once "../models/qarz.model.php";
class ajaxQarz {
    public $idSale;
    public function ajaxChangePaymentMethod(){
        $item = "id";
        $value = $this->idSale;
        $answer = QarzController::ctrShowQarz($item,$value);
        echo json_encode($answer);
    }
}
if(isset($_POST["idSale"])){
    $ChangePayment = new ajaxQarz();
    $ChangePayment->idSale = $_POST["idSale"];
    $ChangePayment->ajaxChangePaymentMethod();
}

?>