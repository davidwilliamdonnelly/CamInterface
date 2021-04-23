
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
    <button onclick="location.href='/CamInterface/PiCam.php?action=stop'">Stop</button>
    <button onclick="location.href='/CamInterface/PiCam.php?action=run'">Run</button>

</div>

<?php
$Action = $_GET["action"];
echo $Action . "<br>";

if($Action == "stop") {
	print("action is stop <br>");
	#exec("/usr/bin/sudo killall python3", $output, $return_var);
	os.system("/usr/bin/sudo killall python3 > /dev/null &");
}
elseif ($Action == "run") {
	print("action is run <br>");
	#exec("/usr/bin/python3 /var/www/CamInterface/Code/timelapse.py &", $output, $return_var);
	os.system("python3 /var/www/CamInterface/Code/timelapse.py > /dev/null &");
}
 

print_r($output);
print("<br>");
print("<br>");

 $result_array=explode(' ',$output);
        echo "Output: ".$result_array."<br>";
        echo "Exit status: ".$return_var."<br>";


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
