<?php 
require_once "connection.php"; 
class QarzModel {
    static public function MdlShowQarz($table,$item ,$value){
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
			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE paymentMethod = 'قەرد'");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		
		$stmt -> close();

		$stmt = null;
    }

    static public function mdlEditQarz($table,$datas){
		$stmt = Connection::connect()->prepare("UPDATE $table set paymentMethod = :paymentMethod WHERE id = :id ");

		$stmt -> bindParam(":paymentMethod", $datas["payment"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datas["id"], PDO::PARAM_INT);
		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		$stmt -> close();

		$stmt = null;
	}
}

?>