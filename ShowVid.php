



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>CamVid</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.33" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
</head>

<body>

<?php

echo "<H2>System Name: " . gethostname() . " at " . $_SERVER['SERVER_ADDR'] . ":" . $_SERVER['SERVER_PORT'] . "</H2>" ;

$VidFile = '/CamInterface/Videos/' . $_GET["file"];
echo $_GET["file"] . "<br><br>";

print('   <video width="1024"  controls>');
print('      <source src="' . $VidFile . '" type=video/mp4>');
print('    </video>');

echo "<br><br>" . $_GET["file"] . " from Pics in ";
$dirName = strtok($_GET["file"] , ".");
print('<a href="../CamInterface/Pictures/Ar_' . $dirName . '">Ar_' . $dirName . '</a><br>'); 

?>	

</body>

</html>
