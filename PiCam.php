
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
echo "<H2>System Name: " . gethostname() . " at " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . "</H2>" ;
?>

<div id="center_button">
    <button onclick="location.href='/CamInterface/PiCam.php'">Refresh</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=stop'">Stop Timelapse</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=run'">Start Timelapse</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=webcam'">Web Cam</button>
	<br><br>
</div>

<?php
$Action = $_GET["action"];

if($Action == "stop") {
	os.system("/usr/bin/sudo killall python3 > /dev/null &");
	echo "Timelapse Stopped<br><br>";
}
elseif ($Action == "run") {
	os.system("/home/pi/RPi_Cam_Web_Interface/stop.sh > /dev/null &");
	sleep(1);
	os.system("python3 /var/www/CamInterface/Code/timelapse.py > /dev/null &");
	sleep(3);
	echo "Timelapse Started<br><br>";
}
elseif ($Action == "webcam") {
	os.system("/usr/bin/sudo killall python3 > /dev/null &");
	sleep(1);
	os.system("/home/pi/RPi_Cam_Web_Interface/start.sh > /dev/null &");
	Print('<meta http-equiv="refresh" content="0;url=/html/index.php">');
}
 
$FilesArray = scandir("/var/www/CamInterface/Videos");
$PicsArray = scandir("/var/www/CamInterface/Pictures", 1);

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
