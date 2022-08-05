<?php
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class SaleController {
    /*=============================================
    show sales
=============================================*/
    static public function ctrShowSales($item, $value) {

        $table = "sales";

		$answer = SaleModel::MdlShowsales($table, $item, $value);

		return $answer;
    }
    /*=============================================
    add Sale
=============================================*/

    public static function ctrCreateSale(){
        if(isset($_POST["newSale"])){

                /*=============================================
                update customer pruchase and reduce stocks
                =============================================*/
                // product stock and sell_quantity
                $productsList = json_decode($_POST["productsList"],true);

                // array for total purchase to customer
                $totalCustomerPurchase = array();
                foreach ($productsList as $key => $value) {
                    array_push($totalCustomerPurchase, $value["quantity"]);
                    $tableproducts = "products";
                    $item1 = "id";
                    $value1 = $value["id"];
                    $bringProducts = ProductModel::MdlShowProducts($tableproducts,$item1,$value1); 
                    /*=============================================
                    zyadkrdni sell_quantity la product dway froshtn
                    =============================================*/

                    $item2a = "sell_quantity";
                    $value2a = $value["quantity"] + $bringProducts["sell_quantity"];
                    // value 2 id ya la function aka la kotae danusret pechawanay era . lera value 1 id ya
                    $newSale = ProductModel::mdlUpdateProduct($tableproducts,$item2a,$value2a,$value1);

                    /*=============================================
                    kamkrdni stock la product dway froshtn
                    =============================================*/

                    $item2b = "stock";
                    $value2b = $value["stock"];
                    
                    $newStock = ProductModel::mdlUpdateProduct($tableproducts,$item2b,$value2b,$value1);

            }

                    /*=============================================
                    update customer pruchase 
                    =============================================*/
                    // selectiong customer
                    $tablecustomer = "customers";
                    $item3 = "id";
                    $value3 = $_POST["selectCustomer"];
                    $bringcustomer = CustomerModel::mdlShowCustomers($tablecustomer,$item3,$value3);
                    // adding total-pruchase for customer
                    $item4 = "totalpurchase";
                    $value4 = array_sum($totalCustomerPurchase) + $bringcustomer["totalpurchase"];
                    $customerPurchase = CustomerModel::mdlUpdateCustomer($tablecustomer,$item4,$value4,$value3);
                    // adding last pruchase for a customer
                    date_default_timezone_set('Asia/Baghdad');
                    $date = date('y-m-d');
                    $time = date('H:i:s');
                    $fullDate = $date .' '.$time;
                    $item5 = "last_purchase";
                    $value5 = $fullDate;
                    $customerLastPurchase = CustomerModel::mdlUpdateCustomer($tablecustomer,$item5,$value5,$value3);
                /*=============================================
                adding sale
                =============================================*/
                $tableSale = "sales";
                $datas = array("code" =>$_POST["newSale"],
                                "idCustomer" =>$_POST["selectCustomer"],
                                "idSeller" =>$_POST["idSeller"],
                                "products" =>$_POST["productsList"],
                                "discount" =>$_POST["newDiscountPrice"],
                                "net" =>$_POST["newNetPrice"],
                                "total" =>$_POST["saleTotal"],
                                "paymentMethod" =>$_POST["newPaymentMethod"]);
                                
                $answer = saleModel::mdlAddSale($tableSale, $datas);
                
                if ($answer =="ok") {

                // $printer = "epson20";

				// $connector = new WindowsPrintConnector($printer);

				// $printer = new Printer($connector);

				// $printer -> setJustification(Printer::JUSTIFY_CENTER);

				// $printer -> text(date("Y-m-d H:i:s")."\n");//Invoice date

				// $printer -> feed(1); //We feed paper 1 time*/

				// $printer -> text("Inventory System"."\n");//Company name

				// $printer -> text("ID: 71.759.963-9"."\n");//Company's ID

				// $printer -> text("Address: 5th Ave. Miami Fl"."\n");//Company address

				// $printer -> text("Phone: 300 786 52 49"."\n");//Company's phone

				// $printer -> text("Invoice N.".$_POST["newSale"]."\n");//Invoice number

				// $printer -> feed(1); //We feed paper 1 time*/

				// $printer -> text("Customer: ".$bringcustomer ["name"]."\n");//Customer's name

				// $tableSeller = "users";
				// $item = "id";
				// $seller = $_POST["idSeller"];

				// $getSeller = UsersModel::MdlShowUsers($tableSeller, $item, $seller);

				// $printer -> text("Seller: ".$getSeller["name"]."\n");//Seller's name

				// $printer -> feed(1); //We feed paper 1 time*/

				// foreach ($productsList as $key => $value) {

				// 	$printer->setJustification(Printer::JUSTIFY_LEFT);

				// 	$printer->text($value["description"]."\n");//Product's name

				// 	$printer->setJustification(Printer::JUSTIFY_RIGHT);

				// 	$printer->text("$ ".number_format($value["price"],2)." Und x ".$value["quantity"]." = $ ".number_format($value["totalprice"],2)."\n");

				// }

				// $printer -> feed(1); //We feed paper 1 time*/			
				
				// $printer->text("NET: $ ".number_format($_POST["newNetPrice"],2)."\n"); //net price

				// $printer->text("Discount: $ ".number_format($_POST["newDiscountPrice"],2)."\n"); //tax value

				// $printer->text("--------\n");

				// $printer->text("TOTAL: $ ".number_format($_POST["saleTotal"],2)."\n"); //ahora va el total

				// $printer -> feed(1); //We feed paper 1 time*/	

				// $printer->text("Thanks for your purchase"); //We can add a footer

				// $printer -> feed(3); //We feed paper 3 times*/

				// $printer -> cut(); //We cut the paper, if the printer has the option

				// $printer -> pulse(); //Through the printer we send a pulse to open the cash drawer.

				// $printer -> close();
                    echo '<script>
                    
                        swal({
                            type: "success",
                            title: "فرۆشتنەکە بە سەرکەوتووی ئەنجام درا",
                            showConfirmButton: true,
                            confirmButtonText: "داخستن"

                        }).then(function(result){

                            if(result.value){

                                window.location = "manage-sales";
                            }

                        });
                        
                        </script>';
                
            }   
        }
    }

    /*=============================================
    edit Sale
=============================================*/
    static public function ctrEditSales(){
        if(isset($_POST["editSale"])){

            /*=============================================
            FORMAT PRODUCTS AND CUSTOMERS TABLES
            =============================================*/
            $table = "sales";
            
            $item = "code";
            $value = $_POST["editSale"];
            
            $getSale = saleModel::MdlShowsales($table, $item, $value);
            
            /*=============================================
            CHECK IF THERE'S ANY EDITED SALE
            =============================================*/
            
            
            if($_POST["productsList"] == ""){
            
                $productsList = $getSale["products"];
                $productChange = false;
            
            
            }else{
            
                $productsList = $_POST["productsList"];
                $productChange = true;
            }
            
            if($productChange){
            
                $products =  json_decode($getSale["products"], true);
            
                $totalPurchasedProducts = array();
            
                foreach ($products as $key => $value) {				
            
                    array_push($totalPurchasedProducts, $value["quantity"]);	
            
                    $tableProducts = "products";
            
                    $item = "id";
                    $value1 = $value["id"];
            
                    $getProduct = ProductModel::MdlShowProducts($tableProducts, $item, $value1);
                    
                    $item1b = "stock";
                    $value1b = $value["quantity"] + $getProduct["stock"];
            
                    $stockNew = ProductModel::mdlUpdateProduct($tableProducts, $item1b, $value1b, $value1);
            
                    $item1a = "sell_quantity";
                    $value1a = $getProduct["sell_quantity"] - $value["quantity"];
            
                    $newSales = ProductModel::mdlUpdateProduct($tableProducts, $item1a, $value1a, $value1);

                }
            
                $tableCustomers = "customers";
            
                $itemCustomer = "id";
                $valueCustomer = $_POST["selectCustomer"];
            
                $getCustomer = CustomerModel::mdlShowCustomers($tableCustomers, $itemCustomer, $valueCustomer);
            
                $item1a = "totalpurchase";
                $value1a = $getCustomer["totalpurchase"] - array_sum($totalPurchasedProducts);
            
                $customerPurchases = CustomerModel::mdlUpdateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);
            
                /*=============================================
                UPDATE THE CUSTOMER'S PURCHASES AND REDUCE THE STOCK AND INCREMENT PRODUCT SALES
                =============================================*/
            
                $productsList_2 = json_decode($productsList, true);
            
                $totalPurchasedProducts_2 = array();
            
                foreach ($productsList_2 as $key => $value) {
            
                    array_push($totalPurchasedProducts_2, $value["quantity"]);
                    
                    $tableProducts_2 = "products";
            
                    $item_2 = "id";
                    $value_2 = $value["id"];
            
                    $getProduct_2 = ProductModel::MdlShowProducts($tableProducts_2, $item_2, $value_2);
            
                    $item1a_2 = "sell_quantity";
                    $value1a_2 = $value["quantity"] + $getProduct_2["sell_quantity"];
            
                    $newSales_2 = ProductModel::mdlUpdateProduct($tableProducts_2, $item1a_2, $value1a_2, $value_2);
            
                    $item1b_2 = "stock";
                    $value1b_2 = $getProduct_2["stock"] - $value["quantity"];
            
                    $newStock_2 = ProductModel::mdlUpdateProduct($tableProducts_2, $item1b_2, $value1b_2, $value_2);
            
                }
            
                $tableCustomers_2 = "customers";
            
                $item_2 = "id";
                $value_2 = $_POST["selectCustomer"];
            
                $getCustomer_2 = CustomerModel::mdlShowCustomers($tableCustomers_2, $item_2, $value_2);
            
                $item1a_2 = "totalpurchase";
                $value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["totalpurchase"];
            
                $customerPurchases_2 = CustomerModel::mdlUpdateCustomer($tableCustomers_2, $item1a_2, $value1a_2, $value_2);
            
                $item1b_2 = "last_purchase";
            
                date_default_timezone_set('Asia/Baghdad');
            
                $date = date('Y-m-d');
                $hour = date('H:i:s');
                $value1b_2 = $date.' '.$hour;
            
                $dateCustomer_2 = CustomerModel::mdlUpdateCustomer($tableCustomers_2, $item1b_2, $value1b_2, $value_2);
            
            }
            
            /*=============================================
            SAVE PURCHASE CHANGES
            =============================================*/	
            
            $datas = array("code" =>$_POST["editSale"],
                                        "idCustomer" =>$_POST["selectCustomer"],
                                        "idSeller" =>$_POST["idSeller"],
                                        "products" =>$productsList,
                                        "discount" =>$_POST["newDiscountPrice"],
                                        "net" =>$_POST["newNetPrice"],
                                        "total" =>$_POST["saleTotal"],
                                        "paymentMethod" =>$_POST["newPaymentMethod"]);
                                        
                        $answer = saleModel::mdlEditSale($table, $datas);
                        var_dump($answer);
                        if ($answer =="ok") {
                            echo '<script>
                            
                                swal({
                                    type: "success",
                                    title: "گۆرانکاری لە فرۆشتنەکە کرا",
                                    showConfirmButton: true,
                                    confirmButtonText: "داخستن"
            
                                }).then(function(result){
            
                                    if(result.value){
            
                                        window.location = "manage-sales";
                                    }
            
                                });
                                
                                </script>';
                        
            }   
        }
    }

