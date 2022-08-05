<?php
class ProductController{

    static public function ctrShowProducts($item,$value){
        $table = "products";
        $answer = ProductModel::MdlShowProducts($table, $item, $value);

		return $answer;
    }

    static public function ctrShowLatestProducts($item,$value){
        $table = "products";
        $answer = ProductModel::MdlShowLatestProducts($table, $item, $value);

		return $answer;
    }


// peshandany zortren forshraw la reprots
    static public function ctrShowProductsForReport($item,$value){
        $table = "products";
        $answer = ProductModel::mdlShowProductsForReport($table, $item, $value);

		return $answer;
    }
    // peshandany totalsale la products
    static public function ctrShowAddingOfTheSales(){
        $table = "products";
        $answer = ProductModel::MdlShowAddingOfTheSales($table);

		return $answer;
    }
    static public function ctrAddProduct(){
                
        if (isset($_POST["newDescription"])) {
            if(preg_match('/^[0-9]+$/', $_POST["newStock"])&&
                preg_match('/^[0-9,]+$/', $_POST["newSell"])&&
                preg_match('/^[0-9,]+$/', $_POST["newBuy"])){

                /*=============================================
				VALIDATE IMAGE
				=============================================*/

				$photo = "";
			
				if (isset($_FILES["newImage"]["tmp_name"])){

					list($width, $height) = getimagesize($_FILES["newImage"]["tmp_name"]);
					
					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					Let's create the folder for each user
					=============================================*/

					$folder = "views/img/products/".$_POST["newCode"];

					mkdir($folder, 0755);

					/*=============================================
					PHP functions depending on the image
					=============================================*/

					if($_FILES["newImage"]["type"] == "image/jpeg"){

						$randomNumber = mt_rand(100,999);
						
						$photo = "views/img/products/".$_POST["newCode"]."/".$randomNumber.".jpg";
						
						$srcImage = imagecreatefromjpeg($_FILES["newImage"]["tmp_name"]);
						
						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);

					}

					if ($_FILES["newImage"]["type"] == "image/png") {

						$randomNumber = mt_rand(100,999);
						
						$photo = "views/img/products/".$_POST["newCode"]."/".$randomNumber.".png";
						
						$srcImage = imagecreatefrompng($_FILES["newImage"]["tmp_name"]);
						
						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}

				}
                $table = "products";
                $datas = array("id_category" =>$_POST["newCategory"],
                                "code" =>$_POST["newCode"],
                                "description" =>$_POST["newDescription"],
                                "stock" =>$_POST["newStock"],
                                "buy_price" =>$_POST["newBuy"],
                                "sell_price" =>$_POST["newSell"],
                                "image" =>$photo);
                $answer = ProductModel::mdlAddProduct($table, $datas);
                if ($answer =="ok") {
                    echo '<script>
                    
                        swal({
                            type: "success",
                            title: "کاڵاکە بە سەرکەوتووی زیاد کرا",
                            showConfirmButton: true,
                            confirmButtonText: "داخستن"

                        }).then(function(result){

                            if(result.value){

                                window.location = "products";
                            }

                        });
                        
                        </script>';
            }else{

                        echo '<script>
                            
                            swal({
                                type: "error",
                                title: "تکایە پیتی گونجاو بەکار بێنە لە خانەکان",
                                showConfirmButton: true,
                                confirmButtonText: "Close"
                    
                                }).then(function(result){

                                    if(result.value){

                                        window.location = "products";
                                    }

                                });
                            
                        </script>';
			    }
            }
            
        }
    }
    static public function ctrEditProduct(){
        if (isset($_POST["editDescription"])) {
            if(preg_match('/^[0-9]+$/', $_POST["editStock"])&&
            preg_match('/^[0-9,]+$/', $_POST["editSell"])&&
            preg_match('/^[0-9,]+$/', $_POST["editBuy"])){
                $photo = $_POST["actualImage"];
                if (isset($_FILES["editImage"]["tmp_name"]) && !empty($_FILES["editImage"]["tmp_name"])){

					list($width, $height) = getimagesize($_FILES["editImage"]["tmp_name"]);
					
					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					Let's create the folder for each image
					=============================================*/

					$folder = "views/img/products/".$_POST["editCode"];

                    if(!empty($_POST["actualImage"]) && $_POST["actualImage"] != "views/img/products/anonymous.png"){
                        unlink($_POST["actualImage"]);
                    }else {
                        mkdir($folder, 0755);
                    }

					

					/*=============================================
					PHP functions depending on the image
					=============================================*/

					if($_FILES["editImage"]["type"] == "image/jpeg"){

						$randomNumber = mt_rand(100,999);
						
						$photo = "views/img/products/".$_POST["editCode"]."/".$randomNumber.".jpg";
						
						$srcImage = imagecreatefromjpeg($_FILES["editImage"]["tmp_name"]);
						
						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);

					}

					if ($_FILES["editImage"]["type"] == "image/png") {

						$randomNumber = mt_rand(100,999);
						
						$photo = "views/img/products/".$_POST["editCode"]."/".$randomNumber.".png";
						
						$srcImage = imagecreatefrompng($_FILES["editImage"]["tmp_name"]);
						
						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}

				}
                $table = "products";
                $datas = array("id_category" =>$_POST["editCategory"],
                                "code" =>$_POST["editCode"],
                                "description" =>$_POST["editDescription"],
                                "stock" =>$_POST["editStock"],
                                "buy_price" =>$_POST["editBuy"],
                                "sell_price" =>$_POST["editSell"],
                                "image" =>$photo);
                $answer = ProductModel::mdlEditProduct($table, $datas);
                if ($answer =="ok") {
                    echo '<script>
                    
                        swal({
                            type: "success",
                            title: "گۆرانکاری لە کاڵاکە کرا",
                            showConfirmButton: true,
                            confirmButtonText: "داخستن"

                        }).then(function(result){

                            if(result.value){

                                window.location = "products";
                            }

                        });
                        
                        </script>';
            }else{

                        echo '<script>
                            
                            swal({
                                type: "error",
                                title: "تکایە پیتی گونجاو بەکار بێنە لە خانەکان",
                                showConfirmButton: true,
                                confirmButtonText: "Close"
                    
                                }).then(function(result){

                                    if(result.value){

                                        window.location = "products";
                                    }

                                });
                            
                        </script>';
			    }
            
            }
        }
    }
    static public function ctrDeleteProduct(){
        if(isset($_GET["idProduct"])){
            $table = "products";
            $data = $_GET["idProduct"];
            if($_GET["imageProduct"] != "" && $_GET["imageProduct"] != "views/img/products/anonymous.png"){
                unlink($_GET["imageProduct"]);
                rmdir("views/img/products/".$_GET["codeProduct"]);
            }
            $answer = ProductModel::mdlDeleteProduct($table,$data);
            if ($answer =="ok") {
                echo '<script>
                
                    swal({
                        type: "success",
                        title: "کاڵاکە بە سەرکەوتووی سرایەوە",
                        showConfirmButton: true,
                        confirmButtonText: "داخستن"

                    }).then(function(result){

                        if(result.value){

                            window.location = "products";
                        }

                    });
                    
                    </script>';
        }else{

                    echo '<script>
                        
                        swal({
                            type: "error",
                            title: "نەتواندرا کاڵاکە بسردرێتەوە",
                            showConfirmButton: true,
                            confirmButtonText: "داخستن"
                
                            }).then(function(result){

                                if(result.value){

                                    window.location = "products";
                                }

                            });
                        
                    </script>';
            }
        }
    }
}
?>