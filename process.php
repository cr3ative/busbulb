<?php 
require("hue.php");

// Get bus status. Show world via Hue.
// eheuehueheuheuheeuheuheeuheh

// Red is a long way away. Over 10 minutes
// Yellow is fairly close. About 5 mins
// Blue is 2 mins or less.
// Flashing white is due

// First let's get the list of 154's due outside my house.

$json = json_decode(file_get_contents("http://countdown.tfl.gov.uk/stopBoard/53366/"));
foreach ($json->arrivals as $arrival) {

	if ($arrival->routeId == "154") {
		// The first is always the latest due, so just read it straight off!
		$howlong = $arrival->estimatedWait;
		if ($howlong == "due") { $howlong = "0min";	}
		$unix = strtotime($howlong);
		// Work out minutes
		$dim = (($unix - time())/60);
		if ($dim < 0) {
			$dim = 0;
		}
		echo "Next bus is due in $dim mins\n"; 
		if ($dim == 0) {
			// Flashing White
			$color = array();
			$color['alert'] =  "lselect";
			$color['on'] = true;
			$color['hue'] =  30000;
			$color['sat'] = 254;
			$color['bri'] = 255;
			$color['transitiontime'] = 1;
			setLight(1, $color);
			break;
		}
		if ($dim < 4) {
			// Blue
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

?>