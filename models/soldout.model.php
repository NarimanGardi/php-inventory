<?php 
require_once "connection.php"; 

class SoldOutModel {
    static public function MdlShowSoldOut($table,$item ,$value){
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
			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE stock = 0");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		
		$stmt -> close();

		$stmt = null;
    }
    static public function mdlEditStock($table,$datas){
		$stmt = Connection::connect()->prepare("UPDATE $table set stock = :stock WHERE id = :id ");

		$stmt -> bindParam(":stock", $datas["stock"], PDO::PARAM_STR);
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