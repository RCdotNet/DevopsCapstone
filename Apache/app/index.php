<!DOCTYPE html>
<html lang="en" style="overflow-y:scroll">
<head>
    <title>Cameleon II</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <script src="scripts/bootstrap/jquery-3.2.1.min.js"></script>
<link rel='stylesheet' href='css/bootstrap.min.css' >
</head>

<body>
<script src="scripts/bootstrap/popper.min.js" ></script>
<script src="scripts/bootstrap/bootstrap.min.js"> </script>
<?php
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
HDBKLhölyEGLeögy
$acceptedLanguage = ['sv','hu']; 
$pageLanguage = in_array($lang, $acceptedLanguage) ? $lang : 'def';
$pageLanguage="def"; //to force a language.
require_once "languages/language-$pageLanguage.php"; 
include_once "functions/get_translation.php";
//        phpinfo();
include_once 'config/sys_config.php';
$masterdate=mktime();
include_once 'render_calendar2.php';
include_once 'version.php';
?>
<div class="container-fluid">
 
  <div id='container' class='row'>
    <div id='left' class='col-sm-2'>
      <div class='card border-primary'>
        <div class='card-header text-center'>
          <?php echo get_translation("legend");?>
        </div>
        <div class='card-body'>
          <div class='row'>
            <div class='col-sm-12'>
           <?php
           if (isset($developer) && $developer==1)
           {
              $ret='<div class="progress" style="margin-bottom:5px; height:20px">
               <div class="progress-bar bg-success" style="width:100%">'.get_translation("available").' - success</div>
              </div>
              <div class="progress" style="margin-bottom:5px; height:20px">
                <div class="progress-bar bg-warning" style="width:100%">'.get_translation("notpayed").' - warning</div>
              </div>
              <div class="progress" style="margin-bottom:5px; height:20px">
                <div class="progress-bar bg-danger" style="width:100%">'.get_translation("respayed").' - danger</div>
              </div>
              <div class="progress" style="margin-bottom:5px; height:20px">
                <div class="progress-bar bg-primary" style="width:100%">'.get_translation("promo").' - primary </div>
              </div>
              <div class="progress" style="margin-bottom:5px; height:20px">
                <div class="progress-bar bg-info" style="width:100%">'.get_translation("maintance").' - info</div>
              </div>
              <div class="progress" style="margin-bottom:5px; height:20px">
                <div class="progress-bar bg-secondary" style="width:100%">test - secondary</div>
              </div>
              <div class="progress" style="margin-bottom:5px; height:20px">
                <div class="progress-bar bg-light text-dark" style="width:100%">test - light</div>
              </div>
              <div class="progress" style="margin-bottom:5px; height:20px">
                <div class="progress-bar bg-dark" style="width:100%">test - dark</div>
              </div> ';
           }
              else if (isset($admin) && $admin==1)
              {
              $ret='<div class="progress" style="margin-bottom:5px; height:20px">
              <div class="progress-bar bg-success" style="width:100%">'.get_translation("available").'</div>
             </div>
             <div class="progress" style="margin-bottom:5px; height:20px">
               <div class="progress-bar bg-warning" style="width:100%">'.get_translation("notpayed").'</div>
             </div>
             <div class="progress" style="margin-bottom:5px; height:20px">
               <div class="progress-bar bg-danger" style="width:100%">'.get_translation("respayed").'</div>
             </div>
             <div class="progress" style="margin-bottom:5px; height:20px">
               <div class="progress-bar bg-primary" style="width:100%">'.get_translation("promo").'</div>
             </div>
             <div class="progress" style="margin-bottom:5px; height:20px">
               <div class="progress-bar bg-info" style="width:100%">'.get_translation("maintance").'</div>
             </div>';
              }
            else {
              $ret='<div class="progress" style="margin-bottom:5px; height:20px">
              <div class="progress-bar bg-success" style="width:100%">'.get_translation("available").'</div>
             </div>
             <div class="progress" style="margin-bottom:5px; height:20px">
               <div class="progress-bar bg-danger" style="width:100%">'.get_translation("reserved").'</div>
             </div>';
              }
              echo $ret;
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class='card border-primary'>
        <div class='card-header text-center'>
        <?php echo get_translation("viewtype");?>
        </div>
        <div class='card-body'>
          <div class='row'>
          <div class='col-sm-12' style="padding:10">
          <button class="btn btn-sm btn-outline-primary" onclick="month()" value=<?php echo $masterdate?> id="month"><?php echo get_translation("monthly");?></button>
          <button class="btn btn-sm btn-outline-primary" onclick="year()" value=<?php echo $masterdate?> id="year"><?php echo get_translation("yearly");?></button>
          <button class="btn btn-sm btn-outline-primary" onclick="changesurface(this)" value=<?php echo $masterdate?> id="Chg"><?php echo get_translation("admin");?></button>     
          </div>
          </div>
        </div>
      </div>
      <div class='card border-primary'>
        <div class='card-header text-center'>
        <?php echo get_translation("bybeds");?>
        </div>
        <div class='card-body'>
          <div class='row'>
          <div class='col-sm-12'>
          <button class="btn btn-sm btn-outline-primary" onclick="twobeds(this)" value=<?php echo $masterdate?> id="two">2</button>
          <button class="btn btn-sm btn-outline-primary" onclick="threebeds(this)" value=<?php echo $masterdate?> id="three">3</button>
          <button class="btn btn-sm btn-outline-primary" onclick="fourbeds(this)" value=<?php echo $masterdate?> id="four">4</button>
          <button class="btn btn-sm btn-outline-primary" onclick="allrooms(this)" value=<?php echo $masterdate?> id="all"><?php echo get_translation("all");?></button>
          </div>
          </div>
        </div>
        <div class='card-footer text-right'>
          <p style="font-size:14px; margin-bottom:0px"> Commit: <?php echo $repoversion;?>
          <p style="font-size:14px; margin-bottom:0px"> IP (for load balancer demo): <?php echo $_SERVER['SERVER_ADDR'];?>
          </div>
      </div>
    </div>
    <div id='center' class='col-sm-10' style="padding-right:10px">
      <?php
      //that is a special february
    //  echo rd2($masterdate);
        $year=2010;
        $month=2;
      ?>
      
    </div>
   <!-- <div id='right' class='col-sm-2'>
    <div class='card border-danger'>
        <div class='card-header text-center'>
        Iteration 4
        </div>
        <div class='card-body'>
          <div class='row'>
          <div class='col-sm-12'>
          Foglalás megjelenítés
          <?php if (isset($developer) && $developer==1) echo "</br> Developer mode!";?>
          </div>
          </div>
        </div>
      </div>
    </div>-->
  </div>
 <!-- definition of show bookning modal -->

 <!-- definition of new bookning modal -->
 <?php
 if ($developer){
 $t="1234";
 $n="Laszlo Kadar";
 $e="email@email.com";
 $m="remark";
 }
 else {
  $t="";
  $n="";
  $e="";
  $m="";
 }
 ?>
