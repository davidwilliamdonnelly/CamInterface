
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>PicStreamFR</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.33" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
</head>

<body>
<?php
echo "<H3>System Name: " . gethostname() . " at " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . "</H3>" ;
echo "<H3>Function: PicStream</H3>" ;
?>

<div id="center_button">
    <button onclick="location.href='/CamInterface/PiCam.php?action=webcam'">Web Cam</button>
    <button onclick="location.href='/CamInterface/PiCam.php'">Timelapse</button>
    <button onclick="location.href='/CamInterface/PicStream.php?action=picstream'">Reset</button>
    <button onclick="location.href='/CamInterface/PicStream.php?action=pause'">Pause</button>
    <button onclick="location.href='/CamInterface/PicStream.php?action=run'">Run</button>
    <button onclick="location.href='/CamInterface/PicStreamFR.php'">Full Resolution</button>
	<br><br>
</div>

<?php
$Action = $_GET["action"];

if ($Action == "run") {
	os.system("/usr/bin/sudo killall python3 > /dev/null &");
	os.system("/home/pi/RPi_Cam_Web_Interface/stop.sh > /dev/null &");
	sleep(1);
	Print('<meta http-equiv="refresh" content="0;url=/CamInterface/PicStream.php">');
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

$t=time();
echo(date("Y-m-d  h:i:s a",$t) . "<br><br>");

echo "<br><br> at full resolution <br><br>";
print('<img src="/CamInterface/PicStream/image.jpg' . $PicsArray[0] . '" ">');
echo "<br><br>";


?>


</body>

</html>
