<?php
//Verify if session started, else redirect to login.php
ob_start();
session_start();
if (!$_SESSION['logged']) {
	header("Location: login.php");
	exit;
}
//Connect to the database
include ('info.php');
// require ('search.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Cotización Colisión Exprés</title>
		<link rel="stylesheet" href="css/view1.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
	</head>
	<body>
		<?php
		//set search variable to find results from database
		// @$search = $_SESSION['cons'];
		// @$doc = $_POST['doc']-1000;

		//get last results from database if recently submitted
		$result = mysql_query("SELECT * FROM document1 ORDER BY id DESC LIMIT 1")
			or die(mysql_error());

		// if (!empty($search)) {
		// 	$result = mysql_query("SELECT * FROM document WHERE id = '$doc'")
		// 		or die(mysql_error());

		// 	//If there's no information in database from search query
		// 	if (mysql_num_rows($result) == 0) {
		// 		die('No hay información con ese criterio de búsqueda');
		// 	}
		// }
		//loop through results of database query, displaying them in the format
		while ($row = mysql_fetch_array($result)) {
		?>
		<div class="grid">
			<div class="header">
				<div class="col-12">
					<img src="img/logo.png" alt="logo servitalleres">
					<div style="float:right; padding-right:5px;" class="col-5">
						<div style="float:left;" class="col-8">
							<h2>Cotización:</h2>	
						</div>
						<div style="float:right; text-align:center;" class="col-7">
							<h2 style="border:1px solid white; color:red; background: white;"><?php echo 'N. '. ($row['id']+648)?></h2>
						</div>
						
					</div>
				</div>
			</div>
			<div class="row">
				<div style="border-bottom:1px solid #d3d3d3;" class="col-12">
					<h2>SERVICIO DE LATONER&Iacute;A Y PINTURA EXPR&Eacute;S EN CABINA</h2>
				</div>
			</div>
			<div class="row-1">
				<div style="text-align:center; padding-right: 5px;" class="col-12">
					<div class="col-1_2">
						<h3 style="font-weight:bold;">Fecha:</h3>
					</div>
					<div class="col-1_4">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['day']. '/'. $row['month']. '/'. $row['year']?></h3>
					</div>
					<div class="col-3">
						<h3 style="font-weight:bold;">Asesor de servicio:</h3>
					</div>
					<div class="col-3">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['firstname1']. ' '. $row['lastname1']?></h3>
					</div>
				</div>
				<div style ="padding-right: 5px;" class="col-12">
					<div class="col-1_2">
						<h3 style="font-weight:bold;">Nombre:</h3>
					</div>
					<div class="col-3">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['firstname']. ' '. $row['lastname']?></h3>
					</div>
					<div class="col-1_2">
						<h3 style="font-weight:bold;">Teléfono:</h3>
					</div>
					<div class="col-1_4">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['mobile']?></h3>
					</div>
					<div class="col-07">
						<h3 style="font-weight:bold;">Correo:</h3>
					</div>
					<div class="col-6">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['email']?></h3>
					</div>
				</div>
				<div style="text-align:center;" class="col-12">
					<div class="col-1_2">
						<h3 style="font-weight:bold;">Vehículo:</h3>
					</div>
					<div class="col-4">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['make']. ' '.$row['type']?></h3>
					</div>
					<div class="col-07">
						<h3 style="font-weight:bold;">Placa:</h3>
					</div>
					<div class="col-1_2">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['license']?></h3>
					</div>
					<div class="col-1_2">
						<h3 style="font-weight:bold;">Modelo:</h3>
					</div>
					<div class="col-07">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['model']?></h3>
					</div>
					<div class="col-1_4">
						<h3 style="font-weight:bold;">Kilometraje:</h3>
					</div>
					<div class="col-07">
						<h3 style="border-bottom:1px solid black;"><?php echo number_format($row['mileage'],0,",",".")?></h3>
					</div>
				</div>
				<div class="col-12">
					<div style= "vertical-align:top; height: 68px;" class="col-3">
						<h3 style="text-align:left; font-weight:bold; margin: 1.5em 0;">Piezas a intervenir:</h3>
					</div>
					<div style="text-align:justify; height:68px; line-height:68px; border-bottom:1px solid black;" class="col-9">
						<div style="padding-top: 0;" class="col-12">
							<span><?php echo $row['description']?></span>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div style="width:22%;" class="col-3">
						<h3 style="text-align:left; font-weight:bold;">Repuestos asociados:</h3>
					</div>
					<div style="width:77.4%;" class="col-9">
						<form action="">
							<input type="radio" id="select" name="spare" value="1"<?php if(isset($row['spare_parts']) && $row['spare_parts']=="1") echo "checked";?>> Si
							<input type="radio" id="nonselect" name="spare" value="2"<?php if(isset($row['spare_parts']) && $row['spare_parts']=="2") echo "checked";?>> No
						</form>
					</div>
				</div>
				<div id="repuestos" class="col-12" <?php if(isset($row['spare_parts']) && $row['spare_parts']=="1")echo "style=display:block;"; else echo "style=display:none;";?>>
					<div style= "vertical-align:top;" class="col-3">
						<h3 style="text-align:left; font-weight:bold;">Repuestos:</h3>
					</div>
					<div style="text-align:justify; height:32px; line-height:30px; border-bottom:1px solid black;" class="col-9">
						<span><?php echo $row['spare_description']?></span>
					</div>
				</div>
			</div>
			<div class="row-2">
				<div style="text-align:right; padding-right:5px;" class="col-12">
					<div style="width:36%;" class="col-6">
						<h2>Su reparación le cuesta:</h2>
					</div>
					<div style="border:1px solid black;" class="col-3">
						<h2><?php echo '$ '. number_format($row['price'],0,",",".").' *'?></h2>
					</div>
				</div>
				<div style="text-align:right; padding-right:5px;" class="col-12">
					<div class="col-6">
						<h2>Tiempo de entrega:</h2>
					</div>
					<div style="border:1px solid black;" class="col-3">
						<h2><?php echo $row['time'].' horas'?></h2>
					</div>
				</div>
				<div style="text-align:right; padding-right:5px;" class="col-12">
					<div class="col-4">
						<h3 style="font-weight:bold;">Validez de la cotización:</h3>
					</div>
					<div class="col-07">
						<h3 style="border-bottom:1px solid black;"><?php echo $row['validity_time'].' días'?></h3>
					</div>
					<div class="col-1_4">
						<h3>* IVA incluido</h3>
					</div>
				</div>
			</div>
			<div class="footer">
				<div class="col-12">
					<h4>Carrera 22 # 76-57 | Bogotá - Colombia | 2117943 - 2119290</h4>
				</div>
				<div class="col-12">
					<h4 style="margin-top:5px;">contacto@servitalleres.com | www.servitalleres.com</h4>
				</div>
			</div>
		</div>
		<?php
		}
		// file_put_contents('printce.html', ob_get_contents());
		?>
	</body>
</html>