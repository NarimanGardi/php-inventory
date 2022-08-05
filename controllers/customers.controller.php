<?php 

class CustomerController
{
    public static function ctrAddCustomer()
    {
        if (isset($_POST["newCustomer"])) {
            if (preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newCustomer"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone"]) &&
                preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newAddress"])) {
                $table = "customers";
                $datas = array("name"=>$_POST["newCustomer"],
                                "phone"=>$_POST["newPhone"],
                                "address"=>$_POST["newAddress"]);
                $answer = CustomerModel::mdlAddCustomer($table, $datas);
                if ($answer =="ok") {
                    echo '<script>
						
						swal({
							type: "success",
							title: "کریارەکە زیاد کرا",
							showConfirmButton: true,
							confirmButtonText: "داخستن"

						}).then(function(result){

							if(result.value){

								window.location = "customers";
							}

						});
						
						</script>';
                }
            } else {
                echo '<script>
					
					swal({
						type: "error",
						title: "تکایە پیتی گونجاو بەکار بێنە لە خانەکان",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "customers";
							}

						});
					
				</script>';
            }
        }
    }

    public static function ctrAddCustomerFromSales()
    {
        if (isset($_POST["newCustomer1"])) {
            if (preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newCustomer1"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone1"]) &&
                preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newAddress1"])) {
                $table = "customers";
                $datas = array("name"=>$_POST["newCustomer1"],
                                "phone"=>$_POST["newPhone1"],
                                "address"=>$_POST["newAddress1"]);
                $answer = CustomerModel::mdlAddCustomer($table, $datas);
                if ($answer =="ok") {
                    echo '<script>
						
						swal({
							type: "success",
							title: "کریارەکە زیاد کرا",
							showConfirmButton: true,
							confirmButtonText: "داخستن"

						}).then(function(result){

							if(result.value){

								window.location = "create-sales";
							}

						});
						
						</script>';
                }
            } else {
                echo '<script>
					
					swal({
						type: "error",
						title: "تکایە پیتی گونجاو بەکار بێنە لە خانەکان",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "create-sales";
							}

						});
					
				</script>';
            }
        }
    }

    public static function ctrShowCustomers($item, $value)
    {
        $table = "customers";

        $answer = CustomerModel::mdlShowCustomers($table, $item, $value);

        return $answer;
    }
    public static function ctrEditCustomer()
    {
        if (isset($_POST["editCustomer"])) {
            if (preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editCustomer"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["editPhone"]) &&
                preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editAddress"])) {
                $table = "customers";
                $datas = array("id"=>$_POST["idCustomer"],
                                "name"=>$_POST["editCustomer"],
                                "phone"=>$_POST["editPhone"],
                                "address"=>$_POST["editAddress"]);
                $answer = CustomerModel::mdlEditCustomer($table, $datas);
                if ($answer == "ok") {
                    echo '<script>
						
						swal({
							type: "success",
							title: "گۆرانکاری لە کریارەکە کرا",
							showConfirmButton: true,
							confirmButtonText: "داخستن"

						}).then(function(result){

							if(result.value){

								window.location = "customers";
							}

						});
						
						</script>';
                }
            } else {
                echo '<script>
					
					swal({
						type: "error",
						title: "تکایە پیتی گونجاو بەکار بێنە لە خانەکان",
						showConfirmButton: true,
						confirmButtonText: "داخستن"
			
						}).then(function(result){

							if(result.value){

								window.location = "customers";
							}

						});
					
				</script>';
            }
        }
    }
    public static function ctrDeleteCustomer()
    {
        if (isset($_GET["idCustomer"])) {
            $table ="customers";
            $data = $_GET["idCustomer"];
            $answer = CustomerModel::mdlDeleteCustomer($table, $data);
            if ($answer == "ok") {
                echo '<script>
					
					swal({
						type: "success",
						title: "کریارەکە بە سەرکەوتووی سرایەوە",
						showConfirmButton: true,
						confirmButtonText: "داخستن"

					}).then(function(result){

						if(result.value){

							window.location = "customers";
						}

					});
					
					</script>';
            }
        }
    }
}
?>

