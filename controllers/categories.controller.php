<?php 

Class CategoryController {

	static public function ctrShowCategories($item, $value){

		$table = "categories";

		$answer = CategoryModel::MdlShowCategories($table, $item, $value);

		return $answer;
	}

    static public function ctrAddCategory(){
        if(isset($_POST["newCategory"])){
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])){
                $table = "categories";
                $datas = $_POST["newCategory"];
                $answer = CategoryModel::mdlAddCategory($table,$datas);
                if($answer =="ok"){
                    echo '<script>
						
						swal({
							type: "success",
							title: "بابەتەکە بە سەرکەوتووی زیاد کرا",
							showConfirmButton: true,
							confirmButtonText: "داخستن"

						}).then(function(result){

							if(result.value){

								window.location = "categories";
							}

						});
						
						</script>';
                }
            }else{

				echo '<script>
					
					swal({
						type: "error",
						title: "تکایە پیتی گونجاو بەکار بێنە لە خانەکان",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "categories";
							}

						});
					
				</script>';
			}
        }
    }

   
	static public function ctrEditCategory(){
		if(isset($_POST["editCategory"])){
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCategory"])){
				$table = "categories";
				$datas =array("category"=> $_POST["editCategory"],
							"id"=> $_POST["idCategory"]	);
				$answer = CategoryModel::mdlEditCategory($table,$datas);
				if($answer == "ok"){
					echo '<script>
						
						swal({
							type: "success",
							title: "گۆرانکاری لە بابەتەکە کرا",
							showConfirmButton: true,
							confirmButtonText: "داخستن"

						}).then(function(result){

							if(result.value){

								window.location = "categories";
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

								window.location = "categories";
							}

						});
					
				</script>';
			}
		}
	}
	static public function ctrDeleteCategory(){
        if (isset($_GET["idCategory"])) {
            $table ="categories";
            $data = $_GET["idCategory"];
			$answer = CategoryModel::mdlDeleteCategory($table,$data);
			if($answer == "ok"){
				echo '<script>
					
					swal({
						type: "success",
						title: "بابەکەتە بە سەرکەوتووی سرایەوە",
						showConfirmButton: true,
						confirmButtonText: "Close"

					}).then(function(result){

						if(result.value){

							window.location = "categories";
						}

					});
					
					</script>';
			}
        }
	}
}

?>

