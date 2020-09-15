<?php
include_once '../config/sys_config.php';
 //if ($_POST["from"] and $_POST["name"] and $_POST["message"] and $_POST["subject"] and $_POST["action"]=="send")
/*      bookningsnr
        'room':room,
        'start':from,
        'end':to,
        'name':name,
        'persons':1,
        'email':email,
        'tel':tel,
        'remark':remark 
        status*/
if (isset($_POST["kindof"]))$kindof=$_POST["kindof"];        
if (isset($_POST["bookningsnr"]))$bookningsnr=$_POST["bookningsnr"];        
if (isset($_POST["room"]))$room=$_POST["room"];
if (isset($_POST["start"]))$from=$_POST["start"];
if (isset($_POST["end"]))$to=$_POST["end"];
if (isset($_POST["name"]))$name=$_POST["name"];
if (isset($_POST["persons"]))$persons=$_POST["persons"];
if (isset($_POST["email"]))$email=$_POST["email"];
if (isset($_POST["tel"]))$tel=$_POST["tel"];
if (isset($_POST["remark"]))$remark=$_POST["remark"];
if (isset($_POST["status"]))$status=$_POST["status"];
switch ($status){
case 2:
    $st="Nincs fizetve";
    break;
case 3:
    $st="Fizetve";
    break;
case 4:
    $st="Promoció";
    break;
case 5:
    $st="Karbantartás";
    break;
}
$datenow=time();
$today=date("d",$datenow);
$year=date("Y",$datenow);
$month=date("m",$datenow);
$hour=date("g",$datenow);
$minutes=date("i",$datenow);
$timestamp=$year.".".$month.".".$today." ".$hour.":".$minutes;
switch ($kindof){
    case 1:
        //Insert
        $message="Tisztelt ".$name."!"."\r\n"."\r\n";
        $message.="Foglalását az alábbiak szerint igazoljuk vissza:\r\n";
        $message.="Idöpont: ".$timestamp."\r\n";
        $message.="Foglalási azonosíto:".$bookningsnr."\r\n";
        $message.="Vendégek száma:".$persons."\r\n";
        $message.="Szoba:".$room."\r\n";
        $message.="Érkezés:".$from."\r\n";
        $message.="Távozás:".$to."\r\n";
        $message.="A foglalás állapota: ".$st."\r\n";
        $message.="A megjegyzés rovat: ".$remark."\r\n";
        $message.="Telefonszám: ".$tel."\r\n";
        $message.="E-mail: ".$email."\r\n";
        break;
    case 2:
        //Update
        $message="Tisztelt ".$name."!"."\r\n"."\r\n";
        $message.="Kérésere foglalását az alábbiak szerint módosítottuk:\r\n";
        $message.="Idöpont: ".$timestamp."\r\n";
        $message.="Foglalási azonosíto:".$bookningsnr."\r\n";
        $message.="Vendégek száma:".$persons."\r\n";
        $message.="Szoba:".$room."\r\n";
        $message.="Érkezés:".$from."\r\n";
        $message.="Távozás:".$to."\r\n";
        $message.="A foglalás állapota: ".$st."\r\n";
        $message.="A megjegyzés rovat: ".$remark."\r\n";
        $message.="Telefonszám: ".$tel."\r\n";
        $message.="E-mail: ".$email."\r\n";
        break;
        //Delete
    case 3:
        $message="Tisztelt ".$name."!"."\r\n"."\r\n";
        $message.=$bookningsnr." számú foglalását kérésére töröltük\r\n";
        $message.="Idöpont: ".$timestamp."\r\n";
        break;
}
    {
        
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n";
        $result=mail($email,"Foglalás visszaigazolása",$message,$headers.'From: '.$confirmation_sender."\r\n".'Reply-To: '.$confirmation_sender);
        $result2=mail($admin_to_notify,"Foglalás visszaigazolása",$message,$headers.'From: '.$confirmation_sender."\r\n".'Reply-To: '.$confirmation_sender);

        return;
       // header('location:../index.php');
 }
?>