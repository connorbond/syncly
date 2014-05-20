<?php session_start(); require("includes/connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Syncly | Your Tabs, Shared.">
		<meta name="author" content="Connor Bond">
		<title>Syncly | Your Tabs, Shared.</title>
		<link rel="icon" type="image/png" href="img/favicon.ico" />
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Custom styles-->
		<link href="css/style.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php
			function randID() {
				// Copyright: http://snippets.dzone.com/posts/show/3123
				$len = 6;
				$base='ABCDEFGHKLMNOPQRSTWXYZ'; //ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz
				$max=strlen($base)-1;
				$activatecode='';
				mt_srand((double)microtime()*1000000);
				while (strlen($activatecode)<$len+1)
				$activatecode.=$base{mt_rand(0,$max)};
				return $activatecode;
			}
			

			//Set ID to session, to save recreating one on each page load.
			if (isset($_SESSION['userguid'])) {
				$guid = $_SESSION['userguid'];
				//echo "&nbsp;&nbsp;&nbsp;Loaded GUID.";
			} else {
				$guid = randID();
				checkGUID();
				$_SESSION['userguid'] = $guid;
				//echo " Set GUID.";
			}
			

			//Check if ID already exists in the database, if so, regenerate until it doesnt (for safety - highly unlikely they will match)
			function checkGUID() {
				$textquery = mysql_query("SELECT guid FROM sync WHERE guid='$guid' LIMIT 1");
				$rowCount = mysql_num_rows($textquery);
				if($rowCount > 0){
					while ($row = mysql_fetch_array($textquery)){
						$dbGuid = $row['guid'];
					}
				};
				if ($dbGuid == ""){
					//echo "New GUID.";
				} else {
					$guid = randID();
					checkGUID();
					//echo "GUID existed. Tried again.";
				}
			}
		?>
		
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle Nav</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#" onclick="" title="Home"><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> | <span class="title">Home &nbsp;&nbsp;&nbsp;</span></a>
				</div>
				<div class="navbar-collapse collapse">
					<div class="navbar-form navbar-left cent">
						<input type="text" name="yourcode" id="yourcode" placeholder="<?php echo $guid ?>" class="form-control codeout cent dis" disabled>
						<button class="btn btn-default blue" onclick="clearSesh()" title="Get New Code">&nbsp;<i class="fa fa-refresh">&nbsp;</i></button>
					</div>
					<form class="navbar-form navbar-right" id="oldcodeform" role="form" action="remake.php" method="get">
						<div class="form-group">
							<input type="text" name="oldcode" id="oldcode" placeholder="Old Code..." class="form-control codeout upper">
						</div>
						<button type="submit" class="btn btn-default blue makeBtn">Make</button>
					</form>
				</div>
			</div>
		</div>

		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<div class="col-md-4 cent">
						<img src="img/logo_blue.png" alt="logo" class="img-responsive" />
					</div>
					<div class="col-md-8">
						<h1>Hey, <span class="blue">big sharer!</span></h1>
						<p><strong class="blue">Syncly</strong> (Sink-Lee): a simple tool for sharing a tab to another device.
						<br><strong>No more typing.</strong></p>
						<p>Share something cool with a friend on your phone, or just take a tab away.
						<br>It even keeps a record of previous tabs for later.</p>
						<p>There's only a few steps to get set up, so <span class="blue cur" onclick="$('html, body').animate({scrollTop: ($('.setup').offset().top)-80}, 1000);" title="Go to Step 1..."><u>let's get cracking...</span></u></p>
					</div>
				</div>
			</div>
		</div>

		<div class="container setup">
			<div class="row">
				<div class="col-md-5 cent">
					<h2>Scan</h2>
					<!-- QR Code | Using free Google service: https://developers.google.com/chart/infographics/ -->
					<p><img class="qr" src="http://chart.apis.google.com/chart?cht=qr&chs=150x150&chl=http://penguin.uclan.ac.uk/~cjbond2/syncly/device/list.php?code=<?php echo $guid ?>" title="Scan this with your device." /></p>
					<p><strong>Easy.</strong></p>
				</div>
				<div class="col-md-2 cent">
					<br>
					<span class="blue"><img src="img/or.png" alt="or..." /></span>
				</div>
				<div class="col-md-5 cent">
					<h2>Type</h2>
					<br>
					<p>Go to</p>
					<!-- Short link generated with thanks to Bitly (see JS below) -->
					<p class="blue big"><strong><span class="bitly">Loading...</span></strong></p>
					<p>on your receiving device.</p>
					<br><br>
					<p><strong>Sorted.</strong></p>
				</div>
			</div>
			<br>
			<hr>
			<div class="row done">
				<div id="doneBtn" class="col-md-12 cent doneBtn">
					<button class="btn btn-primary btn-lg done" onclick="askPass()">Okay, I've done that.</button>
				</div>
				<div id="secret" class="col-md-12 cent secret hide">
					<p>Just to check, do you have the <span class="blue">Secret Passcode</span> we told you?</p>
					<form class="navbar-form" id="secretcode" action="bmark.php" method="get">
						<input type="hidden" name="guid" id="guid" value="<?php echo $guid ?>">
						<div class="form-group">
							<input type="text" class="input-lg" name="passcode" id="passcode" placeholder="The Secret Passcode..." class="form-control">
						</div>
						<br><br>
						<button class="btn btn-primary btn-lg" onclick="checkCode()">Give me my Bookmark</button>
					</form>
				</div>
			</div>
			<br><br>
		</div>
			
		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<div class="col-md-12 cent">
						<img src="img/help.png" alt="Help" />
						<p><strong>Both of the above not working?</strong></p>
						<p>Go to <strong class="blue">http://j.mp/synclyapp</strong> on your device, and <strong>enter</strong>:</p>
						<br>
						<p class="frame blue"><strong><?php echo $guid ?></strong></p>
						<br>
						<p><strong>Still nothing?</strong></p>
						<p><button class="btn btn-default btn-lg blue" onclick="clearSesh()" title="Generate a new code...">Get a new code.</button></p>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<footer class="right">
					<p><img src="img/logo_dgrey.png" alt="logo"/><span class="blue">Syncly</span> &copy; Connor Bond 2014 &nbsp;&nbsp;&nbsp;</p>
				</footer>
			</div>
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script>

			//Change page title (in the tab bar) to hint to contents role
			var height;
			$(window).scroll(function() {
				height = $(window).scrollTop();
				if (height  > 300) {
					$(".title").html("Step 1/4");
					$('.navbar-brand').prop('title', 'Back to Top');
					document.title = "Syncly | Get Started";
				} else {
					$(".title").html("Home &nbsp;&nbsp;&nbsp;");
					$('.navbar-brand').prop('title', 'Home');
					document.title = "Syncly | Your Tabs, Shared.";
				}
			});
		
			/*Check if the user gave the correct code (upper or lower case to be fairer)
				Not particularly a security issue, but to track if user has actually followed instructions on Device */
			function checkCode() {
				if (document.getElementById("passcode").value == "JAEGER" || document.getElementById("passcode").value == "jaeger") {
					document.getElementById("secretcode").submit();
				}
			}
			
			//Convert users code to uppercase visually
			function checkOld() {
				$("#oldguid").val(function(i,val) {
					return val.toUpperCase();
				});
			}
			

			//Clear the GUID session (using AJAX), and refresh the page to display a new one.
			function clearSesh() {
				$.get("includes/clearSesh.php");
				setTimeout(function() {
					window.location.replace("http://penguin.uclan.ac.uk/~cjbond2/syncly/");
				}, 300);
			}
			
			//Show form for entering password (nicer visual touch)
			function askPass() {
				$('.secret').removeClass("hide");
				$('.doneBtn').addClass("hide")
			}
		
			//Bitly URL Shortener API - to save users poor lil fingers!
			//http://stackoverflow.com/questions/4760538/using-only-javascript-to-shrink-urls-using-the-bit-ly-api		
			var login = "cjbond2";
			var api_key = "R_aeaeef1c637ed7cbcaea8722873cd4a1";
			var long_url = "http://penguin.uclan.ac.uk/~cjbond2/syncly/device/list.php?code=<?php echo $guid ?>";
			function get_short_url(long_url, login, api_key, func){
				$.getJSON(
					"http://api.bitly.com/v3/shorten?callback=?", 
					{ 
						"format": "json",
						"apiKey": api_key,
						"login": login,
						"longUrl": long_url
					},
					function(response)
					{
						func(response.data.url);
					}
				);
			}
			//Show short url on page
			get_short_url(long_url, login, api_key, function(short_url) {
				$('.bitly').html('<strong>' + short_url + '</strong>');
			});
			
		</script>
	</body>
</html>
