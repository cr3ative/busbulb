<?php
$config = json_decode(file_get_contents("./config.json"));

if (isset($_POST['stopid'])) {
	$str = json_encode($_POST);
	$file = 'config.json';
	$status = file_put_contents($file, $str);
}

$config = json_decode(file_get_contents("./config.json"));

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Busbulb</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
	<div class="navbar navbar-upper">
	  <div class="navbar-inner">
	    <ul class="nav">
	          <li><a href="index.php">Home</a></li>
	          <li class="active"><a href="configure.php">Configure</a></li>
	        </ul>
	  </div>
	</div>

    <div class="container">
	
		<h2>Configure Busbulb</h2>	
		
		<h4>You'll find your Stop ID and Route on TFL Countdown: <a href="http://countdown.tfl.gov.uk/">Go there!</a></h4>
		
		<form class="form" method="POST" action="configure.php">
		
			<h3>Bus Stop ID</h3>
			
			  <input type="text" name="stopid" class="input-medium" value="<?php echo @$config->stopid; ?>">
			
			<h3>Route Name or Number</h3>
			
			  <input type="text" name="route" class="input-medium" value="<?php echo @$config->route; ?>">
			
			<br/><br/>
			
			 <button type="submit" class="btn">Save Configuration</button>
			
		</form>
		
    </div>
    
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>

  </body>
</html>


