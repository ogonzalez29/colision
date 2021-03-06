<?php
//Verify if session started, else redirect to login.php
session_start();
if (!$_SESSION['logged']) {
	header("Location: login.php");
	exit;
}
echo "Bienvenido, ".$_SESSION['username'];
echo "<br><br>";
// echo session_id();
// echo "<br><br>";
echo "<a href=login.php>Cerrar Sesión</a>";

//Control session timeout to logout after 30 minutes of last login
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

//Change session ID periodically to avoid attacks on sessions
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 10) {
    // session started more than 10 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
// var_dump($_SESSION['LAST_ACTIVITY']);
// var_dump($_SESSION['CREATED']);

//
require 'connect_db.php'; //Database connection
require 'data_check.php'; //Input field data check file
require_once 'save_data.php'; //Save input to database
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
	<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
	<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->
	<title>Cotización Colisión Exprés</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/view.mobile.css" media="all"/>
	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="js/view.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.effects.core.js"></script>
	<!--[if lt IE 9]><script src="js/signaturepad/flashcanvas.js"></script><![endif]-->
	<script type="text/javascript" src="js/jquery.mockjax.js"></script>
    <script type="text/javascript" src="js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="js/names.js"></script>
    <script type="text/javascript" src="js/suggestions.js"></script>
	<script type="text/javascript"> // Drop-down dependent menus script
		function AjaxFunction()
		{
		var httpxml;
		try
		  {
		  // Firefox, Opera 8.0+, Safari
		  httpxml=new XMLHttpRequest();
		  }
		catch (e)
		  {
		  // Internet Explorer
				  try
		   			 		{
		   				 httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		    				}
		  			catch (e)
		    				{
		    			try
		      		{
		      		httpxml=new ActiveXObject("Microsoft.XMLHTTP");
		     		 }
		    			catch (e)
		      		{
		      		alert("Your browser does not support AJAX!");
		      		return false;
		      		}
		    		}
		  	}
			function stateck() 
			    {
			    if(httpxml.readyState==4)
			      {
			//alert(httpxml.responseText);
			var myarray = JSON.parse(httpxml.responseText);
			// Remove the options from 2nd dropdown list 
			for(j=document.testform.subcat.options.length-1;j>=0;j--)
			{
				document.testform.subcat.remove(j);
			}


			for (i=0;i<myarray.data.length;i++)
			{
				var optn = document.createElement("OPTION");
				optn.text = myarray.data[i].subcategory;
				optn.value = myarray.data[i].subcategory;  // You can change this to subcategory 
				document.testform.subcat.options.add(optn);

			} 
			      }
			    } // end of function stateck
			var url="dd.php";
			var cat_id=document.getElementById('s1').value;
			url=url+"?category="+cat_id;
			url=url+"&sid="+Math.random();
			httpxml.onreadystatechange=stateck;
			//alert(url);
			httpxml.open("GET",url,true);
			httpxml.send(null);
			  }
	</script>
</head>
<body id="main_body" >
	<img id="top" src="img/top.png" alt="">
	<div id="form_container">
		<h1><a>Cotización Colisión Exprés</a></h1>
			<form name="testform" id="form_1134338" class="appnitro" method="post" action="">
			<div class="header-image">
				<a href="http://servitalleres.com" target="_blank"><img src="img/logo.png"></a>
			</div>
			<div class="form_description">
				<h2>Cotización Colisión Exprés</h2>
				<p>Cotización para trabajos cortos de 24/48 horas de duración</p>
			</div>						
			<ul >
			<li id="li_2">
				<div class="reset">
					<a href="index.php">Dar click para iniciar una cotización</a>
					<!-- <span class="error">* Favor oprimir para comenzar</span> -->
				</div>
				<div class="search">
					<a href="search.php">Dar click para buscar una cotización</a>
				</div>
			</li>
		<li id="li_6" >
		<label class="description" for="element_6">Fecha </label>
		<span>
			<input id="element_6_1" name="month" class="element text" size="2" maxlength="2" value="<?php echo $month;?>" type="text"> /
			<label for="element_6_1">MM</label>
			<span><?php echo $dateErr;?></span>
		</span>
		<span>
			<input id="element_6_2" name="day" class="element text" size="2" maxlength="2" value="<?php echo $day;?>" type="text"> /
			<label for="element_6_2">DD</label>
		</span>
		<span>
	 		<input id="element_6_3" name="year" class="element text" size="4" maxlength="4" value="<?php echo $year;?>" type="text">
			<label for="element_6_3">AAAA</label>
		</span>
	
		<span id="calendar_6">
			<img id="cal_img_6" class="datepicker" src="img/calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_6_3",
			baseField    : "element_6",
			displayArea  : "calendar_6",
			button		 : "cal_img_6",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		</li>	
		<li id="li_2" >
		<label class="description" for="element_7">Asesor de servicio </label>
		<span>
			<input onKeyPress=check_length_12(this.form); onKeyDown=check_length_12(this.form); id="element_7_1" name= "firstname1" class="element text" maxlength="255" size="15" value="<?php echo $firstname1;?>"/>
			<label>Nombre</label>
			<input size=1 value=9 name=text_num_12 style="display:none; float:right; text-align:right;">
			<span><?php echo $nameErr1;?></span>
		</span>
		<span>
			<input onKeyPress=check_length_13(this.form); onKeyDown=check_length_13(this.form); id="element_7_2" name= "lastname1" class="element text" maxlength="255" size="15" value="<?php echo $lastname1;?>"/>
			<label>Apellido</label>
			<input size=1 value=11 name=text_num_13 style="display:none; float:right; text-align:right;">
			<span><?php echo $last_nameErr1;?></span>
		</span> 
		</li>
		<li class="section_break">
		<p></p>
		</li>	
		<li id="li_2" >
		<label class="description" for="element_2">Cliente </label>
		<span>
			<input onKeyPress=check_length_14(this.form); onKeyDown=check_length_14(this.form); id="element_2_1" name= "firstname" class="element text" maxlength="255" size="15" value="<?php echo $firstname;?>"/>
			<label>Nombre(s)</label>
			<input size=1 value=15 name=text_num_14 style="display:none; float:right; text-align:right;">
			<span><?php echo $nameErr;?></span>
		</span>
		<span>
			<input onKeyPress=check_length_15(this.form); onKeyDown=check_length_15(this.form); id="element_2_2" name= "lastname" class="element text" maxlength="255" size="15" value="<?php echo $lastname;?>"/>
			<label>Apellido</label>
			<input size=1 value=11 name=text_num_15 style="display:none; float:right; text-align:right;">
			<span><?php echo $last_nameErr;?></span>
		</span> 
		</li>
		<li id="li_8" >
			<label class="description" for="element_8">Teléfono </label>
			<div>
				<input id="element_8" name="phone" class="element text medium" type="text" maxlength="255" value="<?php echo $phone;?>"/> 
				<span><?php echo $phoneErr;?></span>
			</div> 
		</li>
		<li id="li_9" >
			<label class="description" for="element_9">Correo electrónico </label>
			<div>
				<input id="element_9" name="email" class="element text medium" type="text" maxlength="255" value="<?php echo $email;?>"/> 
				<span><?php echo $emailErr;?></span>
			</div> 
		</li>	
		<li id="li_15" >
			<label class="description" for="element_15">Marca </label>
		<div>
		 	<?php
			echo "<select class='element select medium' name=cat id='s1' onchange=AjaxFunction();><option value=''></option>";

			$sql="select * from category "; // Query to collect data from table 

			foreach ($dbo->query($sql) as $row) {
			echo '<option value="'.htmlspecialchars($row['category']).'">'.htmlspecialchars($row['category']).'</option>';
			}	
			?>
			</select>
			<span><?php echo $makeErr;?></span>
		</div> 
		</li>		
		<li id="li_16" >
			<label class="description" for="element_16">Línea </label>
		<div>
			<select class='element select medium' name=subcat id='s2'>
			</select>
			<span><?php echo $lineErr;?></span>
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Modelo </label>
		<div>
			<input id="element_4" name="model" class="element text medium" type="text" maxlength="255" value="<?php echo $model;?>"/> 
			<span><?php echo $modelErr;?></span>
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Placas </label>
		<div>
			<input id="element_5" name="license" class="element text medium" type="text" maxlength="255" value="<?php echo $license;?>"/> 
			<span><?php echo $licenseErr;?></span>
		</div> 
		</li>		<li id="li_12" >
		<label class="description" for="element_12">Kilometraje </label>
		<div>
			<input id="element_12" name="mileage" class="element text medium" type="text" maxlength="255" value="<?php echo $mileage;?>"/> 
			<span><?php echo $mileageErr;?></span>
		</div> 
		</li>		
		<li class="section_break">
		<p></p>
		</li>
		<li id="li_21" >
		<label class="description" for="element_21">Piezas a intervenir </label>
		<div>
			<textarea onKeyPress=check_length_9(this.form); onKeyDown=check_length_9(this.form); id="element_21" name="comment1" class="element textarea medium"><?php echo $comment1;?></textarea> 
			<br>
			<input size=1 value=315 name=text_num_9 style="float:right; text-align:right;">
			<span><?php echo $comment1Err;?></span>
		</div> 
		</li>
		<li class="section_break">
		<p></p>
		</li>		
		<li id="li_3">
	    	<label class="description" for="element_3">Repuestos asociados </label>
	            <input id="element1" name="matrix_1" type="radio" value="1" />Si
				<input id="element2" name="matrix_1" type="radio" value="2"  />No
			<div>
				<span><?php echo $matrix1Err;?></span>
			</div>
		</li>
		<li class="section_break">
		<p></p>
		</li>
		<li id="li_22" >
		<label class="description" for="element_22">Repuestos </label>
		<div>
			<textarea onKeyPress=check_length_10(this.form); onKeyDown=check_length_10(this.form); id="element_22" name="comment2" class="element textarea medium"><?php echo $comment2;?></textarea> 
			<br>
			<input size=1 value=88 name=text_num_10 style="float:right; text-align:right;">
			<span><?php echo $comment2Err;?></span>
		</div> 
		</li>		
			<li class="section_break">
		</li>						
		<li id="li_25" >
		<label class="description" for="element_25">Costo de la reparación (IVA incluido) </label>
		<div>
			<input id="element_25" name="price" class="element text medium" type="text" maxlength="255" value="<?php echo $price;?>"/> 
			<span><?php echo $priceErr;?></span> 
		</div>
		</li>
		<li id="li_26" >
		<label class="description" for="element_26">Tiempo de entrega (horas) </label>
		<div>
			<input id="element_26" name="time" class="element text medium" type="text" maxlength="255" value="<?php echo $time;?>"/> 
			<span><?php echo $timeErr;?></span> 
		</div>
		</li>
		<li id="li_27" >
		<label class="description" for="element_27">Validez de la cotización (días) </label>
		<div>
			<input id="element_27" name="validity-time" class="element text medium" type="text" maxlength="255" value="<?php echo $validityTime;?>"/> 
			<span><?php echo $validityTimeErr;?></span> 
		</div>
		</li>
		<li id="li_24" >
		<label class="description" for="element_24">Observaciones (escribir los detalles de la cotización)</label>
		<div>
			<textarea onKeyPress=check_length_11(this.form); onKeyDown=check_length_11(this.form); id="element_24" name="comment3" class="element textarea medium"><?php echo $comment3;?></textarea> 
			<br>
			<input size=1 value=300 name=text_num_11 style="float:right; text-align:right;">
			<span><?php echo $comment3Err;?></span>
		</div> 
		</li>	
		<li class="buttons">
			    <input type="hidden" name="form_id" value="1134337" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Enviar" />
		</li>
			</ul>
		<br>	
		</form>	
		<div id="footer">
			Copyright &copy; 2016 <a href="http://www.servitalleres.com" target="_blank">Servitalleres</a>
		</div>
	</div>
	<img id="bottom" src="img/bottom.png" alt="">
	<script type="text/javascript" src="js/scrolltotop.js"></script>
	<a href="#" class="scrollToTop"></a>
	<script type="text/javascript" src="js/checklength.js"></script>
	</body>
</html>
