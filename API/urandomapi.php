<?php
//According to manual for rand_bytes and random_int the getrandom(2) syscall is used and this makes use of /dev/urandom
/* ************************************************ */
/*                                                  */
/* Distributed Urandom Increment Global CoOperative */
/*                                                  */
/* This file is part of the "DUIGCO API" package    */
/* Produced for: DUIGCO API                         */
/*                                                  */
/* Source Code produced by Willtech 2021            */
/* v0.1 hand coded by HRjJ                          */
/*                                                  */
/* ************************************************ */
//Protect the API transfer any non validating requests to DUIGCO.org website
if ($_SERVER['REQUEST_URI'] != "/urandomapi.php?api" && $_SERVER['REQUEST_URI'] != "/urandomapi.php?delay") {
  header("Location: https://duigco.org/",TRUE,403);
  die(header('refresh:12;url=https://duigco.org/'));
}

//Set headers for no-cache
header('Expires: Sat, 04 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('X-Powered-By: Willtech');

//function for API call. Return is data there are no descriptors.
function api ($bytes=512) {
  return base64_encode(random_bytes($bytes));
}

//function for delay. Return is integer.
function delay ($ticker=3.14) {
  return random_int(0, $ticker);
}

//Call api function and export to webhost as string.
if(isset($_GET['api'])) {
  echo api();
  exit;
}

//Call delay function and export to webhost as string.
if(isset($_GET['delay'])) {
  echo delay();
  exit;
}

exit();

?>
