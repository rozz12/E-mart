<?php
date_default_timezone_set('Asia/Kathmandu');
	session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include('connection.php');

	
	//fetch the email adress of the signed in user
	$emailqry = "SELECT email FROM Trader WHERE Trader_id = ".$_SESSION['Trader_id'];
	$emailparse = oci_parse($conn, $emailqry);
	oci_execute($emailparse);
	$useremail = oci_fetch_assoc($emailparse);
	echo $useremail['EMAIL'];
	$usermail = $useremail['EMAIL'];
	oci_free_statement($emailparse);	


require('../../../php/FPDF-master/fpdf.php');
include('../php/connection.php');

$invoice = 0;
$date = date('m-d-Y');

$sql = 'SELECT Firstname, Surname, Contact_no FROM Trader WHERE trader_id = :customer_id';
$parse = oci_parse($conn, $sql);
oci_bind_by_name($parse, ':customer_id', $_SESSION['Trader_id']);
oci_execute($parse);
$customer = oci_fetch_assoc($parse);


$o_sql = 'SELECT * FROM Orders WHERE customer_id = :customer_id';
$o_parse = oci_parse($conn, $o_sql);
oci_bind_by_name($o_parse, ':customer_id', $_SESSION['Trader_id']);
oci_execute($o_parse);
$order = oci_fetch_assoc($o_parse);
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(40,5,'',0,0);
$pdf->Cell(159	,5,'CLECKHUDDERSFAX   E_MART   INVOICE',0,1);//end of line
//set space
$pdf->Cell(219,20,'',0,1);
//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);


$pdf->Cell(10,5,'',0,0);
$pdf->Cell(15,5,'Name: ',0,0);
$pdf->Cell(15,5,$customer['FIRSTNAME'],0,0);
$pdf->Cell(15,5,$customer['SURNAME'],0,0);

//next tab
$pdf->Cell(55,5,'',0,0);
$pdf->Cell(18,5,'Invoice# ',0,0);
$pdf->Cell(15,5,$invoice,0,1);
$pdf->Cell(10,5,'',0,0);
$pdf->Cell(35,5,'Contact Number:',0,0);
$pdf->Cell(35,5,$customer['CONTACT_NO'],0,0);

$pdf->Cell(30,5,'',0,0);
$pdf->Cell(13,5,'Date:',0,0);
$pdf->Cell(10,5,$date,0,1);

$pdf->Cell(110,5,'',0,0);
$pdf->Cell(15,5,'Order Number:',0,0);
$pdf->Cell(10,5,$order['ORDER_ID'],0,1);

$pdf->Cell(110,5,'',0,0);
$pdf->Cell(50,5,'Order Date',0,0);
$pdf->Cell(50,5,$order['ORDER_DATE'],0,1);
$pdf->Cell(110	,5,'',0,0);
$pdf->Cell(60	,5,'Payment Method : PAYPAL',0,1);//end of line

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(28,5,'Customer ID:',0,0);
$pdf->Cell(8,5,'3',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line


//invoice contents
$pdf->SetFont('Arial','B',16);

$pdf->Cell(15,10,'S.N',0,0);
$pdf->Cell(70,10,'Product',0,0);
$pdf->Cell(34,10,'Unit_Price',0,0,'C');
$pdf->Cell(34,10,'Quantity',0,0,'C');
$pdf->Cell(34,10,'Price',0,1,'C');//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter
$i = 1;
$price = 0;
$grandtotal = 0;
foreach ($_SESSION['cart'] as $key => $value) {
	$pdf->Cell(15,10,$i,0,0,'C');
	$pdf->Cell(70,10,$value['item_name'],0,0);
	$pdf->Cell(34,10,$value['selling_price'],0,0,'C');
	$pdf->Cell(34,10,$value['quantity'],0,0,'C');
	$pdf->Cell(34,10,$value['price'],0,1,'C');
	$i++;
	$price = $price + ($value['quantity'] * $value['selling_price']) ;
}

$grandtotal = $price + 1.24;

//summary
$pdf->SetFont('Arial','B',14);

$pdf->Cell(130	,5,'',0,1);

$pdf->Cell(120	,5,'',0,0);
$pdf->Cell(35	,15,'Subtotal',0,0);
$pdf->Cell(15	,15,'GBP',0,0,'L');
$pdf->Cell(15	,15,$price,0,1,'R');//end of line

$pdf->Cell(120	,5,'',0,0);
$pdf->Cell(35	,15,'Tax amount',0,0);
$pdf->Cell(15	,15,'GBP',0,0,'L');
$pdf->Cell(15	,15,'1.24',0,1,'R');//end of line

$pdf->Cell(120	,5,'',0,0);
$pdf->Cell(35	,15,'Total Due',0,0);
$pdf->Cell(15	,15,'GBP',0,0,'L');
$pdf->Cell(15	,15,$grandtotal,0,1,'R');//end of line

//making A string variable of the pdf file
$pdf = $pdf->Output('','S');

	
//Load Composer's autoloader
require 'C:/Users/GayMan/vendor/autoload.php';

sendmail($pdf,$usermail);

function sendmail($pdf,$usermail){

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'srojan19@tbc.edu.np';                     //SMTP username
	    $mail->Password   = 'bsc@3310';                               //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	    //Recipients
	    $mail->setFrom('Ceckhuddersfaxcommunal@gmail.com', 'Mailer');
	    $mail->addAddress($usermail);     //Add a recipient


	    //Attachments
		$mail->addStringAttachment($pdf, 'CLEM_Invoice.pdf');

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'Customer Product Invoice';
	    $mail->Body    = '<b>Please find the invoice from Cleckhhuddersfax Communal E-mart</b>';
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

}

	

?>