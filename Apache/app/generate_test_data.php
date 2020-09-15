<?php
include_once 'config/database_config.php';
include_once 'functions/connect_db.php';
$datenow=mktime();      // date right now/
$months=24;             // monhts to generate data for
$rooms = 7;             //rooms to generate data for
$reservations=100;        //reservations to generate per month
$mindays=1;             // minimum days to reserve
$maxdays=4;             // max days to reserve
$maxfiller=3;
$today=date("N",$datenow);  //OBS!!!! That is wrong! This is the day number of the week!
$year=date("Y",$datenow);
$month=date("n",$datenow);
$persons=array("Laszlo Kadar","Zoltan Glosz","Saisuda Kadar","Jakab Gipsz");
//$month--;
$made=0;
$year=2019;
$month=12;
$day=1;
$startdatesaved=mktime(0,0,1,$month-1,1,$year);
for ($i=1; $i<=$rooms; $i++){
    $startdate=$startdatesaved;
    for ($r=1; $r<=$reservations; $r++){
        $day=date("j",$startdate);
        $year=date("Y",$startdate);
        $month=date("n",$startdate);
        echo '<p> '.$year.'-'.$month.'-'.$day.' |';
        $filler=rand(0,$maxfiller);
        $numdays=rand($mindays,$maxdays);
        // $filler=0;
        // $numdays=5;
        $startdate=$startdate+($filler*86400);
        $enddate=$startdate+($numdays*86400);
        $startday=date("j",$startdate);
        $startyear=date("Y",$startdate);
        $startmonth=date("n",$startdate);
        $endday=date("j",$enddate);
        $endyear=date("Y",$enddate);
        $endmonth=date("n",$enddate);
        $startstamp=mktime(14,0,0,$startmonth,$startday,$startyear);
        $endstamp=mktime(9,59,59,$endmonth,$endday,$endyear);
        $startdate=mktime(0,0,1,$endmonth,$endday,$endyear);
        $status=rand(2,5);
        $person=$persons[rand(0,3)];
        $guest=rand(1,2);
        echo $startyear.'-'.$startmonth.'-'.$startday.'  -  '.$endyear.'-'.$endmonth.'-'.$endday.' = '.$filler.' filler and '.$numdays.' reserved </p>';
        $command ="insert into reservations  (room,start,end,persons,customer,email,status,tel) 
        values ('".$i."','".$startstamp."', '".$endstamp."','".$guest."','".$person."','emai@email.com','".$status."','+36123456789')";    
        $result=mysqli_query($connection,$command);
        $made ++;

    }
}
echo $made." reservations made in ".$rooms." rooms.";
include_once 'functions/close_db.php'
?>