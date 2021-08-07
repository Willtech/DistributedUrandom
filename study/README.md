Study whether the following function produces or improves random.

<?php
$str   = @file_get_contents('/proc/uptime');
$tme   =  microtime(true);
echo ($str . "<br>");
echo ($tme . "<br>");
echo ($str . $tme . "<br>");
echo ("A Random Number: <br>");
echo (md5($str . $tme));
?>

