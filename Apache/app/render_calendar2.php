<?php
include_once 'config/database_config.php';
include_once 'functions/connect_db.php';
$roomstoshow=7;
if (isset($_POST['masterdate'])){
    //return "hallo";
    $yearly=false;
    $beds=0;
    $masterdate=$_POST['masterdate'];  // any date in the month to show
    if (isset($_POST['start'])) $st=$_POST['start'];    //start date of the bookning
    if (isset($_POST['stop'])) $stop=$_POST['stop'];    //stop date of the bookning
    if (isset($_POST['status'])) $status=$_POST['status']; //status of the bookning
    if (isset($_POST['slot'])) $slot=$_POST['slot'];        // slot lenght from the day of start
    $start->year=date("Y",$st); $start->month=date("m",$st); $start->day=date("d",$st);
    $end->year=date("Y",$stop); $end->month=date("m",$stop); $end->day=date("d",$stop);
    $slotx->year=date("Y",$slot); $slotx->month=date("m",$slot); $slotx->day=date("d",$slot);
    switch ($status){
        case 0:
            $bgcolor="warning";
            break;
        case 1:
            $bgcolor="danger";
            break;
        case 2:
            $bgcolor="primary";
            break;
        case 3:
            $bgcolor="info";
            break;
        case 10:    // special case for bookning
            $bgcolor="success";
            break;
    }
   // $stop=15;
   // $yearly=0; // only monthly calendar possible here
    $ret= $_POST['data'];
    $datenow=$masterdate;
    $ret='';
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptedLanguage = ['sv','hu']; 
    $pageLanguage = in_array($lang, $acceptedLanguage) ? $lang : 'def';
    $pageLanguage="def"; //to force a language.
    require_once "languages/language-$pageLanguage.php"; 
    include_once "functions/get_translation.php";

    $today=date("d",$datenow);
    $year=date("Y",$datenow);
    $month=date("m",$datenow);
    $datenow=mktime(0,0,0,$month,1,$year);
    if (isset($_POST['admin']) && $_POST['admin'] == 1 ){
        $admin=1;
     //   include_once 'functions/render_admin.php';
    }
    else {
        $admin=0;
     //   include_once 'functions/render_user.php';
    }
   

    // reading the database, we do it here to avoid multiple calls. 
    //TODO: parameterize the query.
  //  $roomsdata=json_decode(getnumberofrooms($beds,$connection));
    $rooms=$roomsdata->rooms;
    $dataset="data-start='".$st."' data-stop='".$stop."' data-status='".$status."' data-slot='".$slot."'";
  //  $reservations=json_decode(getdata($year,$month,$today,$connection,$beds));
    $ret.='<div id="calendar" class="container-fluid">';    
    // the header of the calendar section with previous and next buttons and the header
    $ret.= '<div class="row">';
    $ret.= '<div class="col-sm-3 text-center">';
    if (!$yearly)
       $ret.='<a '.$dataset.' class="btn btn-sm btn-primary" style="font-size:10px;" onclick="prev_mini(this)" data-master='.mktime(0,0,0,$month-1,1,$year).' id="prev_min"><</a>';
    else
        $ret.='<button '.$dataset.' class="btn btn-sm btn-primary" style="font-size:10px;" onclick="prev_mini(this)" data-master='.mktime(0,0,0,$month,1,$year-1).' id="prev_mi"><</button>';
    $ret.= '</div>';
    $ret.= '<div class="col-sm-6 text-center">';
    if (!$yearly)
        $ret.="<H6 style='margin-top:0px; font-size:10px'> ".$year." ".$monthnames[$month-1]."</H6>";
    else
        $ret.="<H6 style='margin-top:0px; font-size:10x'> ".$year."</H6>";
   // $ret.="<span>";    
    $ret.= '</div>';
    $ret.= '<div class="col-sm-3">';
    if (!$yearly)
        $ret.='<a '.$dataset.' class="btn btn-sm btn-primary" style="font-size:10px; " onclick="next_mini(this)" data-master='.mktime(0,0,0,$month+1,1,$year).' id="next_min">></a>';
    else
        $ret.='<button '.$dataset.' class="btn btn-sm btn-primary" style="font-size:10px; " onclick="next_mini(this)" data-master='.mktime(0,0,0,$month,1,$year+1).' id="nex_min">></button>';    
    //$ret.="</span>";    
    $ret.= '</div>';
    $ret.= '</div>';
    
    // end of the header

    // Testing pourposes -> not needed anymore but left for future reference
    //$ret.= '<div class="row">';
    // $ret.= 'Calendar (Cameleon II) (C) Laszlo Kadar 2017-18 in association with IT4GO';
    //  $ret.= date("l jS \of F Y h:i:s A",$datenow).'week starts at: '.$dw.' '.$weekdays[$dw-1].' so we need '.$daysneededfromlastmonth.'days from last month and there was :'.$daysinthismonth.'days in that particular month.</br>';
    //  $ret.= 'We need to render '.$weekstorender.' weeks to render the calendar with '.$fillerdays.' filler days to fill the last week' ;
    //$ret.= '</div>';
    
    $monthstorender=1;
    if ($yearly) {
        $monthstorender=12;
        $month=0;
    }
    for ($m=1;$m<=$monthstorender; $m++)
    {
        if ($yearly)
        {
            if ($month%3==0 )   {
                $ret.='<div class="row">';
                $forcedweeks=0;
                for ($i=1; $i<=3; $i++){
                    $f=weekstorender($year,$month+$i);
                    if ($f>$forcedweeks) $forcedweeks=$f;
                }
            }
            $month++;
            $datenow=mktime(0,0,0,$month,1,$year);
            $ret.='<div class="col-sm-4 text-center border-secondary" data-value="'.$datenow.'" onclick="gotomonth(this)" style="border-radius:5px; border-style:solid; border-color:#ffffff; border-width:1px">';
          //  $ret.='<div class="row text-center">';
            $ret.="<span><H5 style='margin-top:0px'> ".$monthnames[$month-1]."</H5></span>";
            //$ret.= '</div>';
        }
        // calculations
        $dw=date("N",$datenow);  // day of the week for first day in the actual month, 1: monday
        $daysinthismonth=cal_days_in_month (CAL_GREGORIAN , $month , $year);
        if ($month!=1)
            $dayinslastmonth=cal_days_in_month(CAL_GREGORIAN,$month-1,$year);
        else
            $dayinslastmonth=cal_days_in_month(CAL_GREGORIAN,12,$year-1);
        $daysneededfromlastmonth=$dw-1;     // how many days we need to render from last month.
        $daystorender=$daysinthismonth+$daysneededfromlastmonth; //total days to render, exclusive the filler days for next month
        $weekstorender=(int)($daystorender/7);
        if ($daystorender%7 != 0 ) $weekstorender++;
        if ($yearly) {
            $weekstorender=$forcedweeks;
        }
        $fillerdays=$weekstorender*7-$daystorender;  // the days to fill the last week in month with days from next month;
        
        // end of calculations
        
        $ret.= '<div class="row">';  //the container row for the calendar day name header
        for ($i=0;$i<7; $i++)
        // rendering the week days header
        {
            $ret.= '<div class="col-sm-1" style="min-width:14.28%; padding-left:0px; padding-right:0px">';
            $ret.= '<div class="card card-default" style="margin-bottom:5px;">';
            $ret.= '<div class="card-heading text-center" style="font-size:8px; padding-bottom:0px; padding-top:0px">';
            if (!$yearly)
                $ret.= '<span class="card-title">'.$weekdaysshort[$i].'</span>';
            else
                $ret.= '<span class="card-title">'.$weekdaysshort[$i].'</span>';
            $ret.= '</div>';
            $ret.= '</div>';    
            $ret.= '</div>';
        }
        $ret.= '</div>';  // end of the day name container
        for ($u=0;$u<$weekstorender;$u++){
            $ret.= '<div id="weeks'.$u.'" class="row">';    // week container

            for ($i=0;$i<7; $i++)
            {
                $currentday=$u*7+$i+1;
                if ($currentday<=$daysneededfromlastmonth){
                    // here is the last month
                    $currentdaytoshow=$dayinslastmonth-$daysneededfromlastmonth+$currentday;
                    if ($month==1){
                        $currentyeartoshow=$year-1;
                        $currentmonthtoshow=12;
                    }
                    else {
                        $currentmonthtoshow=$month-1;
                        $currentyeartoshow=$year;
                    }
                }
                else
                    if ($currentday-$daysneededfromlastmonth <= $daysinthismonth){
                        //this month
                        $currentdaytoshow=$currentday-$daysneededfromlastmonth;
                        $currentmonthtoshow=$month;
                        $currentyeartoshow=$year;
                    }
                    else {
                        //next month;
                        $currentdaytoshow=$currentday-($daysneededfromlastmonth+$daysinthismonth);
                        if ($month==12){
                            $currentyeartoshow=$year+1;
                            $currentmonthtoshow=1;
                        }
                        else {
                            $currentmonthtoshow=$month+1;
                            $currentyeartoshow=$year;
                        }
                    }
                $currentunixdu=mktime(23,59,59,$currentmonthtoshow,$currentdaytoshow,$currentyeartoshow);
                $currentunixde=mktime(0,0,0,$currentmonthtoshow,$currentdaytoshow,$currentyeartoshow);
                $ret.= '<div class="col-sm-1" style="min-width:14.28%; padding-left:0px; padding-right:0px">';
               // $referrer="onclick='change(".$slotx.")";
               $obj=new StdClass();
               $obj->unix=mktime(9,59,59,$currentmonthtoshow,$currentdaytoshow,$currentyeartoshow);
               $obj->dx=date("Y",$obj->unix).".".date("m",$obj->unix).".".date("d",$obj->unix);
               $obj=json_encode($obj);
               $referrer="onclick='change(".$obj.")'";
                if ($currentday > $daysneededfromlastmonth && $currentday <= $daysneededfromlastmonth+$daysinthismonth ){
                    // we are in the current month
                //    if ($currentdaytoshow>=$start->day && $currentdaytoshow <=$end->day)
                    if ($currentunixdu>=$st && $currentunixde<=$stop)
                        $ret.= '<div '.$referrer.' class="card bg-'.$bgcolor.'" style="margin-bottom:1px;max-height:15px; cursor:pointer">';                    
                    elseif ($currentunixdu>=$st && $currentunixde<=$slot)
                        $ret.= '<div '.$referrer.' class="card bg-success" style="margin-bottom:1px;max-height:15px; cursor:pointer">';                    
                    else
                        $ret.= '<div class="card bg-default" style="margin-bottom:1px;max-height:15px">';
                    $ret.= '<div class="card-heading text-center" style="padding-bottom:0px; padding-top:0px;padding-right:0px">';
                    // if ($currentdaytoshow !=$today)
                         $ret.= '<p class="text-default" style="font-size:8px">'. $currentdaytoshow.'</p>';
                    // else
                    //    $ret.= '<p class="text-danger" style="font-size:8px">'. $currentdaytoshow.'</p>';
                    $ret.= '</div>';
                    $ret.= '<div id="day-'.$currentyeartoshow.'-'.$currentmonthtoshow.'-'.$currentdaytoshow.'"class="card-body bg-danger"  style="padding:0px">';
                    $f="rendertheday";
                    $fakerender=0;    
                   // $ret.=$f($currentyeartoshow,$currentmonthtoshow,$currentdaytoshow, $reservations,$rooms,$roomsdata->roomnumbers,$yearly,$fakerender);
                    $ret.='</div>';
                }
                else {
                    //we are in the filler area
                    if ($currentunixdu>=$st && $currentunixde <=$stop)
                        $ret.= '<div '.$referrer.' class="card bg-'.$bgcolor.'" style="margin-bottom:1px;max-height:15px; cursor:pointer">'; 
                    elseif ($currentunixdu>=$st && $currentunixde<=$slot)
                        $ret.= '<div '.$referrer.' class="card bg-success" style="margin-bottom:1px;max-height:15px; cursor:pointer">';                    
                    else
                        $ret.= '<div class="card bg-default" style="margin-bottom:1px;max-height:15px">';
                    $ret.= '<div class="card-heading text-center" style="padding-bottom:0px; padding-top:0px;padding-right:0px">';
                    $ret.= '<p class="text-info" style="font-size:8px">'. $currentdaytoshow.'</p>';
                    $ret.= '</div>';
                    $ret.= '<div id="day-'.$currentyeartoshow.'-'.$currentmonthtoshow.'-'.$currentdaytoshow.'"class="card-body"  style="padding:0px">';
                    $f="rendertheday"; 
                    $fakerender=1;   
                   // $ret.=$f($currentyeartoshow,$currentmonthtoshow,$currentdaytoshow, $reservations,$rooms,$roomsdata->roomnumbers,$yearly,$fakerender);
                    $ret.= '</div>';
                }
                // Day rendering
                
                // End of day rendering
                // if (!$yearly){
                //     if (!$admin){
                //     $ret.= '<div class="card-footer card-default text-left" style="font-size:10px; padding:2px" >';
                //     $ret.='Szobaszám';
                //     }
                //     else{
                //         $ret.= '<div class="card-footer card-default text-left" style="font-size:10px; padding:2px" >';
                //         $ret.='Szobaszám';
                //     }
                //     $ret.= '</div>'; 
                //}
                $ret.= '</div>';
                $ret.= '</div>';
            }
            $ret.= '</div>'; // end of week container
        } //end of rendering all weeks
        if ($yearly) {
                $ret.='</div>';
                if ($month%3==0 )   $ret.='</div>';
        }
    }  // end of rendering the calendar
    $ret.='</div>';
    echo $ret;





function rendertheday1($data)
{
    return "adat";
}


function getdata($year,$month,$day,$connection,$beds){

 /*   status 0: free
    1: locked
    2: reserved - not payed
    3: reserved - payed
    4: reserved - promo
    5: reserved - maintance*/
   /* 1.szoba 3 ágyas kb 20nm, ára 6000,-/fő/éj 
    2.szoba 2 ágyas kb 22nm, ára 7000,-/fő/éj
    3.szoba 2 ágyas kb 19nm, ára 7000,-/fő/éj
    4.szoba 4 ágyas kb 24nm, ára 6000,-/fő/éj
    5.szoba 4 ágyas kb 20nm, ára 6000,-/fő/éj
    6.szoba 2 ágyas kb 15nm, ára 7000,-/fő/éj
    7.szoba 2 ágyas kb 15nm, ára 7000,-/fő/éj*/
    if ($beds==2) $qext=' where room in (select roomnumber from rooms where beds=2) ';
    if ($beds==3) $qext=' where room in (select roomnumber from rooms where beds=3) ';
    if ($beds==4) $qext=' where room in (select roomnumber from rooms where beds=4) ';
    if ($beds==0) $qext=' ';
    $result = mysqli_query($connection,"select * from reservations".$qext."order by start asc"  );
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
        return json_encode($obj);
}
function getnumberofrooms($beds,$connection){
    if ($beds==0){
        $result=mysqli_query($connection,"select * from rooms;");
    }
    else {
        $result=mysqli_query($connection,"select * from rooms where beds=".$beds.";");
    }
    $obj=new stdClass();
    $obj->rooms=$result->num_rows;
    $obj->roomnumbers=array();
    while ($row=$result->fetch_row()){
        $obj->roomnumbers[]=$row[1];
    }
    mysqli_free_result($result);
    return json_encode($obj);
}
function weekstorender($year,$month){
    $datenow=mktime(0,0,1,$month,1,$year);
    $dw=date("N",$datenow);
    $daysinthismonth=cal_days_in_month (CAL_GREGORIAN , $month , $year);
    if ($month!=1)
        $dayinslastmonth=cal_days_in_month(CAL_GREGORIAN,$month-1,$year);
    else
        $dayinslastmonth=cal_days_in_month(CAL_GREGORIAN,12,$year-1);
    $daysneededfromlastmonth=$dw-1;     // how many days we need to render from last month.
    $daystorender=$daysinthismonth+$daysneededfromlastmonth; //total days to render, exclusive the filler days for next month
    $weekstorender=(int)($daystorender/7);
    if ($daystorender%7 != 0 ) $weekstorender++;
return $weekstorender;
}
}

include_once 'functions/close_db.php';
?>