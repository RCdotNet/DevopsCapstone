<?php
include '../config/database_config.php';
include 'connect_db.php';
if (isset ($_GET['apikey']) && $_GET['apikey']=="it4go")/* && isset($_POST["year"] && isset($_POST["month"]))*/
{
        // $year = $_POST["year"];
        // $month = $_POST["month"];
        // $startdate = mktime(0,0,0,$month,1,$year);
        // $stopdate = mktime(0,0,0,$month+1,1,$year);
        // $stopdate-=1;
        // $qext = ' where start > '.$startdate.' and end < '.$stopdate;
        $qwxt = "";
        $result = mysqli_query($connection,"select * from reservations".$qext." order by start asc"  );
        $obj=new stdClass();
        $obj->reservations=array();
        // $obj->reservations[]=array('id'=> $row[0],'szoba' =>$row[1] , 'checkin' => $row[2],'checkout'=>$row[3],
        // 'persons'=> $row[4], 'name' => $row[5], 'email'=> $row[6], 'tel'=>$row[8], 'status' => 'payed');
         while($row = $result->fetch_row())
         {
             switch ($row[7]){
             case 1: $status = 'unpaid';
                    break;
             case 2: $status = 'unpaid';
             break;
             case 3: $status = 'paid';
             break;
             case 4: $status = 'promo';
             break;
             case 5: $status = 'maintance';
             }
            $obj->reservations[]=array('id'=> $row[0],'szoba' =>$row[1] , 'checkin' => $row[2],'checkout'=>$row[3],
            'persons'=> $row[4], 'name' => $row[5], 'email'=> $row[6], 'tel'=>$row[8], 'status' => $status);
            
         }
        mysqli_free_result($result);
        // return array(items=>$item,itemnumbers=>$itemnumber,sectionid=>$section);
        echo json_encode($obj);
}
        include 'close_db.php';
?>