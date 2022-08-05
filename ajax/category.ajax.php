<?php 
require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class ajaxCategory {
    /*=============================================
	VALIDATE IF Category ALREADY EXISTS
	=============================================*/

	public $validateCategory;

	public function ajaxValidateCategory(){

		$item = "category";
		$value = $this->validateCategory;

		$answer = CategoryController::ctrShowCategories($item, $value);

		echo json_encode($answer);

	}
	public $idCategory;
	public function ajaxEditCategory(){

		$item = "id";
		$value = $this->idCategory;

		$answer = CategoryController::ctrShowCategories($item, $value);

		echo json_encode($answer);
	}
}
if (isset($_POST["validateCategory"])) {

	$valCategory = new ajaxCategory();
	$valCategory -> validateCategory = $_POST["validateCategory"];
	$valCategory -> ajaxValidateCategory();
}

if (isset($_POST["idCategory"])) {

	$editCategory = new ajaxCategory();
	$editCategory -> idCategory = $_POST["idCategory"];
	$editCategory -> ajaxEditCategory();
}
?>