/*=============================================
    delete Sale
=============================================*/
    static public function ctrDeleteSale() {
        if(isset($_GET["idSale"])) {
            $table = "sales";
            $tableCustomers = "customers";
            $item = "id";
            $value = $_GET["idSale"];

            $bringSale = SaleModel::MdlShowsales($table,$item, $value);

            $item1 = null;
            $value1 = null;

            $bringAllSale = SaleModel::MdlShowsales($table,$item1, $value1);
            // deleting last pruchase date in customer table
            $saveDates = array();
            foreach ($bringAllSale as $key => $value) {
                if($value["idCustomer"] == $bringSale["idCustomer"]){
                    array_push($saveDates, $value["date"]);
                }
                
            }
            if(count($saveDates) > 1) {
                if($bringSale["date"] > $saveDates[count($saveDates)-2]){
                    $item2a = "last_purchase";
                    $value2a = $saveDates[count($saveDates)-2];
                    $valueIdCustomer2a = $bringSale["idCustomer"];
                $customerLastPurchase = CustomerModel::mdlUpdateCustomer($tableCustomers,$item2a,$value2a,$valueIdCustomer2a);
                }else {
                    $item2b = "last_purchase";
                    $value2b = $saveDates[count($saveDates)-1];
                    $valueIdCustomer2b = $bringSale["idCustomer"];
                    $customerLastPurchase = CustomerModel::mdlUpdateCustomer($tableCustomers,$item2b,$value2b,$valueIdCustomer2b);
                }
            }else {
                $item2 = "last_purchase";
                $value2 = "0000-00-00 00:00:00";
                $valueIdCustomer = $bringSale["idCustomer"];
                $customerLastPurchase = CustomerModel::mdlUpdateCustomer($tableCustomers,$item2,$value2,$valueIdCustomer);
            
            }

            /*=============================================
                formating data while deleting Sale
            =============================================*/

            $products =  json_decode($bringSale["products"], true);
            
                $totalPurchasedProducts = array();
            
                foreach ($products as $key => $value) {				
            
                    array_push($totalPurchasedProducts, $value["quantity"]);	
            
                    $tableProducts = "products";
            
                    $item = "id";
                    $value1 = $value["id"];
            
                    $getProduct = ProductModel::MdlShowProducts($tableProducts, $item, $value1);
                    
                    $item1b = "stock";
                    $value1b = $value["quantity"] + $getProduct["stock"];
            
                    $stockNew = ProductModel::mdlUpdateProduct($tableProducts, $item1b, $value1b, $value1);
            
                    $item1a = "sell_quantity";
                    $value1a = $getProduct["sell_quantity"] - $value["quantity"];
            
                    $newSales = ProductModel::mdlUpdateProduct($tableProducts, $item1a, $value1a, $value1);

                }
            
                $tableCustomers = "customers";
            
                $itemCustomer = "id";
                $valueCustomer = $bringSale["idCustomer"];
            
                $getCustomer = CustomerModel::mdlShowCustomers($tableCustomers, $itemCustomer, $valueCustomer);
            
                $item1a = "totalpurchase";
                $value1a = $getCustomer["totalpurchase"] - array_sum($totalPurchasedProducts);
            
                $customerPurchases = CustomerModel::mdlUpdateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);
                
                /*=============================================
                calling delete module
            =============================================*/
            $answer = saleModel::mdlDeleteSale($table, $_GET["idSale"]);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "فرۆشتنەکە بە سەرکەوتووی سرایەوە",
					  showConfirmButton: true,
					  confirmButtonText: "داخستن",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "manage-sales";

								}
							})

				</script>';

			}
        }
    }

    /*=============================================
    show sales by date ranges
=============================================*/
static public function ctrShowRangeSales($startDate, $endDate) {

    $table = "sales";

    $answer = SaleModel::MdlShowRangeSales($table, $startDate, $endDate);

    return $answer;
    }
     /*=============================================
    download reprot in excel
    =============================================*/
    static public function ctrDownloadReport(){
        if(isset($_GET["report"])){
            $table = "sales";
            if(isset($_GET["startDate"]) && isset($_GET["endDate"])){
                $sales = saleModel::MdlShowRangeSales($table,$_GET["startDate"] ,$_GET["endDate"]);
            }else {
                $startDate = null;
                $endDate = null;
                $sales = saleModel::MdlShowRangeSales($table,$startDate ,$endDate);
            }

            // creating excel file
            $name = $_GET["report"].'.xls';
            header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Excel file
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>Code</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>customer</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Seller</td>
					<td style='font-weight:bold; border:1px solid #eee;'>quantity</td>
					<td style='font-weight:bold; border:1px solid #eee;'>products</td>
					<td style='font-weight:bold; border:1px solid #eee;'>discount</td>
					<td style='font-weight:bold; border:1px solid #eee;'>net</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>payment method</td	
					<td style='font-weight:bold; border:1px solid #eee;'>date</td>		
					</tr>");

                    foreach ($sales as $row => $item){

                        $customer = CustomerController::ctrShowCustomers("id", $item["idCustomer"]);
                        $Seller = ControllerUsers::ctrShowUsers("id", $item["idSeller"]);
        
                     echo utf8_decode("<tr>
                                 <td style='border:1px solid #eee;'>".$item["code"]."</td> 
                                 <td style='border:1px solid #eee;'>".$customer["name"]."</td>
                                 <td style='border:1px solid #eee;'>".$Seller["name"]."</td>
                                 <td style='border:1px solid #eee;'>");
        
                         $products =  json_decode($item["products"], true);
        
                         foreach ($products as $key => $valueproducts) {
                                 
                                 echo utf8_decode($valueproducts["quantity"]."<br>");
                             }
        
                         echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
        
                         foreach ($products as $key => $valueproducts) {
                                 
                             echo utf8_decode($valueproducts["description"]."<br>");
                         
                         }
        
                         echo utf8_decode("</td>
                            <td style='border:1px solid #eee;'>$ ".number_format($item["discount"])."</td>
                            <td style='border:1px solid #eee;'>$ ".number_format($item["net"])."</td>	
                            <td style='border:1px solid #eee;'>$ ".number_format($item["total"])."</td>
                            <td style='border:1px solid #eee;'>".$item["paymentMethod"]."</td>
                            <td style='border:1px solid #eee;'>".substr($item["date"],0,10)."</td>		
                             </tr>");
        
                    }
        
        
                    echo "</table>";
        }
    }

    /*=============================================
    adding total sales
=============================================*/
static public function ctrAddTotalSales() {

    $table = "sales";

    $answer = SaleModel::MdlAddTotalSales($table);

    return $answer;
    }
}

?>