<div id='new_bookning' class='modal' role='dialog' tabindex='-1'>
  <div class='modal-dialog'>
  <!-- Modal content-->
    <div class='modal-content modal-popout-bg'>
      <div class='modal-header' id='new_bookning_head'>
        <h5 id='new_bookning_h_text' class='modal-title'>
        <?php echo get_translation("newreservation");?>
        </h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body product-body' id='new_bokning_body'>
      <form class="needs-validation" id="new_bookning_form" method="post"  novalidate >
       <!--   onsubmit="return make_bookning(this,this.n_guest,'1',this.n_from,this.n_to,this.n_tel,this.n_email,n_memo,'test','payed')">
-->
        <div class='row' id='l1' style='display:none'>
          <div class='col-sm-8' id='l2'>
            </p style='display:none'><?php echo get_translation("room");?><span id='roomnr' name='roomnr' value=""></span><?php echo get_translation("reservation");?></p>
          </div>
        </div>
        <div class='row'>
          <div class='col-sm-8'>
            <div class='form-group' style='display:block'>
              <label for='n_guest'><?php echo get_translation("guest");?></label>
              <input disabled type='text' name='n_guest' class='form-control' id='n_guest' placeholder='<?php echo get_translation("guestb");?>' required='required' value='<?php echo $n;?>'/>
              <div class="invalid-feedback">
              <?php echo get_translation("namerequired");?>
                </div>
            </div>
          </div>
          <div class='col-sm-4'>
            <div class='form-group' style='display:block'>
              <label for='n_persons'><?php echo get_translation("numberofquests");?>
