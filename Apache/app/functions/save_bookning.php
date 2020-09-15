    <?php
    
    include_once '../config/database_config.php';
    include_once 'connect_db.php';
?>

    <?php
    if (isset ($_POST["nr"])) $nr=$_POST["nr"];
    $name=$_POST["name"];
    $from=$_POST["start"];
    $to=$_POST["end"];
    $room=$_POST["room"];
    $persons=$_POST["persons"];
    $email=$_POST["email"];
    $tel=$_POST["tel"];
    $remark=$_POST["remark"];
    $user=$_POST["user"];
    $kind=$_POST["status"];
    $checkin=explode('.',$from);
    $checkout=explode('.',$to);
    $checkintime=mktime(14,1,0,$checkin[1],$checkin[2],$checkin[0]);
    $checkouttime=mktime(9,59,0,$checkout[1],$checkout[2],$checkout[0]);
    //status 0: free
    // 1: locked
    // 2: reserved - not payed
    // 3: reserved - payed
    // 4: reserved - promo
    // 5: reserved - maintance
    $ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    $timestamp=mktime();
    if (isset ($nr))   
        $command="UPDATE reservations SET room='".$room." ',start='".$checkintime." ',end='".$checkouttime." ',persons='".$persons." ',customer='".$name." ',email='".$email." ',status='".$kind." ',tel='".$tel." ',remark='".$remark." ',user='".$user."',stamp='".$timestamp."',ip='".$ip."' WHERE idreservations= '".$nr."'";
    else{
        $command="INSERT INTO reservations (room,start,end,persons,customer,email,status,tel,remark,user,stamp,ip) ";
        $command.="VALUES ('".$room."','".$checkintime."','".$checkouttime."','".$persons."','".$name."','".$email."','".$kind."','".$tel."','".$remark."','".$user."','".$timestamp."','".$ip."');";
    }
    $insertresult=mysqli_query($connection,$command);
    if (!$insertresult)
        {
            $ret->status="Error";
            $ret->message= mysqli_error($connection);
        }
        else {
            $ret->status= 'OK';
            $g=mysqli_insert_id($connection);
            $ret->id=$g;
            mysqli_free_result($insertresult);
        }
        echo json_encode($ret);
include_once 'close_db.php';
//header('location:../Administration/index.php?target='.$page);
?>