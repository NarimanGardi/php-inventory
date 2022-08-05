<?php 
	require_once "../../../controllers/sales.controller.php";
	require_once "../../../models/sales.model.php";
	
	require_once "../../../controllers/customers.controller.php";
	require_once "../../../models/customers.model.php";
	
	require_once "../../../controllers/users.controller.php";
	require_once "../../../models/users.model.php";
	
	require_once "../../../controllers/products.controller.php";
	require_once "../../../models/products.model.php";

	require_once('tcpdf_include.php');

	class PrintBill extends TCPDF {
		public function Footer() {
			$this->SetY(-40);
        // Set font
        $this->SetFont('helvetica', 'I' , 20 );
        // Page number
        $this->Cell(0, 10 , 'supas bo krenakat' , 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
		}
	}

			$codeSale = $_GET["codeSale"];

			// BRING THE INFORMATION OF THE SALE
			$itemcodeSale = "code";
			$valuecodeSale = $codeSale;
			$answerSale = SaleController::ctrShowSales($itemcodeSale,$valuecodeSale);

			$saledate = substr($answerSale["date"],0,-8);
			$products = json_decode($answerSale["products"], true);
			$netPrice = number_format($answerSale["net"]);
			$discount = number_format($answerSale["discount"]);
			$totalPrice1 = number_format($answerSale["total"]);

			// BRING THE INFORMATION OF THE Customer
			$itemCsutomer = "id";
			$ValueCustomer = $answerSale["idCustomer"];

			$answerCustomer = CustomerController::ctrShowCustomers($itemCsutomer,$ValueCustomer);
			
			// BRING THE INFORMATION OF THE Seller
			$itemSeller = "id";
			$ValueSeller = $answerSale["idSeller"];

			$answerSeller = ControllerUsers::ctrShowUsers($itemSeller,$ValueSeller);
			
			// requer tcpdf_include

			
	

	$pdf = new PrintBill(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->startPageGroup();


	$pdf->AddPage();

	$block1 = <<<EOF
	<table>
		
	<tr>
		
		<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

		<td style="background-color:white; width:140px">
			
			<div style="font-size:8.5px; text-align:right; line-height:15px;">
				
				<br>
				NIT: 71.759.963-9

				<br>
				ADDRESS: Calle 44B 92-11

			</div>

		</td>

		<td style="background-color:white; width:140px">

			<div style="font-size:8.5px; text-align:right; line-height:15px;">
				
				<br>
				CELLPHONE: 300 786 52 49
				
				<br>
				sales@inventorysystem.com

			</div>
			
		</td>

		<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>BILL N.<br>$valuecodeSale</td>

		</tr>

	</table>
	EOF;

	$pdf->writeHTML($block1, false, false, false, false, '');

	// ---------------------------------------------------------

	$block2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Customer: $answerCustomer[name]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Date: $saledate

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">Seller: $answerSeller[name]</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

	EOF;

	$pdf->writeHTML($block2, false, false, false, false, '');

	// ---------------------------------------------------------

	$block3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Product</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">quantity</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">value Unit.</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">value Total</td>

		</tr>

	</table>

	EOF;

	$pdf->writeHTML($block3, false, false, false, false, '');

	// ---------------------------------------------------------

	foreach ($products as $key => $item) {

		$itemProduct = "description";
		$valueProduct = $item["description"];
		
		$answerProduct = ProductController::ctrShowProducts($itemProduct, $valueProduct);
		
		$valueUnit = number_format($answerProduct["sell_price"]);
		
		$totalPrice = number_format($item["totalprice"]);
		
		$block4 = <<<EOF
		
			<table style="font-size:10px; padding:5px 10px;">
		
				<tr>
					
					<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
						$item[description]
					</td>
		
					<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
						$item[quantity]
					</td>
		
					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
						$valueUnit
					</td>
		
					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
						$totalPrice
					</td>
		
		
				</tr>
		
			</table>
		
		
		EOF;
		
		$pdf->writeHTML($block4, false, false, false, false, '');
		
		}
		
		// ---------------------------------------------------------
		$block5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Total Price:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $netPrice
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
			Discount:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $discount
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total Price with Discount:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $totalPrice1
			</td>

		</tr>


	</table>

	EOF;

	$pdf->writeHTML($block5, false, false, false, false, '');


	
	
	
// ---------------------------------------------------------
	$orginal = $pdf->Output('psula'.$codeSale.'.pdf');

	
?>