</label>
              <select disabled class="custom-select" id="n_persons" name="n_persons">
                  <option value="1"><?php echo get_translation("onep");?></option>
                  <option selected="selected"  value="2"><?php echo get_translation("twop");?></option>
                  <option value="3"><?php echo get_translation("threep");?></option>
                  <option value="4"><?php echo get_translation("fourp");?></option>
                </select>

              <div class="invalid-feedback">
              <?php echo get_translation("reqnumberofquests");?>
              </div>
            </div>
          </div>
        </div>
        <div class='row'>
            <div class='col-sm-6'>
              <div class='form-group' style='display:block'>
                <label for='n_from'><?php echo get_translation("arrival");?></label>
                <input disabled type='text' name='n_from' class='form-control' id='n_from' placeholder='<?php echo get_translation("arrivalfrom");?>' required='required' />
                <div class="invalid-feedback">
                <?php echo get_translation("reqarrival");?>
                </div>
              </div>
              <!-- ide jön a naptar-->
              <div class='form-group' style='display:block'>
                <label for='n_tel'><?php echo get_translation("phone");?></label>
                <input disabled  type='text' name='n_tel' class='form-control' id='n_tel' placeholder='<?php echo get_translation("phoneb");?>' required='required' value='<?php echo $t;?>'/>
                <div class="invalid-feedback">
                <?php echo get_translation("reqphone");?>
                </div>
              </div>
            </div>
            <div class='col-sm-6'>
              <div class='form-group' style='display:block'>
                <label for='n_to'><?php echo get_translation("departure");?></label>
                <input disabled type='text' name='n_to' class='form-control' id='n_to' placeholder='<?php echo get_translation("departureto");?>' required='required' />
                <div class="invalid-feedback">
                <?php echo get_translation("reqdeparture");?>
                </div>
              </div>
              <!-- ide jön a naptar-->
              <div class='row' style="display:block">
                <div class='col-sm-12' id='minicalright' style="display:none">
                <?php /*echo rd2($masterdate,3,7);*/ ?>
                </div>
              </div>
              <div class='form-group' style='display:block'>
                <label for='n_email'><?php echo get_translation("email");?></label>
                <input disabled type='text' name='n_email' class='form-control' id='n_email' placeholder='<?php echo get_translation("emailaddr");?>' required='required' value='<?php echo $e;?>'/>
                <div class="invalid-feedback">
                <?php echo get_translation("reqemail");?>
                </div>
              </div>
            </div>
          </div>
          <div   class='row'>
            <div class='col-sm-12'>
            <?php if ($admin)
            {
              echo "<div class='form-group' style='display:block'>";
            }
            else
            {
              echo "<div class='form-group' style='display:none'>";
            }
            ?>
              <label for="n_status" id="n_status_label"><?php echo get_translation("typeofreservation");?></label>
                <select disabled class="custom-select" id="n_status" name="n_status">
  <!--                 <option value="1">Locked</option> -->
                  <option value="2"><?php echo get_translation("notpayed");?></option>
                  <option selected="selected"  value="3"><?php echo get_translation("respayed");?></option>
                  <option value="4"><?php echo get_translation("promo");?></option>
                  <option value="5"><?php echo get_translation("maintance");?></option>
                </select>
                </div>
            </div>
          </div>
            <div   class='row'>
              <div class='col-sm-12'>
                <div class='form-group' style='display:block'>
                  <label for='n_memo'><?php echo get_translation("remark");?></label>
                  <input disabled type='text' name='n_memo' class='form-control' id='n_memo' placeholder='<?php echo get_translation("remarka");?>' value='<?php echo $m;?>'/>
                </div>
              </div>
            </div>
              
          </div>
        <div class='modal-footer' id='new_bookning_foot'>
         <!-- <div class="row"> -->
            <div class="col-sm-2">
            <a id="btn-delete" data-bookningnr="" onclick='delete_bookning(this)' data-toggle='modal' href='#new_bookning' class='btn btn-sm btn-danger style=margin:8px'><?php echo get_translation("delete");?></a>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
              <a id="btn-confirm" onclick="make_bookning(this)" class='btn btn-sm btn-success' style='margin:8px'><?php echo get_translation("confirmb");?></a>
              <a id="btn-update" onclick="update_bookning(this)" class='btn btn-sm btn-success' style='margin:8px'><?php echo get_translation("modifyb");?></a>
              <a id="btn-perform-update" onclick="perform_update_bookning(this)" class='btn btn-sm btn-success' style='margin:8px'><?php echo get_translation("confirmmodifyb");?></a>
              <a data-toggle='modal' href='#new_bookning' class='btn btn-sm btn-primary pull-right' style='margin:8px; display:inline'><?php echo get_translation("backb");?></a>
            </div>
          </div>
        <!--</div>-->
      </form>
    </div>
  </div>
</div>

 <!-- definition of delete bookning modal -->
 <div id='delete_bookning' class='modal' role='dialog' tabindex='-1'>
  <div class='modal-dialog'>
  <!-- Modal content-->
    <div class='modal-content modal-popout-bg'>
      <div class='modal-header' id='delete_bookning_head'>
          <h5 id='delete_bookning_h_text' class='modal-title'>
          <?php echo get_translation("confirmdelete");?>
          </h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body product-body' id='delete_bokning_body'>
        <div class='row'>
          <br />
          <div id='bookningdel'> <?php echo get_translation("aryousuretodelete");?> </div>
          <?php echo get_translation("irreversible");?>
          <div class='col-sm-4'>
          </div>
          <div class='col-sm8'>
          </div>
        </div>
      </div>
      <div class='modal-footer' id='delete_bookning_foot'>
        <a id='suretodelete' onclick='suretodelete(this)' data-toggle='modal' href='#delete_bookning' class='btn btn-sm btn-danger style=margin:8'><?php echo get_translation("deleteb");?></a>
        <span></span>
      
        <a data-toggle='modal' href='#delete_bookning' class='btn btn-sm btn-primary style=margin:8'><?php echo get_translation("cancel");?></a>
      </div>
    </div>
  </div>
</div>
<!-- definition of confim bookning modal -->
 <div id='confirm_bookning' class='modal' role='dialog' tabindex='-1'>
  <div class='modal-dialog'>
  <!-- Modal content-->
    <div class='modal-content modal-popout-bg'>
      <div class='modal-header' id='confirm_bookning_head'>
          <h5 id='confirm_bookning_h_text' class='modal-title'>
          <?php echo get_translation("thankyou");?>
          </h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id='confirm_bokning_body'>
        <div class='row'>
          <br />
          <div id='bookningconf'> <?php echo get_translation("registered1");?> </div>
          <?php echo get_translation("registered2");?>

          <div class='col-sm-4'>
          </div>
          <div class='col-sm8'>
          </div>
        </div>
      </div>
      <div class='modal-footer' id='confirm_bookning_foot'>
        <a data-toggle='modal' href='#confirm_bookning' class='btn btn-sm btn-success style=margin:8'><?php echo get_translation("ok");?></a>
      </div>
    </div>
  </div>
</div>

