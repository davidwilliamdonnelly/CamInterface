
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
os.system("pgrep -f 'python3 /var/www/CamInterface/Code/timelapse.py'");

?>  
<?php
// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
$output=null;
$retval=null;
exec("pgrep -f 'python3 /var/www/CamInterface/Code/timelapse.pyx'", $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);
echo count($output);
exec("sudo python3 /var/www/CamInterface/Code/timelapse.py > /dev/null &");
echo "back from exec<br><br>";

$output=null;
$retval=null;
os.system("python3 /var/www/CamInterface/Code/PicStream.py /var/www/CamInterface/PicStream/image.jpg > /dev/null &");
exec("pgrep -f 'python3 /var/www/CamInterface/Code/PicStream.py /var/www/CamInterface/PicStream/image.jpg'", $output, $retval);
echo "Returned with status $retval and output:\n";
print_r($output);
echo count($output);
if (count($output) == 1) {
	os.system("python3 /var/www/CamInterface/Code/PicStream.py /var/www/CamInterface/PicStream/image.jpg > /dev/null");
}
?>  
  
<p>Click the button to display a confirm box.</p>

<button onclick="ConfirmAction('Shutdown:  Are you sure?', '/CamInterface/test.php?action=confirmed')">Try it</button>



<script>
function ConfirmAction(msg, destination) {
  if (confirm(msg) == true) {
    window.location.href = destination;
  }
}
</script>

<button onclick="location.href='/CamInterface/test.php?action=stop'">Stop</button>
<button onclick="location.href='/CamInterface/test.php?action=go'">Go</button>
<button onclick="location.href='/CamInterface/test.php'">Home</button>
	


</body>

</html>
