<?php 

require_once "../controllers/customers.controller.php";
require_once "../models/customers.model.php";

class ajaxCustomer {
    public $idCustomer;
    public function ajaxEditCustomer(){
        $item = "id";
        $value = $this->idCustomer;
        $answer = CustomerController::ctrShowCustomers($item,$value);
        echo json_encode($answer);
    }
}
if (isset($_POST["idCustomer"])) {

	$editCustomer = new ajaxCustomer();
	$editCustomer -> idCustomer = $_POST["idCustomer"];
	$editCustomer -> ajaxEditCustomer();
}
?>