<script>   
var beds=0;
var currentrendered;
var yearly=0;
var admin=<?php if (isset($admin)) echo $admin; else echo 0;?>;
setsurface(admin);
$(document).ready(function() {
//page is now ready, initialize the calendar...
  currentrendered=<?php echo $masterdate;?>;
  document.getElementById("all").classList.add("active");
  //document.getElementById("Chg").innerHTML="Vendég";
 // document.getElementById("all").style.display="none";
  $.ajax( { type : 'POST',
    //dataType:'json', 
    data : {'data': <?php echo $masterdate;?>,//,
    //'yearly':1
    'admin':admin,
    'beds':beds
    },
    url  : 'rendercalendar.php',
    target: '#center',              
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json );               
      $("#center").fadeIn("slow", function () {
        $(this).html(json);
        $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}}); 
        //"delay: { 'show': 500, 'hide': 100 }"
          //$('[data-toggle="tooltip"]').tooltip('dispose');
      });         
    },
    error: function ( xhr ) {
      alert( "error: "+xhr );
    }
  });

});
function show_bookning(bookning){
   if (bookning.stopPropagation){
       bookning.stopPropagation();
   }
   else if(window.event){
      window.event.cancelBubble=true;
   }
  if (admin){
  $('[data-toggle="tooltip"]').tooltip("hide");
  $('#new_bookning').modal('show');
  // set disabled attribute
  // $("input[name='n_guest']").prop("disabled",true);
  // $("input[name='n_to']").prop("disabled",true);  
  // $("input[name='n_tel']").prop("disabled",true);  
  // $("input[name='n_email']").prop("disabled",true);  
  // $("input[name='n_memo']").prop("disabled",true);    
  // $("select[name='n_status']").prop("disabled",true); 
  document.getElementById("btn-delete").style.display="inline"; 
  document.getElementById("btn-update").style.display="inline";
  document.getElementById("btn-perform-update").style.display="none";  
  document.getElementById("btn-confirm").style.display="none";
  document.getElementById("minicalright").style.display="none"; 
  document.getElementById("new_bookning_h_text").innerHTML=bookning.dataset.bookningnr+" számú foglalás részletei:";
  document.getElementById("btn-delete").dataset.bookningnr=bookning.dataset.bookningnr;
  document.getElementById("btn-update").dataset.bookningnr=bookning.dataset.bookningnr;
  if (admin) { 
    $("select[name='n_status']").removeAttr("disabled");
    document.getElementById("n_status").style.display="inline"; 
    document.getElementById("n_status_label").style.display="inline"; 
  }
 // return false;
        var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.open("POST", "functions/get_bookning.php", false);       //we want this sync
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("p="+bookning.dataset.bookningnr);
            var res = "";
            var res = JSON.parse (xhttp.responseText);
            if (res.status=="OK"){
              document.getElementById("n_guest").value = res.customer;
              document.getElementById("n_from").value = res.startdx;
              document.getElementById("n_from").dataset.unix = res.start;
              document.getElementById("n_to").value = res.enddx;
              document.getElementById("n_to").dataset.unix = res.end;
              document.getElementById("roomnr").innerHTML = res.room;
              document.getElementById("roomnr").value = res.room;
              document.getElementById("n_tel").value = res.tel;
              document.getElementById("n_email").value = res.email;
              document.getElementById("btn-delete").dataset.email=res.email;
              document.getElementById("btn-delete").dataset.customer=res.customer;
              document.getElementById("n_persons").value=res.persons;
              if (res.remark)
                document.getElementById("n_memo").value = res.remark;
              else
                document.getElementById("n_memo").value = "";
              statuselement=document.getElementById("n_status");
              statuselement.selectedIndex=res.bookningstatus-2;   //TODO: fix this index thing better
               // set disabled attribute
  $("input[name='n_guest']").prop("disabled",true);
  $("input[name='n_to']").prop("disabled",true);  
  $("input[name='n_tel']").prop("disabled",true);  
  $("input[name='n_email']").prop("disabled",true);  
  $("input[name='n_memo']").prop("disabled",true);    
  $("select[name='n_status']").prop("disabled",true); 
  $("select[name='n_persons']").prop("disabled",true); 
             }
            else
            alert("An error occured->"+res.message);
                 console.log(res);
  }
}
function delete_bookning(bookning){
  $('#delete_bookning').modal('show');
  document.getElementById("bookningdel").innerHTML='Biztos törli a '+bookning.dataset.bookningnr+"számú foglalást?";
  document.getElementById("suretodelete").dataset.bookningnr=bookning.dataset.bookningnr;
  document.getElementById("suretodelete").dataset.email=bookning.dataset.email;
  document.getElementById("suretodelete").dataset.customer=bookning.dataset.customer;

        // var xhttp;
        //     xhttp = new XMLHttpRequest();
        //     xhttp.open("POST", "functions/get_bookning.php", false);       //we want this sync
        //     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //     xhttp.send("p="+bookning.dataset.bookningnr);
        //     var res = "";
        //     var res = JSON.parse (xhttp.responseText);
        //     document.getElementById("guest").innerHTML = res.customer;
        //     document.getElementById("checkin").innerHTML = res.start;
        //     document.getElementById("checkout").innerHTML = res.end;
        //     document.getElementById("room").innerHTML = res.room;
        //     document.getElementById("tel").innerHTML = res.tel;
        //     document.getElementById("email").innerHTML = res.email;
        //          console.log(res);
        // //         init_editor();
        //         var myeditor='e_long';
        //         tinymce.get(myeditor).setContent(res.long);
    
}

