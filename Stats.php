
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>PiCam Stats</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.33" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
	
	<style>
	.btn {
	  border: none;
	  color: white;
	  padding: 10px 20px;
	  font-size: 16px;
	  cursor: pointer;
	}

	.success {background-color: #04AA6D;} /* Green */
	.success:hover {background-color: #46a049;}

	.info {background-color: #2196F3;} /* Blue */
	.info:hover {background: #0b7dda;}

	.warning {background-color: #ff9800;} /* Orange */
	.warning:hover {background: #e68a00;}

	.danger {background-color: #f44336;} /* Red */ 
	.danger:hover {background: #da190b;}

	.default {background-color: #e7e7e7; color: black;} /* Gray */ 
	.default:hover {background: #ddd;}
	</style>
</head>

<body>
<?php
		

echo "<H3>System Name: " . gethostname() . " at " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . "</H3>" ;

$output=null;
exec("iwconfig", $output);
print("<H4>Network</H4>");
foreach ($output as $ln) {
	print($ln . "<br>"); 
	}

$output=null;
exec("/opt/vc/bin/vcgencmd measure_temp", $output);
print("<H4>Internal Temperature</H4>");
foreach ($output as $ln) {
	print($ln . "<br>"); 
	}
?>


<?php

echo "<H4>Running Programs</H4>" ;
$output=null;
exec("pgrep -f 'python3 /var/www/CamInterface/Code/timelapse.py'", $output);
$TLRunning = count($output) > 1;
if ($TLRunning)
	print("Initial Condition: TL Running at " . date("h:i:sa") . " <br>");
else
	print("Initial Condition: TL Not Running at " . date("h:i:sa") . " <br>");

$output=null;
exec("pgrep -f 'raspimjpeg'", $output);
$RaspiRunning = count($output) > 1;
if ($RaspiRunning) {
	print("Initial Condition: Raspi Running at " . date("h:i:sa") . " <br>");
}
else
	print("Initial Condition: Raspi Not Running at " . date("h:i:sa") . " <br>");
echo "<H3>Git Repositories</H3>" 
?>

<div id="center_button">
    <button class='btn default' onclick="location.href='/CamInterface/Stats.php?action=statusCamInterface'">Git status CamInterface</button>
    <button class='btn danger' onclick="location.href='/CamInterface/Stats.php?action=pullCamInterface'">Git pull CamInterface</button>
    <button class='btn default' onclick="location.href='/CamInterface/Stats.php?action=statusHTML'">Git status HTML</button>
    <button class='btn danger' onclick="location.href='/CamInterface/Stats.php?action=pullHTML'">Git pull HTML</button>
    <button class='btn info' onclick="location.href='/CamInterface/Stats.php'">Refresh</button>
	<br><br>
</div>
<?php
$Action = $_GET["action"];
$output=null;
if($Action == "pullCamInterface") {
	exec("cd /var/www/CamInterface; sudo -u pi git pull", $output);
	print("<H4>Pull Result for /var/www/CamInterface</H4>");
	foreach ($output as $ln) {
		print($ln . "<br>"); 
	}
}
elseif ($Action == "pullHTML") {
	exec("cd /var/www/html; sudo -u pi git pull", $output);
	print("<H4>Pull Result for /var/www/html</H4>");
	foreach ($output as $ln) {
		print($ln . "<br>"); 
	}
}
elseif ($Action == "statusCamInterface") {
	exec("cd /var/www/CamInterface; git status;", $output);
	print("<H4>Status Result for /var/www/CamInterface</H4>");
	foreach ($output as $ln) {
		print($ln . "<br>"); 
	}
}
elseif ($Action == "statusHTML") {
	exec("cd /var/www/html; git status;", $output);
	print("<H4>Status Result for /var/www/html</H4>");
	foreach ($output as $ln) {
		print($ln . "<br>"); 
	}
}
?>
</body>

</html>
