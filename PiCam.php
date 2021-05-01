
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.33" />
</head>

<body>
<?php
echo "<H3>System Name: " . gethostname() . " at " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . "</H3>" ;
echo "<H3>Function: Timelapse</H3>" ;
?>

<div id="center_button">
    <button onclick="location.href='/CamInterface/PiCam.php'">Refresh</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=stop'">Stop Timelapse</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=run'">Start Timelapse</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=webcam'">Web Cam</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=picstream'">Pic Stream</button>	<br><br>
	<br><br>
</div>

<?php
$Action = $_GET["action"];
$ForcePiZero = true;

$PicsDir = "/var/www/CamInterface/Pictures";
if(gethostname() == "PiZero1" || $ForcePiZero) {
	$PicsDir = "/home/pi/RecroomShare/PiZ1Pictures";
}
else {
	$PicsDir = "/var/www/CamInterface/Pictures";
}

if($Action == "stop") {
	os.system("/usr/bin/sudo killall python3 > /dev/null &");
	echo "Timelapse Stopped<br><br>";
}
elseif ($Action == "run") {
	os.system("/home/pi/RPi_Cam_Web_Interface/stop.sh > /dev/null &");
	sleep(1);
	if(gethostname() == "PiZero1" || $ForcePiZero) {
		os.system("sudo python3 /var/www/CamInterface/Code/PZtimelapse1.py > /dev/null &");
		echo "Pi Zero<br><br>";
	}
	else {
		os.system("python3 /var/www/CamInterface/Code/timelapse.py > /dev/null &");
		echo "Pi 4<br><br>";
	}
	sleep(3);
	echo "Timelapse Started<br><br>";
}
elseif ($Action == "webcam") {
	os.system("/usr/bin/sudo killall python3 > /dev/null &");
	sleep(1);
	os.system("/home/pi/RPi_Cam_Web_Interface/start.sh > /dev/null &");
	Print('<meta http-equiv="refresh" content="0;url=/html/index.php">');
}
elseif ($Action == "picstream") {
	os.system("/usr/bin/sudo killall python3 > /dev/null &");
	os.system("/home/pi/RPi_Cam_Web_Interface/stop.sh > /dev/null &");
	sleep(1);
	Print('<meta http-equiv="refresh" content="0;url=/CamInterface/PicStream.php">');
}
 
$FilesArray = scandir("/var/www/CamInterface/Videos");
$PicsArray = scandir($PicsDir, 1);
os.system("cp -f " . $PicsDir .  "/" . $PicsArray[0] . " /var/www/CamInterface/Pictures/" . $PicsArray[0]);

#Print ("cp -f " . $PicsDir .  "/" . $PicsArray[0] . " /var/www/CamInterface/Pictures/" . $PicsArray[0]);
Print("Last Pic File: " . $PicsArray[0] . "<br><br>");
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