function suretodelete(bookning){
  var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.open("POST", "functions/delete_bookning.php", false);       //we want this sync
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("p="+bookning.dataset.bookningnr);  
            //alert(JSON.parse(xhttp.responseText));
            send_mail(3,bookning.dataset.bookningnr,0,0,0,bookning.dataset.customer,0,bookning.dataset.email,0,0,0);
            render();
}

function book(bookning){
   if (bookning.stopPropagation){
       bookning.stopPropagation();
   }
   else if(window.event){
      window.event.cancelBubble=true;
   }
if (1){   //write admin i condition if only admin allowed to book, if 1, then will be an user prebookning.
  $('[data-toggle="tooltip"]').tooltip("hide");
  $('#new_bookning').modal('show');
  // Remove disabled and attribute
  $("input[name='n_guest']").removeAttr("disabled");
//  $("input[name='n_to']").removeAttr("disabled");  
  $("input[name='n_tel']").removeAttr("disabled");  
  $("input[name='n_email']").removeAttr("disabled");  
  $("input[name='n_memo']").removeAttr("disabled");  
  if (admin) { 
    $("select[name='n_status']").removeAttr("disabled");
    document.getElementById("n_status").style.display="inline"; 
    document.getElementById("n_status_label").style.display="inline"; 
  }
  else{
    document.getElementById("n_status").style.display="none"; 
    document.getElementById("n_status_label").style.display="none"; 
  }
  $("select[name='n_persons']").removeAttr("disabled"); 
  document.getElementById("btn-delete").style.display="none"; 
  document.getElementById("btn-update").style.display="none";
  document.getElementById("btn-perform-update").style.display="none";   
  document.getElementById("btn-confirm").style.display="inline"; 
  document.getElementById("minicalright").style.display="inline";
  document.getElementById("new_bookning_h_text").innerHTML=bookning.dataset.roomnr+ " szoba foglalás";
  document.getElementById("roomnr").innerHTML=bookning.dataset.roomnr;
  document.getElementById("roomnr").value=bookning.dataset.roomnr;
  // clearing fields
  document.getElementById("n_guest").value="";
  document.getElementById("n_tel").value="";
  document.getElementById("n_email").value="";
  document.getElementById("n_memo").value="";

  var chkin=new Date(bookning.dataset.bookningnr*1000);
  var m = (chkin.getMonth()+1);
  var d=chkin.getDate();
  m= m<10 ? '0'+m : m;
  d= d<10 ? '0'+d : d;
  var checkin=chkin.getFullYear()+"."+m+"."+d;
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'start': bookning.dataset.bookningnr,
    'end':bookning.dataset.bookningnr,
    'room':bookning.dataset.roomnr
    },
    url  : 'functions/get_slotlenght.php',
    target: '#new_bookning',              
    success: function ( json ) {
      var res=JSON.parse(json);
      $("#n_to").val(res.dx);
      $("#n_to").data("data-unix",res.start);
      $("#n_from").val(checkin);
      $("#n_to").data("data-unix",bookning.dataset.bookningnr);
      $("#roomnr").val(bookning.dataset.roomnr);
      document.getElementById("n_to").dataset.unix=res.start;
      document.getElementById("n_from").dataset.unix=bookning.dataset.bookningnr;
      console.log(res);  
      var pers = document.getElementById("n_persons").getElementsByTagName("option");
      for (var i = 0; i < pers.length; i++) {
        // lowercase comparison for case-insensitivity
        if (pers[i].value <= res.beds) {
          pers[i].disabled = false;
        }
        else {
          pers[i].disabled = true;  
        }
      }
      document.getElementById("n_persons").selectedIndex=beds-1;
      $.ajax( { type : 'POST',
          data : {'masterdate': document.getElementById("n_from").dataset.unix,
            'start': document.getElementById("n_from").dataset.unix,
            'stop':document.getElementById("n_to").dataset.unix,
            'status' : 10, // special case document.getElementById("n_status").selectedIndex,
            'slot':res.start
          },
          url  : 'render_calendar2.php',
          target: '#center',              
          success: function ( json ) {           
            $("#minicalright").fadeIn("slow", function () {
            $(this).html(json);
            });         
          },
          error: function ( xhr ) {
            alert( "error: "+xhr );
          }
        });
    },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  }); 
}
}

