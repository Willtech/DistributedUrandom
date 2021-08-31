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
//With program scrip from the [public domain](https://www.php.net/manual/en/filter.filters.sanitize.php)
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

//funtion to trim arrays
function trim_value(&$value) {
  $value = trim($value);
}

//function to sanatize strings
//Found this larger function in the [Chyrp](https://github.com/vito/chyrp/blob/35c646dda657300b345a233ab10eaca7ccd4ec10/includes/helpers.php#L515) code:
function sanitize($string, $force_lowercase = true, $preg = false, $trunc = 100) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                       "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                       "—", "–", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($preg ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean);
        $clean = ($trunc ? substr($clean, 0, $trunc) : $clean);
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

//function to sanitize filenames replacing whitespace with dashes
//this one in the [wordpress](https://wordpress.org/) code from [this reference](https://stackoverflow.com/a/2668953):
//modified
//function sanitize_file_name( $filename ) {
//    $filename_raw = $filename;
//    $special_chars = array("?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}");
//    $special_chars = apply_filters('sanitize_file_name_chars', $special_chars, $filename_raw);
//    $filename = str_replace($special_chars, '', $filename);
//    $filename = preg_replace(('/\s+/', '-', $filename); //do not merge spaces
//    $filename = trim($filename, '.-_');
//    return apply_filters('sanitize_file_name', $filename, $filename_raw);
//}

//Insert call for mailbox
function process_mailbox($mailbox,$messageID) {

  $mailbox = sanitize(strip_tags(html_entity_decode($mailbox,ENT_QUOTES)),True,False);
  $messageID = sanitize(strip_tags(html_entity_decode($messageID,ENT_QUOTES)),True,False);
  //echo ($mailbox . " " . $messageID . " ");

  if ($mailbox == 12345) { //Hulk mailbox for training. Default on form easily found.

    switch ($messageID) {
      case "1":
        header('Message: 1 Retreiving a message is one thing you need a schoolbus to help you decode and a :password');
        break;
      case "2":
        header('Message: 2 Congratulations you are off to Marvel Academy under Captain America 123456');
        break;
      case "3":
        header('Message: 3 Captain America is always about his business');
        break;
      case "4":
        header('Message: 4 If you need a hero tame Hulk.');
        break;
      default:
        header('Message: Message ID no. is not equal to 1, 2 or 3');
        break;
    }

  }

}

//pre-processing before operating mailbox
array_filter($_POST, 'trim_value');
$postfilter =
    array(
            'mailbox'                        =>    array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH),
            'messageID'                            =>    array('filter' => FILTER_SANITIZE_NUMBER_INT),
    );
$revised_post_array = filter_var_array($_POST, $postfilter);

//Call mailbox processing
if (isset($revised_post_array['mailbox'])) {
	process_mailbox($revised_post_array['mailbox'],$revised_post_array['messageID']);
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

