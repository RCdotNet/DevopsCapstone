<?php
function rendertheday($year,$month,$day, $reservations,$rooms,$roomnumbers,$yearly,$fakerender){
    $de=mktime(0,0,0,$month,$day,$year);
    $du=mktime(23,59,59,$month,$day,$year);
    $day='';
    for ($room = 1 ; $room <=$rooms; $room++){
      $res=checkstatus($reservations,$roomnumbers[$room-1],$de,$du);
      $status=$res->status;
      //$status=0;
      $co='success';
      $ci='success';
      $textco="szabad";
      $textci="szabad";
        if (($status&1)==1){
            //check out
            $textco="#".$res->reservations[1]->id." ".$res->reservations[1]->name." ".$res->reservations[1]->persons." fö";
            $idout=$res->reservations[1]->id;
           // $idout=json_encode($res->reservations[1]->id);
        }
        if (($status&4)==4){
            // check in
            $textci="#".$res->reservations[0]->id." ".$res->reservations[0]->name." ".$res->reservations[0]->persons." fö";
            $idin=$res->reservations[0]->id;
            //$idin=json_encode($res->reservations[0]->id);
        }
        if (($status & 7)==4){
            // today checkout only so bookning possible
            // propogated to rendering
        }
      if (($status &1) != 0) {
        $co='warning';
    }
    if (($status &4) != 0) {
        $ci='warning';
   }
        if (($status&32) == 32 ) $co='primary';
        if (($status&16) == 16 ) $co='info';
        if (($status&8) == 8 ) $co='danger';
        if (($status&256) == 256 ) $ci='primary';
        if (($status&128) == 128 ) $ci='info';
        if (($status&64) == 64 ) $ci='danger';
        if ($fakerender) {
            $co="light";
            $ci="light";
        }
        if ($yearly){
            $height=8;
            $roomt='';
        }
        else{
            $height='12';
            $roomt=$roomnumbers[$room-1];
        }
        if ( $status == 0){  // free book the room
            $ret= '<div class="progress" style="margin-bottom:1px; height:'.$height.'px; border-radius:0px" onclick="book(this)" data-bookningnr="'.$du.'" data-roomnr="'.$roomt.'">';
            $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="szabad" data-placement="top" data-container="body" style="width:50% ;line-height:'.$height.'px;font-size:'.($height-2).'px;text-align:left;padding-left:5px">'.$roomt.'</div> ';
            $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="szabad" data-placement="top" data-container="body" style="width:0%"></div> ';
            $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="szabad" data-placement="top" data-container="body" style="width:50%"></div> ';
            $ret.= '</div>';
        }
        if ( ($status & 7)== 7){ //full all day show the room
            $ret= '<div class="progress" style="margin-bottom:1px; height:'.$height.'px; border-radius:0px" onclick="show_bookning(this)" data-bookningnr="'.$idin.' ">';
            $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="'.$textci.'" data-placement="top" data-container="body" style="width:50%;line-height:'.$height.'px;font-size:'.($height-2).'px;text-align:left;text-align:left;padding-left:5px">'.$roomt.'</div> ';
            $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="'.$textci.'" data-placement="top" data-container="body" style="width:0%"></div> ';
            $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="'.$textci.'" data-placement="top" data-container="body" style="width:50%;"></div> ';
            $ret.= '</div>';
        }
        else {
            switch ($status & 7){
                case 1:{  // only check out today show checkout or book checkin
                    $ret= '<div class="progress" style="margin-bottom:1px; height:'.$height.'px; border-radius:0px">';
                    $ret.= '<div class="progress-bar bg-'.$co.'" data-toggle="tooltip" title="" data-original-title="'.$textco.'" data-placement="top" data-container="body" style="width:50%; border-top-right-radius:5px; border-bottom-right-radius:5px; line-height:'.$height.'px;font-size:'.($height-2).'px;text-align:left;text-align:left;padding-left:5px" onclick="show_bookning(this)" data-bookningnr="'.$idout.'">'.$roomt.'</div> ';
                    $ret.= '<div class="progress-bar bg-success" style="width:0%"></div> ';
                    $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="'.$textci.'" data-placement="top" data-container="body" style="width:50%; border-top-left-radius:5px; border-bottom-left-radius:5px" onclick="book(this)" data-bookningnr="'.$du.'" data-roomnr="'.$roomt.'"></div> ';
                    $ret.= '</div>';
                    break;
                }
                case 4:{ //only check in today show checkin do nothing for checkout
                    $ret= '<div class="progress" style="margin-bottom:1px; height:'.$height.'px; border-radius:0px">';
                    $ret.= '<div class="progress-bar bg-'.$co.'" data-toggle="tooltip" title="" data-original-title="'.$textco.'" data-placement="top" data-container="body" style="width:50%; border-top-right-radius:5px; border-bottom-right-radius:5px; line-height:'.$height.'px;font-size:'.($height-2).'px;text-align:left;text-align:left;padding-left:5px">'.$roomt.'</div> ';
                    $ret.= '<div class="progress-bar bg-success" style="width:0%"></div> ';
                    $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="'.$textci.'" data-placement="top" data-container="body" style="width:50%; border-top-left-radius:5px; border-bottom-left-radius:5px" onclick="show_bookning(this)" data-bookningnr="'.$idin.'"></div> ';
                    $ret.= '</div>';
                    break;
                }
                case 5:{  //checkin and checkout today so, show them
                    $ret= '<div class="progress" style="margin-bottom:1px; height:'.$height.'px; border-radius:0px">';
                    $ret.= '<div class="progress-bar bg-'.$co.'" data-toggle="tooltip" title="" data-original-title="'.$textco.'" data-placement="top" data-container="body" style="width:50%; border-top-right-radius:5px; border-bottom-right-radius:5px; line-height:'.$height.'px;font-size:'.($height-2).'px;text-align:left;text-align:left;padding-left:5px" onclick="show_bookning(this)" data-bookningnr="'.$idout.'">'.$roomt.'</div> ';
                    $ret.= '<div class="progress-bar bg-success" style="width:0%"></div> ';
                    $ret.= '<div class="progress-bar bg-'.$ci.'" data-toggle="tooltip" title="" data-original-title="'.$textci.'" data-placement="top" data-container="body" style="width:50%; border-top-left-radius:5px; border-bottom-left-radius:5px" onclick="show_bookning(this)" data-bookningnr="'.$idin.'"></div> ';
                    $ret.= '</div>';
                    break;  
                }
            }
        }
        $day.=$ret;
    }                           
return $day;
}
function checkstatus($reservations,$room,$de,$du){
    // statuses:
    // 000: free all day
    // 001: check out
    // 100: check in
    // 111: reserved
    // 0xxx: not payed 
    // 1xxx: payed  8
    // 1xxxx : karbantartas 16
    //1xxxxx : promo 32 
    // 1xxxxx: payed 64 check in
    // 1xxxxxxx : karbantartas 128 check in
    //1xxxxxxxx : promo 256 check in
    $obj=new stdClass();
    $obj->status=0;
    $reservation1=new stdClass();
    $reservation2=new stdClass();
    $retval=0;
    
    for ($i=0;$i<count($reservations->reservations); $i++) {
        $checkin=$reservations->reservations[$i]->checkin;
        $checkout=$reservations->reservations[$i]->checkout;
        if ($reservations->reservations[$i]->szoba == $room) {
            if ( $checkin >= $de && $checkin <= $du){
                 $retval|=4; // checkin today
                if ($reservations->reservations[$i]->status=="paid") $retval|=64;
                if ($reservations->reservations[$i]->status=="unpaid") $retval|=0;
                if ($reservations->reservations[$i]->status=="maintance") $retval|=128;
                if ($reservations->reservations[$i]->status=="promo") $retval|=256;
                $reservation1=$reservations->reservations[$i];
            }
            if ($checkin <= $de && $checkout >= $du){
                $retval|=7; // all day
                if ($reservations->reservations[$i]->status=="paid") $retval|=72;
                if ($reservations->reservations[$i]->status=="unpaid") $retval|=0;
                if ($reservations->reservations[$i]->status=="maintance") $retval|=144;
                if ($reservations->reservations[$i]->status=="promo") $retval|=288;
                $reservation1=$reservations->reservations[$i];
                $reservation2=$reservations->reservations[$i];
            }
            if ($checkout >= $de && $checkout <= $du){
                 $retval|=1; // checkout
                if ($reservations->reservations[$i]->status=="paid") $retval|=8;
                if ($reservations->reservations[$i]->status=="unpaid") $retval|=0;
                if ($reservations->reservations[$i]->status=="maintance") $retval|=16;
                if ($reservations->reservations[$i]->status=="promo") $retval|=32;
                $reservation2=$reservations->reservations[$i];
            }
        }
    }
    $obj->reservations[]=$reservation1;
    $obj->reservations[]=$reservation2;
    $obj->status=$retval;
    return $obj;
}
?>