function make_bookning(room)
{
  console.log(room);
  var parent=document.getElementById("new_bookning_form");
  console.log(parent);
  if (parent.checkValidity() === false) {
          //event.preventDefault();
          console.log("invalid");
          //event.stopPropagation();
          parent.classList.add("was-validated");
          return false;

        }
        else console.log("valid");
  parent.classList.add("was-validated");
  room=document.getElementById("roomnr").value;
  name=document.getElementById("n_guest").value;
  persons=document.getElementById("n_persons").value;
  from=document.getElementById("n_from").value;
  to=document.getElementById("n_to").value;
  tel=document.getElementById("n_tel").value;
  email=document.getElementById("n_email").value;
  remark=document.getElementById("n_memo").value,
  statuselement=document.getElementById("n_status");
  status=statuselement.options[statuselement.selectedIndex].value;
  user="test";
 if (admin){
    $.ajax( { type : 'POST',
    //dataType:'json',
    data : {
    'room':room,
    'start':from,
    'end':to,
    'name':name,
    'persons':persons,
    'email':email,
    'tel':tel,
    'remark':remark,
    'user': "test",
    'status': status
    },
    url  : 'functions/save_bookning.php',
               
    success: function ( json ) {
      // $('#new_bookning').modal('hide');
      //var res=JSON.parse(json);
      // $('#center').html(json);
       //alert( json );               
    // console.log(res); 
    var status=JSON.parse(json); 
    console.log(json);
    if (status.status=="OK"){
      $('#new_bookning').modal('hide');
      render();
      send_mail(1,status.id,room,from,to,name,persons,email,tel,remark,status);
      return true; 
    }
    else{
      $('#new_bookning').modal('hide');
      alert("Hiba történt->"+status.message);
      console.log("-"+json+"-");
      render();
      return true;
    }
    },
      error: function ( xhr ) {
        alert( "error: "+xhr.status+" "+xhr.statusText );
         console.log("error: "+xhr); 
        return false;
      }
  });
}
else {
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {
    'room':room,
    'start':from,
    'end':to,
    'name':name,
    'persons':persons,
    'email':email,
    'tel':tel,
    'remark':remark,
    'user': "test",
    'status': 2
    },
    url  : 'functions/save_prebookning.php',
               
    success: function ( json ) {
      // $('#new_bookning').modal('hide');
      //var res=JSON.parse(json);
      // $('#center').html(json);
       //alert( json );               
    // console.log(res); 
    var status=JSON.parse(json); 
    console.log(json);
    if (status.status=="OK"){
      $('#new_bookning').modal('hide');
      render();
      send_mail2(1,status.id,room,from,to,name,persons,email,tel,remark,status);
       $('#confirm_bookning').modal('show');
      return true; 
    }
    else{
      $('#new_bookning').modal('hide');
      alert("Hiba történt->"+status.message);
      console.log("-"+json+"-");
      render();
      return true;
    }
    },
      error: function ( xhr ) {
        alert( "error: "+xhr.status+" "+xhr.statusText );
         console.log("error: "+xhr); 
        return false;
      }
  });
}
}
function send_mail(kindof,bookningsnr,room,fr,to,name,persons,email,tel,remark,satus){
  console.log("sending->",kindof,bookningsnr,room,fr,to,name,persons,email,tel,remark,status);
  $.ajax( { type : 'POST',
        //dataType:'json',
        data : {
          'kindof':kindof,
          'bookningsnr':bookningsnr,
        'room':room,
        'start':fr,
        'end':to,
        'name':name,
        'persons':persons,
        'email':email,
        'tel':tel,
        'remark':remark,
        'status':status
        },
        url  : 'functions/email_sender.php',              
        success: function ( json ) {
         
        },
        error: function ( xhr ) {
          alert( "Mail küldése nem sikerül. "+xhr );   
      },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  });   
}
function send_mail2(kindof,bookningsnr,room,fr,to,name,persons,email,tel,remark,satus){
  console.log("sending->",kindof,bookningsnr,room,fr,to,name,persons,email,tel,remark,status);
  $.ajax( { type : 'POST',
        //dataType:'json',
        data : {
          'kindof':kindof,
          'bookningsnr':bookningsnr,
        'room':room,
        'start':fr,
        'end':to,
        'name':name,
        'persons':persons,
        'email':email,
        'tel':tel,
        'remark':remark,
        'status':status
        },
        url  : 'functions/email_sender2.php',              
        success: function ( json ) {
         
        },
        error: function ( xhr ) {
          alert( "Mail küldése nem sikerül. "+xhr );   
      },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  });   
}
function update_bookning(reservation)
{
   $("input[name='n_guest']").removeAttr("disabled");
 // $("input[name='n_to']").removeAttr("disabled");  
  $("input[name='n_tel']").removeAttr("disabled");  
  $("input[name='n_email']").removeAttr("disabled");  
  $("input[name='n_memo']").removeAttr("disabled");    
  $("select[name='n_status']").removeAttr("disabled"); 
  $("select[name='n_persons']").removeAttr("disabled"); 
  
   document.getElementById("btn-update").style.display="none";
  document.getElementById("btn-perform-update").style.display="inline";
  document.getElementById("btn-perform-update").dataset.bookningnr=reservation.dataset.bookningnr;
  var slot;
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'start': document.getElementById("n_from").dataset.unix,
    'end':document.getElementById("n_to").dataset.unix,
    'room':document.getElementById("roomnr").value
    },
    url  : 'functions/get_slotlenght2.php',
    target: '#new_bookning',              
    success: function ( json ) {
      var res=JSON.parse(json);
     // $("#n_to").val(res.dx);  don't need to modify the value here
      slot=res.start;
      var pers = document.getElementById("n_persons").getElementsByTagName("option");
      for (var i = 0; i < pers.length; i++) {
        // lowercase comparison for case-insensitivity
        if (pers[i].value <= res.beds) {
          pers[i].disabled = false;
        }
        else {
          pers[i].disabled = true;  
        }
      }
      console.log(res);  
        $.ajax( { type : 'POST',
          data : {'masterdate': document.getElementById("n_to").dataset.unix,
            'start': document.getElementById("n_from").dataset.unix,
            'stop':document.getElementById("n_to").dataset.unix,
            'status' : statuselement.selectedIndex,
            'slot':slot
          },
          url  : 'render_calendar2.php',
          target: '#center',              
          success: function ( json ) {           
            $("#minicalright").fadeIn("slow", function () {
            $(this).html(json);
            });         
          },
          error: function ( xhr ) {
            alert( "error: "+xhr );
          }
        }); 
    },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  });
  
  document.getElementById("minicalright").style.display="inline";

  return false;
}

