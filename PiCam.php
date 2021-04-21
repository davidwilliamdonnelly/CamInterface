
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
