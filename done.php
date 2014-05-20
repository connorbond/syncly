<?php session_start(); require("includes/connect.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Syncly | Your Tabs, Shared.">
		<meta name="author" content="Connor Bond">
		<title>Syncly | Done. Get Sharing!</title>
		<link rel="icon" type="image/png" href="img/favicon.ico" />
		
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Custom styles-->
		<link href="css/style.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php
			$guid = $_GET['guid'];
			$title = 'Welcome to Syncly!';
			$url = 'The link will appear here. Tap to copy.';
			$note = "Any selected text will appear here.";
			
			if ($_SESSION['create'] != "Row created." && !empty($guid)) {
				$query = "INSERT INTO sync (guid, url, title, note) 
						 VALUES ('$guid', '$url', '$title', '$note')";
				$_SESSION['create'] = "Row created.";
				//echo 'User added.';
			} else {
				//echo 'No GUID, or the GUID already exists.';
			}
					
			$result = mysql_query($query);
			mysqli_close($dbc);
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
					<a class="navbar-brand" href="index.php" title="Home"><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> | Finished.</a>
				</div>
				<div class="navbar-collapse collapse">
					<div class="navbar-form navbar-right" role="form" action="#">
						<div class="form-group">
							All set? &nbsp;
						</div>
						<a href="https://www.google.co.uk"><button class="btn btn-primary">Go find cool things!</button></a>
						<a href="index.php"><button class="btn btn-default blue">Home</button></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<div class="col-md-4 cent">
						<img src="img/logo_spin.gif" alt="logo" />
					</div>
					<div class="col-md-8">
						<h1><span class="green">Done</span>. Now sync a tab.</h1>
						<br><br>
						<p>Click <i class="fa fa-refresh blue"></i> <strong>Sync Tab</strong> when you want to send a tab.
						<br>A link will now appear on your device. <strong>Like magic.</strong></p>
						<p>Just <strong class="blue">open the app</strong> to see.</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<p>Hint: <strong class="blue">Select some text</strong> then click <i class="fa fa-refresh blue"></i> <strong>Sync Tab</strong>. That text will be sent along as a <strong>note</strong>, just tap <strong class="blue">More</strong> to see.</p>
					<p>Want a bookmark for another browser? Just <strong>make one using your old code.</strong></p>
				</div>
				<div class="col-md-12">
					<hr>
					<footer class="right">
						<p><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> &copy; Connor Bond 2014 &nbsp;&nbsp;&nbsp;</p>
					</footer>
				</div>
			</div>
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>	
	</body>
</html> 