function change(newdate){
  console.log(newdate);
  console.log(newdate.dx);
  console.log(newdate.unix);
 // var res=JSON.parse(newdate);
  document.getElementById("n_to").value=newdate.dx;
  document.getElementById("n_to").dataset.unix=newdate.unix;
}

function perform_update_bookning(reservation)
{
  
  var parent=document.getElementById("new_bookning_form");
  console.log(parent);
  if (parent.checkValidity() === false) {
          //event.preventDefault();
          console.log("invalid");
          //event.stopPropagation();
          parent.classList.add("was-validated");
          return false;

        }
        else console.log("valid");
  parent.classList.add("was-validated");
  room=document.getElementById("roomnr").value;
  name=document.getElementById("n_guest").value;
  persons=document.getElementById("n_persons").value;
  from=document.getElementById("n_from").value;
  to=document.getElementById("n_to").value;
  tel=document.getElementById("n_tel").value;
  email=document.getElementById("n_email").value;
  remark=document.getElementById("n_memo").value,
  statuselement=document.getElementById("n_status");
  status=statuselement.options[statuselement.selectedIndex].value;
  user="test";
  console.log(reservation);
    $.ajax( { type : 'POST',
    //dataType:'json',
    data : {
      'nr':reservation.dataset.bookningnr,
    'room':room,
    'start':from,
    'end':to,
    'name':name,
    'persons':persons,
    'email':email,
    'tel':tel,
    'remark':remark,
    'user': "test",
    'status': status
    },
    url  : 'functions/save_bookning.php',
               
    success: function ( json ) {
      // $('#new_bookning').modal('hide');
      //var res=JSON.parse(json);
      // $('#center').html(json);
       //alert( json );               
    // console.log(res); 
    var status=JSON.parse(json); 
    if (status.status=="OK"){
      $('#new_bookning').modal('hide');
      render();
      send_mail(2,reservation.dataset.bookningnr,room,from,to,name,persons,email,tel,remark,status);
      return true; 
    }
    else{
      $('#new_bookning').modal('hide');
      alert("Hiba történt->"+status.message);
      console.log("-"+json+"-");
      render();
      return true;
    }
      
      //  return true;          
      // $("#center").fadeIn("slow", function () {
      //   $(this).html(json);
     
      // });

    },
      error: function ( xhr ) {
        alert( "error: "+xhr.status+" "+xhr.statusText );
         console.log("error: "+xhr); 
        return false;
      }
  });
}

function makemonth(caller) {
  // this function is called for render a specific month by the buttons in the calendar
  currentrendered=caller.value;
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'data': caller.value,
    'beds':beds,
    'admin':admin },
    url  : 'rendercalendar.php',
    target: '#center',             
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json ); 
     // console.log(caller+" "+caller.parentElement.parentElement.nodeName); 
       caller.parentElement.parentElement.parentElement.parentElement.innerHTML=json;  
      $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}});  
      // $("#center").fadeIn("slow", function () {
      //   $(this).html(json);
    
      // });

    },
    error: function ( xhr ) {
      alert( "error: "+xhr );
    }
  });
}
function makeyear(caller) {
  // this function is called for render a specific year by the buttons in the calendar
  currentrendered=caller.value;
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'data': caller.value,
    'yearly':1,
    'beds':beds,
    'admin':admin },
    url  : 'rendercalendar.php',
    target: '#center',              
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json );               
      caller.parentElement.parentElement.parentElement.parentElement.innerHTML=json;  
            
      // $("#center").fadeIn("slow", function () {
      //   $(this).html(json);
 
      // });
 $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}}); 
    },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  }); 
}


