Study whether the following function produces or improves random.

```php
<?php
$str   = @file_get_contents('/proc/uptime');
$tme   =  microtime(true);
echo ($str . "<br>");
echo ($tme . "<br>");
echo ($str . $tme . "<br>");
echo ("A Random Number: <br>");
echo (md5($str . $tme));
?>
```

The working code is available to inspect and test [here](https://www.go-overt.com/distro/index.php?section=Study&source=random.php) just first visit site [root](https://www.go-overt.com/) to bypass hotlinking protection.
