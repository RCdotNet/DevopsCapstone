<?php
include "../config/database_config.php";
include "connect_db.php";
$reservation=$_POST['p'];
$result = mysqli_query($connection,"delete from reservations where idreservations=".$reservation.";");
if ($result)
{
    $res->status="OK";
}
else
{
    $res->status="ERROR".$connection->error;
}
echo json_encode($res);
include_once '../Functions/close_db.php';

?>