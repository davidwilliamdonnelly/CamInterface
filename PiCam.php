
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
	os.system("/home/pi/RPi_Cam_Web_Interface/stop.sh > /dev/null");
}
else
	print("Initial Condition: Raspi Not Running at " . date("h:i:sa") . " <br>");		

echo "<H3>System Name: " . gethostname() . " at " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . "</H3>" ;
echo "<H3>Function: Timelapse</H3>" ;
?>

<script>
function ConfirmAction(msg, destination) {
  if (confirm(msg) == true) {
    window.location.href = destination;
  }
}
</script>

<div id="center_button">
    <button class='btn default' onclick="location.href='/CamInterface/PiCam.php'">Refresh</button>
    <button class='btn default' onclick="location.href='/CamInterface/PiCam.php?action=stop'">Stop Timelapse</button>
    <button class='btn default' onclick="location.href='/CamInterface/PiCam.php?action=run'">Start Timelapse</button>
    <button class='btn default' onclick="location.href='/CamInterface/PiCam.php?action=webcam'">Web Cam</button>
    <button class='btn default' onclick="location.href='/CamInterface/PiCam.php?action=picstream'">Pic Stream</button>
    <button class='btn danger' onclick="ConfirmAction('Shutdown:  Are you sure?', '/CamInterface/PiCam.php?action=shutdown')">Shutdown</button>
	<br><br>
</div>

<?php
$Action = $_GET["action"];
$ForcePiZero = false;

$PicsDir = "/var/www/CamInterface/Pictures";


if((strpos(gethostname(), "PiZero") !== false) || $ForcePiZero) {
	$PicsDir = "/home/pi/RecroomShare/PiZ1Pictures";
	echo "Pi Zero<br><br>";
}
else {
	$PicsDir = "/var/www/CamInterface/Pictures";
	echo "Pi 4<br><br>";
}

if($Action == "stop") {
	os.system("/usr/bin/sudo killall python3 > /dev/null");
	echo "Timelapse Stopped<br><br>";
}
elseif ($Action == "run") {
	// run only if not currently running
	if (!$TLRunning)
		os.system("sudo python3 /var/www/CamInterface/Code/timelapse.py > /dev/null &");
	sleep(3);
	echo "Timelapse Started<br><br>";
}
elseif ($Action == "webcam") {
	os.system("/usr/bin/sudo killall python3 > /dev/null");
	os.system("/home/pi/RPi_Cam_Web_Interface/start.sh > /dev/null");
	Print('<meta http-equiv="refresh" content="0;url=/html/index.php">');
}
elseif ($Action == "picstream") {
	os.system("/usr/bin/sudo killall python3 > /dev/null");
	Print('<meta http-equiv="refresh" content="0;url=/CamInterface/PicStream.php">');
}
elseif ($Action == "shutdown") {
	Print('<meta http-equiv="refresh" content="0;url=/CamInterface/PiCam.php">');
	os.system("/usr/bin/sudo shutdown -P now > /dev/null &");
}
 
$FilesArray = scandir("/var/www/CamInterface/Videos");
$PicsArray = scandir($PicsDir, 1);
os.system("cp -f " . $PicsDir .  "/" . $PicsArray[0] . " /var/www/CamInterface/Pictures/" . $PicsArray[0]);

#Print ("cp -f " . $PicsDir .  "/" . $PicsArray[0] . " /var/www/CamInterface/Pictures/" . $PicsArray[0]);
Print("Last Pic File: " . $PicsArray[0] . " created on " . date ("F d Y H:i:s.", filemtime($PicsDir .  "/" . $PicsArray[0])) . "<br><br>");
print('<img src="/CamInterface/Pictures/' . $PicsArray[0] . '" width="800">');
echo "<br><br>";

echo "Available Video Files:<br><br>";

foreach ($FilesArray as $fn) {
	if($fn[0] != '.') {
	print('<a href="../CamInterface/ShowVid.php?file=' . $fn . '">' . $fn . '</a><br>'); 
	}
}
print("<br>");

?>


</body>

</html>
