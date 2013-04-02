<!DOCTYPE html>
<html>
<body>

<h1>hello world</h1>

<?php
echo "page view: ";
$IP =  $_SERVER["REMOTE_ADDR"];
echo $IP;
$command = "python /home1/n/noamz/html/cgi-bin/update_data $IP";
echo '<br>';
echo $command;
$a = '100px';
echo "<div style=\"background-color:#00f;position:fixed;top:125px;width: $a\">Mac</div>";
echo "<div style=\"background-color:#0f0;position:fixed;top:150px;width: 150px\">Windows</div>";
echo $_SERVER['HTTP_USER_AGENT'];
$temp = exec($command, $output);

?>

</body>
</html>
