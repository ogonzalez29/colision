<?php
$construct1 = "SELECT * FROM document1 WHERE
						(id+648 LIKE '%$search1%'
						OR firstname LIKE '%$search1%'
						OR lastname LIKE '%$search1%'
						OR license LIKE '%$search1%')"; 
$run1 = mysql_query($construct1);
?>