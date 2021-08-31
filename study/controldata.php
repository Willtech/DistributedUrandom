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


//control generate 10,000 cells of random data
for ($h = 1; $h <= 100; $h++) {

  for ($i = 1; $i <= 100; $i++) {

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
