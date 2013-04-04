<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Noam&apos;s Awesome Website</title>
</head>
<body>
<div id="main">
<h1>Welcome to My Beautiful Website!</h1>


<h2>Here&apos;s some info about my users:</h2>
<?php
$IP =  $_SERVER["REMOTE_ADDR"];

$temp = $_SERVER['HTTP_USER_AGENT'];

if (strpos($temp,'iPhone') !== false || strpos($temp, 'iPad') !== false || strpos($temp,'iPod') !== false)
   $OS = "iOS";
else if (strpos($temp,'Windows') !== false)
   $OS = "Windows";
else if (strpos($temp,'Macintosh') !== false)
   $OS = "Mac";
else if (strpos($temp,'Android') !== false)
   $OS = "Android";
else if (strpos($temp, 'Linux') !== false)
   $OS = "Linux";
else
   $OS = "Other";

if (strpos($temp,'Chrome') !== false)
   $Browser = "Chrome";
else if (strpos($temp,"Safari") !== false)
   $Browser = "Safari";
else if (strpos($temp,"Firefox") !== false)
   $Browser = "Firefox";
else if (strpos($temp,"IE") !== false)
   $Browser = "IE";
else
   $Browser = "Other";

$temp = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
switch ($temp){
   case "en":
   $lang = 'English';
   break;
   case "fr":
   $lang = 'French';
   break;
   case "es":
   $lang = 'Spanish';
   break;
   case "zh":
   $lang = 'Chinese';
   break;
   case "de":
   $lang = 'German';
   break;
   default:
   $lang = 'Other';
   break;
}

$command = "python /home1/n/noamz/html/cgi-bin/update_data $IP $OS $Browser $lang";
exec($command);

echo exec('python /home1/n/noamz/html/cgi-bin/display_data');

?>
</div>

</body>
</html>
