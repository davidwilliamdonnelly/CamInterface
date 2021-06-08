
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>PiCam</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.33" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
</head>

<body>
<?php

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

echo "<H3>System Name: " . gethostname() . " at " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . "</H3>" ;
echo "<H3>Function: Stats</H3>" ;

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

</body>

</html>
