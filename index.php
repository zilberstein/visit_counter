<!DOCTYPE html>
<html>
<head>
  <style>
    body {
    background-color: #333;
    font-family: sans-serif;
    }

    #main {
    margin: 0px auto;
    padding: 25px;
    border-radius: 25px;
    width: 75%;
    background-color: #eee;
    box-shadow: 0px 0px 25px #000;
    }

    h1 {
    text-shadow: 1px 1px 1px #666;
    }

    .graph {
    position: relative;
    padding: 5px;
    margin: 5px;
    border-radius: 5px;
    box-shadow: 2px 2px #000;
    color: #fff;
    }
  </style>
</head>
<body>
<div id="main">
<h1>Welcome to My Beautiful Website!</h1>

<?php
echo "page view: ";
$IP =  $_SERVER["REMOTE_ADDR"];
echo $IP;
$temp = $_SERVER['HTTP_USER_AGENT'];
if (strpos($temp,'iPhone') !== false || strpos($temp, 'iPad') !== false || strpos($temp,'iPod') !== false)
   $OS = "iOS";
else if (strpos($temp,'Windows') !== false)
   $OS = "WINDOWS";
else if (strpos($temp,'Macintosh') !== false)
   $OS = "MAC";
else
   $OS = "OTHER";

$command = "python /home1/n/noamz/html/cgi-bin/update_data $IP $OS";
echo '<br>';
$a = '100px';
echo "<div class=\"graph\" style=\"background-color:#156086;width: $a;\">Mac</div>";
echo "<div class=\"graph\" style=\"background-color:#7d1586;width: 150px;\">Windows</div>";
echo "<div class=\"graph\" style=\"background-color:#861522;width: 75px;\">iOS</div>";
echo "<div class=\"graph\" style=\"background-color:#f87705;width: 60px;\">Android</div>";
echo "<div class=\"graph\" style=\"background-color:#37a721;width: 40px;\">Other</div>";

$temp = exec($command, $output);

?>
</div>

</body>
</html>
