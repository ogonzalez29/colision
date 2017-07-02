<?php
//Verify if session started, else redirect to login.php
ob_start();
if(!isset($_SESSION)) { 
    session_start(); 
} 
if (!$_SESSION['logged']) {
	header("Location: login.php");
	exit;
}

//Connect to phpmailer script 
require 'assets/phpmailer/PHPMailerAutoload.php';

//Connect to the database
include ('info.php');

//Search for the number of document in db
@$search1 = $_SESSION['cons1'];
@$doc1 = $_POST['doc1']-648;

//get last results from database if recently submitted
$result1 = mysql_query("SELECT * FROM document1 ORDER BY id DESC LIMIT 1")
	or die(mysql_error());

if (!empty($search1)) {
	$result1 = mysql_query("SELECT * FROM document1 WHERE id = '$doc1'")
		or die(mysql_error());

	//If there's no information in database from search query
	if (mysql_num_rows($result1) == 0) {
		die('No hay información con ese criterio de búsqueda');
	}
}	

//loop through results of database query, displaying them in the format
while ($row1 = mysql_fetch_array($result1)) {
	$doc1 = $row1['id']+648;
	$day = $row1['day'];
	$month = $row1['month'];
	$year = $row1['year']-2000;
	$firstname = $row1['firstname'];
	$lastname = $row1['lastname'];
	$email = $row1['email'];
	$make = $row1['make'];
	$line = $row1['type'];
	$license = $row1['license'];
	$validityTime = $row1['validity_time'];
}

if (isset($_POST['emailSend'])) {
		$bodytext = $firstname." ".$lastname."<p>Adjunto se encuentra la cotización hecha a tu vehículo". " ". $make."  ". $line." "."de placas"." ". $license."."." ". "Recuerda que el precio ya incluye el IVA y tiene una vigencia de"." ". $validityTime." días."." ". "Para consultar los términos y condiciones de nuestro servicio puedes hacer click <a href='http://servitalleres.com/terminos-y-condiciones'>aquí</a>. Si estás interesado en realizar los trabajos asociados, puedes agendar una cita por teléfono o vía web <a href='http://servitalleres.com/citas'>aquí</a>.<p>Cordial saludo,<p>Servicio al cliente<br>Servitalleres Ltda<br>Carrera 22 # 76-57<br>Tels: 2117943 - 2119290<br><a href='http://servitalleres.com'>www.servitalleres.com</a>";

  		//Create a new PHPMailer instance
	    $mail = new PHPMailer();
	    $mail->CharSet = "UTF-8";   
	    $mail->isSMTP();
		// change this to 0 if the site is going live and 2 if working on localhost or development
	    $mail->SMTPDebug = 0;
	    $mail->Debugoutput = 'html';
	    $mail->Host = 'smtp.gmail.com';
	    $mail->Port = 465;
	    $mail->SMTPSecure = 'ssl';

	    //Options for self-signed certificate in mail server (May not work on every server - OPTIONAL)
	    $mail->SMTPOptions = array (
	    	'ssl' => array (
	        'verify_peer' => false,
	        'verify_peer_name' => false,
	        'allow_self_signed' => true
    		)
		);

	 	//use SMTP authentication
	    $mail->SMTPAuth = true;
		//Username to use for SMTP authentication
		$filename = 'assets/config.ini';
	    $data = parse_ini_file($filename, true);

	    $mail->Username = $data['config']['email'][0];
	    $mail->Password = $data['config']['email'][1];
	    $mail->setFrom($data['config']['email'][0], 'Servitalleres');
	    $mail->addAddress($email, $firstname." ".$lastname);
	    //Create an array with recipients addresses
		$recipients = array(
			'dgonzalez@servitalleres.com' => 'Daniel González',
			// 'corjuela@servitalleres.com' => 'Carlos Orjuela'
		);
		foreach ($recipients as $m => $name) {
			$mail->AddBCC($m, $name);
		}

	    $mail->Subject = "Cotización". " ". $make."  ". $line." "."placas"." ". $license;

	    //Handle attachment storing a copy in temp folder
	    $fileAttach = 'C:/Temp/'.$doc1.'_'.$license.'_'.$day.$month.$year.'.pdf';
	    
	    if (!file_exists($fileAttach)) {
	    	require_once ('print_pdf.php');
	    	header('HTTP/1.1 307 Temporary Redirect');
	    	header('Location:send_email.php');
	    }

	    $mail->AddAttachment($fileAttach);

	    // $message is gotten from the form
    	$mail->msgHTML($bodytext);


		//Check if email exist in database then send the message or report the error
    	if(!empty($email)){
		    if (!$mail->send()) {
		        $confMsg = "El correo no fue enviado correctamente, favor intentar de nuevo.";
		    } else {
		        $confMsg = "El correo fue enviado correctamente.";
		    }
		}
		else {
			$confMsg = "No existe dirección de correo registrada. Favor verificar.";
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
		function search(){
			window.location.replace("search.php");
		}
		</script>
		<script type="text/javascript">
		function home(){
			window.location.replace("index.php");
		}
	</script>
</head>
<body id="report">
	<div id="overlay">
		 <div id="text"><?php echo $confMsg;?><br>
		 	<button onclick= "search()">Buscar otra cotización</button>
		 	<button onclick= "home()">Ir al inicio</button>
		 </div>
	</div>
</body>
</html>