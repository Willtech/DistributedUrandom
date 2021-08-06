<?php
//According to manual for rand_bytes and random_int the getrandom(2) syscall is used and this makes use of /dev/urandom

//Set headers for no-cache
header('Expires: Sat, 04 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

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
  echo api(512);
  exit;
}

//Call delay function and export to webhost as string.
if(isset($_GET['delay'])) {
  echo delay(3.14);
  exit;
}

exit();

?>
