<?php 
require_once "connection.php";

class SaleModel {
    static public function MdlShowsales($table,$item ,$value){
        if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
			
			if ($stmt->execute()) {
			
				return 'ok';
			
			} else {
				
				return 'error';
			}

		}else {
			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		
		$stmt -> close();

		$stmt = null;
    }

	static public function mdlAddSale($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, idCustomer, idSeller, products, discount, net, total, paymentMethod) VALUES (:code, :idCustomer, :idSeller, :products, :discount, :net, :total, :paymentMethod)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idCustomer", $data["idCustomer"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":discount", $data["discount"], PDO::PARAM_STR);
		$stmt->bindParam(":net", $data["net"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $data["total"], PDO::PARAM_STR);
		$stmt->bindParam(":paymentMethod", $data["paymentMethod"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlEditSale($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET idCustomer = :idCustomer , idSeller = :idSeller , products = :products , discount = :discount , net = :net , total = :total , paymentMethod = :paymentMethod WHERE code = :code");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idCustomer", $data["idCustomer"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":discount", $data["discount"], PDO::PARAM_STR);
		$stmt->bindParam(":net", $data["net"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $data["total"], PDO::PARAM_STR);
		$stmt->bindParam(":paymentMethod", $data["paymentMethod"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlDeleteSale($table, $data){
		
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
    show sales by date ranges
=============================================*/

	static public function MdlShowRangeSales($table,$startDate ,$endDate){
        if($startDate == null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else if($startDate == $endDate){
			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE date LIKE '%$endDate%'");
			$stmt -> bindParam(":date", $endDate, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetchAll();
		}else {
			// bo neshandany today sale la last 7 day w  last 30 days
			$actualDate = new DateTime();
			$actualDate ->add(new DateInterval("P1D"));
			$actualDatePlusOne = $actualDate->format("Y-m-d");

			$finalDate2 = new DateTime($endDate);
			$finalDate2 ->add(new DateInterval("P1D"));
			$finalDatePlusOne = $finalDate2->format("Y-m-d");
			if($finalDatePlusOne == $actualDatePlusOne){
				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE date BETWEEN '$startDate' AND '$finalDatePlusOne'");
			}else {
				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE date BETWEEN '$startDate' AND '$endDate'");
			}
			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		
		
		$stmt -> close();

		$stmt = null;
    }

	/*=============================================
    adding total sales
	=============================================*/
	static public function MdlAddTotalSales($table){
		$stmt = Connection::connect()->prepare("SELECT SUM(total) AS totalprice FROM $table");
		
		$stmt -> execute();
		
		return $stmt -> fetch();
		
		$stmt -> close();

		$stmt = null;
	}
	
}

?>