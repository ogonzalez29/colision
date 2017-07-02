<?php

include ('info.php'); //Database connection

$errors_array = array_filter($errors);

 if (isset($_POST['submit'])) {

 	//Header information of print_cc.php 
 	$day = $_POST['day'];
 	$month = $_POST['month'];
 	$year = $_POST['year'];
 	$firstname1 = mysql_real_escape_string(htmlspecialchars($_POST['firstname1']));
 	$lastname1 = mysql_real_escape_string(htmlspecialchars($_POST['lastname1']));
 	$firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
 	$lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));
 	$phone = mysql_real_escape_string(htmlspecialchars($_POST['phone']));
 	$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 	@$make = $_POST['cat'];
 	@$line = $_POST['subcat'];
 	$model = mysql_real_escape_string(htmlspecialchars($_POST['model']));
 	$license = mysql_real_escape_string(htmlspecialchars($_POST['license']));
 	$mileage = mysql_real_escape_string(htmlspecialchars($_POST['mileage']));
 	
 	//Sanitize names and lastnames to store in database properly
 	$firstname1 = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($firstname1))));
 	$lastname1 = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($lastname1))));
 	$firstname = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($firstname))));
	$lastname = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($lastname))));

 	@$m1_el1 = $_POST['matrix_1'];

	$comment1 = $_POST['comment1'];
	$comment2 = $_POST['comment2'];
	$comment3 = $_POST['comment3'];

	//Comments sanitizing for storing in database properly
	//1. Make everything lowercase and then make the first letter if the entire string capitalized
	$comment1 = ucfirst(strtolower($comment1));
	$comment2 = ucfirst(strtolower($comment2));
	$comment3 = ucfirst(strtolower($comment3));

	//2. Run the function to capitalize every letter after a full-stop (period).
	$comment1 = preg_replace_callback('/[.!?].*?\w/', create_function('$matches', 'return strtoupper($matches[0]);'), $comment1);
	$comment2 = preg_replace_callback('/[.!?].*?\w/', create_function('$matches', 'return strtoupper($matches[0]);'), $comment2);
	$comment3 = preg_replace_callback('/[.!?].*?\w/', create_function('$matches', 'return strtoupper($matches[0]);'), $comment3);

	$price = mysql_real_escape_string(htmlspecialchars($_POST['price']));
	$time = mysql_real_escape_string(htmlspecialchars($_POST['time']));
	$validityTime = mysql_real_escape_string(htmlspecialchars($_POST['validity-time']));


	if (!empty($errors_array)) {
		echo "<form method=post action='index.php'>";
	}
	else{
		mysql_query("INSERT document1 SET day='$day', 
										 month='$month', 
										 year='$year',
										 firstname1='$firstname1', 
										 lastname1='$lastname1',
										 firstname='$firstname', 
										 lastname='$lastname',
										 mobile='$phone',
										 email='$email',  
										 make='$make',
										 type='$line',
										 model='$model', 
										 license='$license',
										 mileage='$mileage',
										 description='$comment1',
										 spare_parts='$m1_el1',
										 spare_description='$comment2',
										 price='$price',
										 time='$time',
										 validity_time='$validityTime',
										 observations='$comment3'
										 ")
 		or die(mysql_error());
 		unset($_SESSION['cons1']);
		
		header("location: print.php");
	}
}
?>