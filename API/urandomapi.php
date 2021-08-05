<?php
//According to manual for rand_bytes and random_int the getrandom(2) syscall is used and this makes use of /dev/urandom

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
