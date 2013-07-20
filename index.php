<?php
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
	          <li class="active"><a href="index.php">Home</a></li>
	          <li><a href="configure.php">Configure</a></li>
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
	
		<h2>Busbulb: the bus predicting lightbulb you've always wanted</h2>	
		
		<div id="huehuehue"><div id="wink">Currently</div></div>
		
		<style>
			#huehuehue {
				position: absolute;
				width: 100px;
				height: 100px;
				right: 10%;
				background-color: transparent;
				border-radius: 50px;
				border: 3px solid silver;
			}
			#wink {
				position: relative;
				left: 21px;
				top: 37px;
			}
			.header {
				font-weight: bold;
				font-size: 1.1em;
			}
			.astatus {
				font-style: italic;
			}
		</style>
		
		<p class="header">Bus Stop:</p>
		
		<p class="astatus" id="stop">
			<?php echo @$config->stopid; ?>
		</p>
		
		<p class="header">Route Desired:</p>
		
		<p class="astatus" id="route">
			<?php echo @$config->route; ?>
		</p>
		
		<p class="header">Status:</p>
		
		<p class="astatus" id="status">
			Updating...
		</p>	
		
		<p class="header">Next Updating:</p>
		
		<p class="astatus" id="secs">
			Soon
		</p>
		
		<script>
			function dobuses() {
			$('#status').html("Fetching...");
			$.ajax({
					type: 'GET',
					url: 'process.php',
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(data) { 
						next = "Next bus due in " + data['Next'] + " mins";
						$("#huehuehue").css('background-color', data['Color']);
						$('#status').html(next);
					}
				});
			}
			dobuses();
			n = 31;
			function dosecs() {
				n--;
				if (n == 0) {
					dobuses();
					n = 30;
				}
				$('#secs').html(n + " seconds");
			}
			setInterval("dosecs()", 1000);
			dosecs();
		</script>
		
    </div>
    
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>

  </body>
</html>


