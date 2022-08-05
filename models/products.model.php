<?php 
require_once "connection.php";
class ProductModel{
    static public function MdlShowProducts($table,$item ,$value){
        if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");

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
	static public function MdlShowLatestProducts($table,$item ,$value){
        
			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();
		
			$stmt -> close();

			$stmt = null;
    }
	// peshandany zortren forshraw la reprots
	static public function mdlShowProductsForReport($table,$item ,$value){
        if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
			
			if ($stmt->execute()) {
			
				return 'ok';
			
			} else {
				
				return 'error';
			}

		}else {
			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY sell_quantity DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		
		$stmt -> close();

		$stmt = null;
    }

	static public function mdlAddProduct($table,$datas){
		$stmt = Connection::connect()->prepare("INSERT INTO $table(id_category , code , description , stock , buy_price , sell_price
		, image ) VALUES (:id_category, :code , :description , :stock , :buy_price , :sell_price , :image)");

		$stmt -> bindParam(":id_category", $datas["id_category"], PDO::PARAM_INT);
		$stmt -> bindParam(":code", $datas["code"], PDO::PARAM_INT);
		$stmt -> bindParam(":description", $datas["description"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datas["stock"], PDO::PARAM_INT);
		$stmt -> bindParam(":buy_price", $datas["buy_price"], PDO::PARAM_INT);
		$stmt -> bindParam(":sell_price", $datas["sell_price"], PDO::PARAM_INT);
		$stmt -> bindParam(":image", $datas["image"], PDO::PARAM_STR);

        if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		$stmt -> close();

		$stmt = null;
	}
	static public function mdlEditProduct($table,$datas){
		$stmt = Connection::connect()->prepare("UPDATE $table SET id_category = :id_category  , description = :description , stock = :stock , buy_price = :buy_price , sell_price =:sell_price 
		, image = :image WHERE code = :code ");

		$stmt -> bindParam(":id_category", $datas["id_category"], PDO::PARAM_INT);
		$stmt -> bindParam(":code", $datas["code"], PDO::PARAM_INT);
		$stmt -> bindParam(":description", $datas["description"], PDO::PARAM_STR);
		$stmt -> bindParam(":stock", $datas["stock"], PDO::PARAM_INT);
		$stmt -> bindParam(":buy_price", $datas["buy_price"], PDO::PARAM_INT);
		$stmt -> bindParam(":sell_price", $datas["sell_price"], PDO::PARAM_INT);
		$stmt -> bindParam(":image", $datas["image"], PDO::PARAM_STR);

        if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		$stmt -> close();

		$stmt = null;
	}

	static public function mdlDeleteProduct($table, $data){
		
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
    update pruchase and reduce stocks
    =============================================*/

	static public function mdlUpdateProduct($table, $item1, $value1 ,$value2){

		$stmt = Connection::connect()->prepare("UPDATE $table set $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $value2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {

			return 'error';
		
		}
		
		$stmt -> close();

		$stmt = null;
	}

	static public function mdlShowAddingOfTheSales($table){
		$stmt = Connection::connect()->prepare("SELECT SUM(sell_quantity) AS total FROM $table");
		
		$stmt -> execute();
		
		return $stmt -> fetch();
		
		$stmt -> close();

		$stmt = null;
	}
}

?>
