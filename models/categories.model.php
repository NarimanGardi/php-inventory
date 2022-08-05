<?php 
require_once "connection.php";
class CategoryModel{
    static public function mdlAddCategory($table,$datas){
        $stmt = Connection::connect()->prepare("INSERT INTO $table(category) VALUES (:category)");

		$stmt -> bindParam(":category", $datas, PDO::PARAM_STR);

        if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		$stmt -> close();

		$stmt = null;
    }
    static public function MdlShowCategories($table,$item ,$value){
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
	static public function mdlEditCategory($table,$datas){
		$stmt = Connection::connect()->prepare("UPDATE $table set category = :category WHERE id = :id ");

		$stmt -> bindParam(":category", $datas["category"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datas["id"], PDO::PARAM_INT);
		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		$stmt -> close();

		$stmt = null;
	}

	static public function mdlDeleteCategory($table, $data){
		
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
}

?>