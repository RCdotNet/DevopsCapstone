<?php
$connection = mysqli_connect($sql_host, $sql_user, $sql_pass) or die ('Can not connect the database. >'.mysqli_connect_errno().">".mysqli_connect_error());
mysqli_select_db($connection,$database);
mysqli_query($connection,"SET CHARACTER SET ".$sql_coding);
mysqli_query($connection,"set names ".$sql_coding);
// error 2002 : Target host active drop connection // have not Mysql installed
	// error 1045 : acces denied


?>
