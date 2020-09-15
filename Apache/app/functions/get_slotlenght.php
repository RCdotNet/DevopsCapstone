<?php
include "../config/database_config.php";
include "connect_db.php";
$room=$_POST['room'];
$start=$_POST['start'];
$end=$_POST['end'];
$res=new stdClass();
$bedq=mysqli_query($connection,"select beds from rooms where roomnumber=".$room." limit 1;");
$beds=0;
if ($bedq){
    $row=$bedq->fetch_row();
    $beds=$row[0];
    $result1 = mysqli_query($connection,"select * from reservations where end>=".$start." and room=".$room." order by start limit 1;");
    if ($result1){
        $row=$result1->fetch_row();
                $res->start=$row[2];
                if ($res->start == 0) $res->start = strtotime('+3 month', $start);
                $res->dx=date("Y",$res->start).".".date("m",$res->start).".".date("d",$res->start);
                $res->beds=$beds;
            $retJSON=json_encode($res);   
            while( $row=$result1->fetch_row()) ;
    }
    else {
        $res->status="error";
        $ret->message= mysqli_error($connection);
        $retJSON=json_encode($res);
     }
} 
else {
   $res->status="error";
   $ret->message= mysqli_error($connection);
   $retJSON=json_encode($res);
}  
     include "close_db.php";
     //$res->dx="2018-1-30";
     $retJSON=json_encode($res);
    echo $retJSON;
?>