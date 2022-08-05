<?php 
require_once "connection.php";
class CustomerModel {
    static public function mdlAddCustomer($table,$datas){
        $stmt = Connection::connect()->prepare("INSERT INTO $table(name , phone , address) VALUES (:name , :phone , :address)");

		$stmt -> bindParam(":name", $datas["name"], PDO::PARAM_STR);
        $stmt -> bindParam(":phone", $datas["phone"], PDO::PARAM_STR);
        $stmt -> bindParam(":address", $datas["address"], PDO::PARAM_STR);
        if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		$stmt -> close();

		$stmt = null;
    }

    static public function mdlShowCustomers($table,$item,$value){
        if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
			
			if ($stmt->execute()) {
			
				return 'ok';
			
			} else {
				
				return 'error';
			}

		}else {
			$stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		
		$stmt -> close();

		$stmt = null;
    }
    static public function mdlEditCustomer($table,$datas){
        $stmt = Connection::connect()->prepare("UPDATE $table set name = :name , phone = :phone , address = :address WHERE id = :id ");
        $stmt -> bindParam(":id", $datas["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":name", $datas["name"], PDO::PARAM_STR);
        $stmt -> bindParam(":phone", $datas["phone"], PDO::PARAM_STR);
        $stmt -> bindParam(":address", $datas["address"], PDO::PARAM_STR);
		
		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		$stmt -> close();

		$stmt = null;
    }
    static public function mdlDeleteCustomer($table, $data){
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");
		
		$stmt -> bindParam(":id", $data, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {

			return 'error';
		
		}
		
		$stmt ->close();

		$stmt = null;
    }

	/*=============================================
    update customer pruchase
    =============================================*/

	static public function mdlUpdateCustomer($table, $item1, $value1, $value){

		$stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $value, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}
}

?>