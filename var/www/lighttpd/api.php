<?php
/*Note: You'll need the ID of the monitor. For that, simply go to "https://api.uptimerobot.com/getMonitors?apiKey=yourApiKey" and get the ID of the monitor to be queried.*/
/*And, this code requires PHP 5+ or PHP 4 with SimpleXML enabled.*/

/*Variables - Start*/
$apiKey     = "m778358236-46fbab6500203d2da96824e6"; /*replace with your apiKey*/
$monitorID  = 778358236; /*replace with your monitorID*/
$url    = "https://api.uptimerobot.com/getMonitors?apiKey=" . $apiKey . "&monitors=" . $monitorID . "&format=xml";
/*Variables - End*/

/*Curl Request - Start*/
$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$responseXML = curl_exec($c);
curl_close($c);
/*Curl Request - End*/

/*XML Parsing - Start*/
$xml = simplexml_load_string($responseXML);

foreach($xml->monitor as $monitor) {
        echo $monitor['alltimeuptimeratio'];
}
/*XML Parsing - End*/
?>
