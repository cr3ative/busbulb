<?php 
require("hue.php");

// Get bus status. Show world via Hue.
// eheuehueheuheuheeuheuheeuheh

// Red is a long way away. Over 10 minutes
// Yellow is fairly close. About 5 mins
// Blue is 2 mins or less.
// Flashing white is due

// First let's get the list of 154's due outside my house.
$config = json_decode(file_get_contents("./config.json"));

$json = json_decode(file_get_contents("http://countdown.tfl.gov.uk/stopBoard/".@$config->stopid."/"));

foreach ($json->arrivals as $arrival) {

	if ($arrival->routeId == @$config->route) {
		// The first is always the latest due, so just read it straight off!
		$howlong = $arrival->estimatedWait;
		if ($howlong == "due") { $howlong = "0min";	}
		$unix = strtotime($howlong);
		// Work out minutes
		$dim = (($unix - time())/60);
		if ($dim < 0) {
			$dim = 0;
		}
		if ($dim == 0) {
			// Flashing White
			$col = "#ebe8e8";
			$color = array();
			$color['alert'] =  "lselect";
			$color['on'] = true;
			$color['hue'] =  30000;
			$color['sat'] = 254;
			$color['bri'] = 20;
			$color['transitiontime'] = 1;
			setLight(1, $color);
			break;
		}
		if ($dim < 5) {
			// Blue
			$col = "#6a6af2";
			$color = array();
			$color['hue'] =  46920;
			$color['on'] = true;
			$color['sat'] = 254;
			$color['bri'] = 255;
			$color['transitiontime'] = 1;
			setLight(1, $color);
			break;
		}
		if ($dim < 9) {
			// Yellow
			$col = "#f5d332";
			$color = array();
			$color['hue'] =  19000;
			$color['on'] = true;
			$color['sat'] = 254;
			$color['bri'] = 100;
			$color['transitiontime'] = 1;
			setLight(1, $color);
			break;
		}
		// Further than 8 mins away.
		// Red
		$col = "#e45c5c";
		$color = array();
		$color['on'] =  true;
		$color['hue'] =  0;
		$color['sat'] = 254;
		$color['bri'] = 100;
		$color['transitiontime'] = 1;
		setLight(1, $color);
		break;
	}
	
}

if (!isset($dim)) {
	echo json_encode(array("Error"=>"No services found"));
	$color['on'] =  false;
	setLight(1, $color);
	die(); 
}

echo json_encode(array("Next"=>$dim,"Color"=>$col)); 
?>