function gotomonth(ele) {
  // this function is called for render a specific month by clicking in a month in yearly calendar
  $('[data-toggle="tooltip"]').tooltip("hide");
  currentrendered=ele.dataset.value;
  yearly=0;
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'data': ele.dataset.value,
    'beds':beds,
    'admin':admin},
    url  : 'rendercalendar.php',
    target: '#center',              
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json );               
      $("#center").fadeIn("slow", function () {
        $(this).html(json);
   
      });
 $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}}); 
    },
      error: function ( xhr ) {
        alert( "error:"+xhr );
      }
  }); 
}
function month() {
  // this function is called for render the current month by the clicking side menu buttons
  currentrendered=document.getElementById("month").value;
  yearly=0;
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'data': document.getElementById("month").value,
      'beds':beds,
      'admin':admin },
    url  : 'rendercalendar.php',
    target: '#center',              
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json );               
      $("#center").fadeIn("slow", function () {
        $(this).html(json);
      
      });
 $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}}); 
    },
      error: function ( xhr ) {
        alert( "error:" +xhr );
      }
  }); 
}
function year() {
// this function is called for render the current year by the clicking side menu buttons
currentrendered=document.getElementById("year").value;
yearly=1;
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'data': document.getElementById("year").value,
    'yearly':1,
    'beds':beds,
    'admin':admin },
    url  : 'rendercalendar.php',
    target: '#center',              
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json );               
      $("#center").fadeIn("slow", function () {
        $(this).html(json);
      });
 $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}}); 
    },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  }); 
}
function twobeds(bt){
beds=2;
render();
document.getElementById("two").classList.remove("active");
document.getElementById("three").classList.remove("active");
document.getElementById("four").classList.remove("active");
document.getElementById("all").classList.remove("active");
bt.classList.add("active");
}
function threebeds(bt){
  beds=3;
  render();
  document.getElementById("two").classList.remove("active");
document.getElementById("three").classList.remove("active");
document.getElementById("four").classList.remove("active");
document.getElementById("all").classList.remove("active");
bt.classList.add("active");
}
function fourbeds(bt){
  beds=4;
  render();
  document.getElementById("two").classList.remove("active");
document.getElementById("three").classList.remove("active");
document.getElementById("four").classList.remove("active");
document.getElementById("all").classList.remove("active");
bt.classList.add("active");
}
function allrooms(bt){
  beds=0;
  render();
  document.getElementById("two").classList.remove("active");
document.getElementById("three").classList.remove("active");
document.getElementById("four").classList.remove("active");
document.getElementById("all").classList.remove("active");
bt.classList.add("active");
}
function render(){
  if (yearly==1){
  $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'data': currentrendered,
    'yearly':1,
    'beds':beds,
    'admin':admin },
    url  : 'rendercalendar.php',
    target: '#center',              
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json );               
//      caller.parentElement.parentElement.parentElement.parentElement.innerHTML=json;  
           
      $("#center").fadeIn("slow", function () {
        $(this).html(json);
        $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}}); 
      });

    },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  }); 
  }
  else{
    $.ajax( { type : 'POST',
    //dataType:'json',
    data : {'data': currentrendered,
    'beds':beds,
    'admin':admin },
    url  : 'rendercalendar.php',
    target: '#center',              
    success: function ( json ) {
      // $('#center').html(json);
      // alert( json );               
   //   caller.parentElement.parentElement.parentElement.parentElement.innerHTML=json;  
             
      $("#center").fadeIn("slow", function () {
        $(this).html(json);
        $('[data-toggle="tooltip"]').tooltip({delay:{'show':500,'hide':0}}); 
      });

    },
      error: function ( xhr ) {
        alert( "error: "+xhr );
      }
  });
  }
}
function changesurface(bt){
  if (admin==0){
    admin=1;
    document.getElementById("all").style.display="inline";
  }
  else {
    admin=0;
   // document.getElementById("all").style.display="none";
    //Todo if the current selected is the all, then switch to 2 beds view
  }
  render();
  if (admin==1){  // after rendering, we are in admin mode now, show set the text to guest
    bt.innerHTML="Vendég";
  }
  else {
    bt.innerHTML="Admin";
  }
}
  function setsurface(bt){
  if (bt==0){
    document.getElementById("Chg").innerHTML="Vendég";
    if (!<?php echo $developer;?>){
      document.getElementById("all").style.display="none";
      document.getElementById("Chg").style.display="none";
      document.getElementById("year").style.display="none";
    }
    else{
    document.getElementById("Chg").innerHTML="Admin";
    }
    beds=2;
    document.getElementById("two").classList.remove("active");
    document.getElementById("three").classList.remove("active");
    document.getElementById("four").classList.remove("active");
    document.getElementById("all").classList.remove("active");
    document.getElementById("two").classList.add("active");
  }
  else {
    document.getElementById("Chg").innerHTML="Vendég";
   // document.getElementById("all").style.display="none";
    //Todo if the current selected is the all, then switch to 2 beds view
  }
}
function next_mini(param){
    $.ajax( { type : 'POST',
          data : {'masterdate': param.dataset.master,
            'start': param.dataset.start,
            'stop': param.dataset.stop,
            'status' : param.dataset.status,
            'slot':param.dataset.slot
          },
          url  : 'render_calendar2.php',
         // target: '#center',              
          success: function ( json ) {           
            // $("#minicalright").fadeIn("slow", function () {
            // $(this).html(json);
            document.getElementById("minicalright").innerHTML=json;
                     
          },
          error: function ( xhr,status,error ) {
            console.log(xhr.responseText+" "+status+" "+error);
            alert( "error here: "+xhr.responseText );
          }
        });
    return true;
  }

  function prev_mini(param){
    $.ajax( { type : 'POST',
          data : {'masterdate': param.dataset.master,
            'start': param.dataset.start,
            'stop': param.dataset.stop,
            'status' : param.dataset.status,
            'slot':param.dataset.slot
          },
          url  : 'render_calendar2.php',
         // target: '#center',              
          success: function ( json ) {           
            // $("#minicalright").fadeIn("slow", function () {
            // $(this).html(json);
            document.getElementById("minicalright").innerHTML=json;
                     
          },
          error: function ( xhr,status,error ) {
            console.log(xhr.responseText+" "+status+" "+error);
            alert( "error here: "+xhr.responseText );
          }
        });
    return true;

  }
</script>
</body>
</html>
