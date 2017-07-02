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
//Connect to the database
include ('info.php');

//Search for the number of document in db
@$doc1 = $_POST['doc1']-648;
@$search1 = $_SESSION['cons1'];

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

while ($row1 = mysql_fetch_array($result1)) {
	$doc1 = $row1['id'];
	require('print_ce.php');
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
  <div id="text">Generada Cotización No. <?php echo ("$doc1")+648;?><br>
  	<?php 
  		$doc1 = $doc1+648;
  		$doc2 = $doc1 -648;
  	?>
  	<form style="display:inline-block" name="fpdf" id= "fpdf" method="post" action="print_pdf.php">
			<th width='60' align='center'>
				<input type="submit" name="pdf" value="Imprimir en pdf">
				<input type="hidden" name="doc1" value="<?php echo $doc1;?>" >
				<input type="hidden" name="doc2" value="<?php echo $doc2;?>" >
			</th>
	</form>
  	<form style="display:inline-block" name="send" id="send" action="send_email.php" method="post">
  		<th width='60' align='center'>
	  		<input type="submit" name="emailSend" value="Enviar por correo">
	  		<input type="hidden" name="doc1" value="<?php echo $doc1;?>" >
			<input type="hidden" name="doc2" value="<?php echo $doc2;?>" >
		</th>
  	</form>
  	<button onclick= "search()">Buscar otra cotización</button>
  	<button onclick= "home()">Ir al inicio</button>
  </div>
</div>
</body>
</html>
