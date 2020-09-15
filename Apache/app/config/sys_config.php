<?php
if ($_SERVER['HTTP_HOST']!='admin.com' and $_SERVER['HTTP_HOST']!='www.admin.com' )
{
    // local development server development server

    
    $developer=0;
 
}
else
{

    // production server -> Define the credentials for the production server

    $developer=0;
}

// version
$mversion=2;
$sversion='0';

// email settings
$confirmation_sender="admin@admin.com";  // visszaigazolás küldö cime, amit az ügyfél megkap
                                                 // OBS! Az oldal domainjén belül kell lennie nagytestvér miatt!
$admin_to_notify="admin@admin.com";      // Az admin cime, ahova a visszaigazolás másolata megy a confirmation_sendertöl

?>