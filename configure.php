<?php
$config = json_decode(file_get_contents("./config.json"));

if (isset($_POST['stopid'])) {
	$str = json_encode($_POST);
	$file = 'config.json';
	$status = file_put_contents($file, $str);
	header("Location:index.php?c=s");
}

$config = json_decode(file_get_contents("./config.json"));

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BusBulb Configure</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
  	<br/>
	<div class="navbar">
	  <div class="navbar-inner">
	    <ul class="nav">
	          <li><a href="index.php">Home</a></li>
	          <li class="active"><a href="configure.php">Configure</a></li>
	        </ul>
	  </div>
	</div>
	
	<style>
	body {
		background: -moz-linear-gradient(top, rgba(175,175,175,0.65) 0%, rgba(255,255,255,0) 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(175,175,175,0.65)), color-stop(100%,rgba(255,255,255,0)));
		background: -webkit-linear-gradient(top, rgba(175,175,175,0.65) 0%,rgba(255,255,255,0) 100%);
		background: -o-linear-gradient(top, rgba(175,175,175,0.65) 0%,rgba(255,255,255,0) 100%);
		background: -ms-linear-gradient(top, rgba(175,175,175,0.65) 0%,rgba(255,255,255,0) 100%);
		background: linear-gradient(to bottom, rgba(175,175,175,0.65) 0%,rgba(255,255,255,0) 100%);
		background-repeat: no-repeat;
	}
	</style>

    <div class="container">
	
		<h2>Configure Busbulb</h2>	
		
		<h4>You'll find your Stop ID and Route on TFL Countdown: <a href="http://countdown.tfl.gov.uk/">Let's do it!</a></h4>
		
		<form class="form" method="POST" action="configure.php">
		
			<h3>Bus Stop ID</h3>
			
			  <input type="text" name="stopid" class="input-medium" value="<?php echo @$config->stopid; ?>">
			
			<h3>Route Name or Number</h3>
			
			  <input type="text" name="route" class="input-medium" value="<?php echo @$config->route; ?>">
			
			<br/><br/>
			
			 <button type="submit" class="btn">Save Configuration</button>
			
		</form>
		
    </div>
    
    <script>
    var a=document.getElementsByTagName("a");
    for(var i=0;i<a.length;i++)
    {
        a[i].onclick=function()
        {
        	if (this.getAttribute("href") != "http://countdown.tfl.gov.uk/") {
	            window.location=this.getAttribute("href");
	            return false
        	}
        }
    }
    </script>
    
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>

  </body>
</html>


