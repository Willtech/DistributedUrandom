<?php
/* ************************************************ */
/*                                                  */
/* Distributed Urandom Increment Global CoOperative */
/*                                                  */
/* This file is part of the "DUIGCO Study" package  */
/* Produced for: DUIGCO API                         */
/*                                                  */
/* Source Code produced by Willtech 2021            */
/* v0.1 hand coded by HRjJ                          */
/*                                                  */
/* ************************************************ */
//According to manual for rand_bytes and random_int the getrandom(2) syscall is used and this makes use of /dev/urandom

//Set headers for no-cache
header('Expires: Sat, 04 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('X-Powered-By: Willtech');

//Configure Paraameters
//$api_url = "http://127.0.0.1/urandomapi.php?api"; //If you get a 502 Bad Gateway response it is internal routing. Easier to use eth0 interface address as external source.
$api_url = "https://api.duigco.org/urandomapi.php?api";

//$debug = True;
$debug = False;

//Define function
function get_entropy ($api_url = "http://127.0.0.1/urandomapi.php?api") {

    $R  = file_get_contents($api_url);

    if (strlen ($R) != 684) {
      header("HTTP/1.1 418 Gathering Entropy Failed");
      exit();
    }

    if ($debug) {

      echo ("API Response: " . $R . "<br>\r\n");

    }

    //convert base 10
    $N = "";
    $E = base64_decode($R);
    for($j=0; $j<strlen($E); $j++) {
      $N .= ord($E{$j});
    }

    //Choose Random
    $Q = random_int(0, (strlen($N))-3);
    $number =  substr ($N, $Q, 3);
    $rand = random_int (0, $number);

    return ($rand);
}

//control generate 10,000 cells of random data with entropy
for ($h = 1; $h <= 100; $h++) {

  for ($i = 1; $i <= 100; $i++) {

    $rand = get_entropy ($api_url);

    if ($debug) {

      echo ("Result Rand Entropy Number: " . $rand . "<br>\r\n");

    }

    echo (random_int(1,100));

    if ($i < 100) {

      echo (",");

    }

  }

  if ($h < 100) {

    echo ("\r\n");

  }

}

exit();

?>
