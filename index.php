<?php
$error='';

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	// Freq select is sent from form 
	$Freq=$_POST['Freq'];


if (88 <= $Freq ) {
	if ($Freq <= 108) {
	$error='';
	}}
	else {
		$error = "Your freq is Wrong" ;
	}
	}
?>



<html>
	
	<head>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="Expires" content="0"/>
	<title>Raspi Freq page</title>
	<!-- <link rel="stylesheet" type="text/css" href="./css/ryhma9.css">
	-->	
	<style>
	body
	{
	background: url(<?php include 'bggen.php'; displayBackground();?>) no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	}
	</style>
	</head>
	
	<body bgcolor = "#FFFFFF">
	
	<div align = "center">
		<div style = "background-color:#ffffff;width:300px; border: solid 1px #333333; " align = "left">
			<div style = "background-color:#330033; color:#FFFFFF; padding:3px;"><b>Send Music Freq</b></div>
			<div style = "background-color:#ffffff;margin:30px">
			<form action = "" method = "post">
				<label>Freq  :</label><input type = "text" name = "Freq" class = "box"/><br /><br />
				<input type = "submit" value = " Submit "/><br />
			</form>
			Or Blick just Led <a href="cgi-bin/blink_25.sh" target="_blank">Blink led 25</a><br>
			Or <a href="./upload.php">upload</a> wav or mp3 or jpg file to system <br>
			Or Just Enjoy the view of <a href="./rrd/">statistics</a>
			<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
			</div>
				
		</div>
	</div>

	</body>
</html>
