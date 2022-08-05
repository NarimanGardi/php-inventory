<?php 

class QarzController {
    static public function ctrShowQarz($item, $value){

		$table = "sales";

		$answer = QarzModel::MdlShowQarz($table, $item, $value);

		return $answer;
	}
    static public function ctrEditQarz() {
        if(isset($_POST["changePayment"])){
				$table = "sales";
				$datas =array("payment"=> $_POST["changePayment"],
							"id"=> $_POST["idPayment"]	);
				$answer = QarzModel::mdlEditQarz($table,$datas);
				if($answer == "ok"){
					echo '<script>
						
						swal({
							type: "success",
							title: "قەرزەکە بە سەرکەوتووی درایەوە",
							showConfirmButton: true,
							confirmButtonText: "داخستن"

						}).then(function(result){

							if(result.value){

								window.location = "qarz";
							}

						});
						
						</script>';
			}
		}
    }
}
?>