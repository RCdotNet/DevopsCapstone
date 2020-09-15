<?php
include "../config/database_config.php";
include "connect_db.php";
$reservation=$_POST['p'];
$result1 = mysqli_query($connection,"select * from reservations where idreservations=".$reservation.";");
if ($result1){
    $res=new stdClass();
    while ($row=$result1->fetch_row()) 
        {
            $res->id=$row[0];
            $res->room=$row[1];
            $res->start=$row[2];
            $res->end=$row[3];
            $res->startdx=date("Y",$res->start).".".date("m",$res->start).".".date("d",$res->start);
            $res->enddx=date("Y",$res->end).".".date("m",$res->end).".".date("d",$res->end);
            $res->persons=$row[4];
            $res->customer=$row[5];
            $res->email=$row[6];
            $res->bookningstatus=$row[7];
            $res->tel=$row[8];
            $res->remark=$row[9];
            $res->userremark=$row[10];
            $res->user=$row[11];
            $res->status='OK';
        }   
        include_once "close_db.php";
        $retJSON=json_encode($res);   
}
else {
    $res->status="Error";
    $ret->message= mysqli_error($connection);
    $retJSON=json_encode($res);
    mysqli_free_result($result1);
    include_once "close_db.php";
}
    echo $retJSON;
?>