<?php
/* ************************************************ */
/*                                                  */
/* Distributed Urandom Increment Global CoOperative */
/*                                                  */
/* This file is part of the "DUIGCO Remote" packag  */
/* Produced for: DUIGCO API                         */
/*                                                  */
/* Source Code produced by Willtech 2021            */
/* v0.1 hand coded by HRjJ                          */
/*                                                  */
/* ************************************************ */

//Set headers for no-cache
header('Expires: Sat, 04 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('X-Powered-By: Willtech');

//Configure Paraameters
$api_url = "https://api.duigco.org/urandomapi.php?api";

//$debug = True;
$debug = False;

//Define Functions
//function found on user responses [PHP base_convert](https://php.willtech.net.au/manual/en/function.base-convert.php#43261) code:
function from_base256($string, $to_base = 10) {
    $number = "";
    for($i=0; $i<strlen($string); $i++) {
        $number .= str_pad(base_convert(ord($string{$i}), 10, 2), 8, "0", STR_PAD_LEFT);
    }
    return base_convert($number, 2, $to_base);
}


//Main Program
$R  = file_get_contents($api_url);
if (strlen ($R) != 684) {
 header("HTTP/1.1 418 Gathering Entropy Failed");
 exit();
}

if ($debug) {
 echo ("API Response: " . $R . "\r\n");
}


//convert base 10
$N = "";
$E = base64_decode($R);
for($i=0; $i<strlen($E); $i++) {
 $N .= ord($E{$i});
}

if ($debug) {
 echo ("Base 10: " . $N . "\r\n");
}

//Choose Random
$Q = random_int(0, (strlen($N))-3);

if ($debug) {
 echo ("Position: " . $Q . "\r\n");
}

$number =  substr ($N, $Q, 3);

if ($debug) {
 echo ("Random Number: " . $number . "\r\n");
}

$rand = random_int (0, $number);

if ($debug) {
 echo ("Result Rand Entropy Number: " . $rand . "\r\n");
}

echo ("Entropy Created. \r\n");
?>
