<?php
$config = json_decode(file_get_contents("./config.json"));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Busbulb</title>
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
	.bing {
		margin-top: 30px;
		margin-bottom: 0px;
	}
	.statholder {
		margin-top: 30px;
	}
	</style>
    <div class="container">
	
		<h2>Busbulb</h2>
		
		<h4><i>"A lightbulb which predicts buses is completely game changing" - Gizmodo</i></h4>	
		
		<?php
		if (@$_GET['c'] == "s") {
		?>
		<div class="bing alert alert-success">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <h4>Oh man, yes!</h4>
		  You saved your settings! You did so well!
		</div>
		<?php 
		}
		?>
		
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
				display: inline-block;
			}
			.astatus {
				font-style: italic;
				display: inline-block;
			}
		</style>
		
		<div class="statholder">
		
			<div id="huehuehue"><div id="wink">Currently</div></div>
		
			<p class="header">Bus Stop:</p>
			
			<p class="astatus" id="stop">
				<?php echo @$config->stopid; ?>
			</p>
			
			<br/>
			
			<p class="header">Route Desired:</p>
			
			<p class="astatus" id="route">
				<?php echo @$config->route; ?>
			</p>
			
			<br/>
			
			<p class="header">Status:</p>
			
			<p class="astatus" id="status">
				Updating...
			</p>	
			
			<br/>
			
			<p class="header">Next Updating:</p>
			
			<p class="astatus" id="secs">
				Soon
			</p>
		
		</div>
		
		<script>
			function dobuses() {
			$('#status').html("Fetching...");
			$.ajax({
					type: 'GET',
					url: 'process.php',
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(data) { 
						console.log("Got result");
						if (data['Error']) {
							console.log("Error");
							$('#status').html(data['Error']);
						} else {
							console.log("Success");
							next = "Next bus due in " + data['Next'] + " mins";
							$("#huehuehue").css('background-color', data['Color']);
							$('#status').html(next);
						}
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
    
    <script>
    var a=document.getElementsByTagName("a");
    for(var i=0;i<a.length;i++)
    {
        a[i].onclick=function()
        {
            window.location=this.getAttribute("href");
            return false
        }
    }
    </script>
    
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>

  </body>
</html>


