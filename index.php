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

    <div class="container">
	
		<h2>Busbulb: the bus predicting lightbulb you've always wanted</h2>	
		
		<p>Bus Stop:</p>
		
		<p id="stop">
			[Hardcoded -- Bango]
		</p>
		
		<p>Route Indicated:</p>
		
		<p id="route">
			[Hardcoded: 154]
		</p>
		
		<p>Bus Stop ID:</p>
		
		<p id="stopid">
			[Hardcoded -- Bingo]
		</p>
		
		<p>Status:</p>
		
		<p id="status">
			Updating...
		</p>	
		
		<p>Next Updating:</p>
		
		<p id="secs">
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
						$('#status').html(next);
					}
				});
			}
			setInterval("dobuses()", 30000);
			dobuses();
			
			n = 31;
			function dosecs() {
				n--;
				if (n == 0) {
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


