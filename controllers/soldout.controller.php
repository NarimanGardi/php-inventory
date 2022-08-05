<?php 
class SoldOutController {
    static public function ctrShowSoldOut($item, $value){

		$table = "products";

		$answer = SoldOutModel::MdlShowSoldOut($table, $item, $value);

		return $answer;
	}
    static public function ctrEditStock() {
        if(isset($_POST["renewStock"])){
			if (preg_match('/^[0-9,]+$/', $_POST["renewStock"])){
				$table = "products";
				$datas =array("stock"=> $_POST["renewStock"],
							"id"=> $_POST["idstock"]	);
				$answer = SoldOutModel::mdlEditStock($table,$datas);
				if($answer == "ok"){
					echo '<script>
						
						swal({
							type: "success",
							title: "عددی کاڵاکە نوێکرایەوە",
							showConfirmButton: true,
							confirmButtonText: "داخستن"

						}).then(function(result){

							if(result.value){

								window.location = "soldout";
							}

						});
						
						</script>';
				}
				
			}else {
				echo '<script>
					
					swal({
						type: "error",
						title: "تکایە پیتی گونجاو بەکار بێنە لە خانەکان",
						showConfirmButton: true,
						confirmButtonText: "داخستن"
			
						}).then(function(result){

							if(result.value){

								window.location = "soldout";
							}

						});
					
				</script>';
			}
		}
    }

}

?>