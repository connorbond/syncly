<?php session_start(); require("../includes/connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Syncly | Your Tabs, Shared.">
		<meta name="author" content="Connor Bond">
		<title>Syncly | Note Attached.</title>
		<link rel="icon" type="image/png" href="img/favicon.ico" />
		
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Custom styles-->
		<link href="css/styles.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php
			$guid = $_GET['guid'];
			$url =	$_GET['url'];
			$note = $_GET['notenew'];
			
			$editquery = mysql_query("UPDATE sync SET note='$note' WHERE guid='$guid' AND url='$url'");	
		?>
		
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="../index.php"><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> | Note Attached!</a>
				</div>
			</div>
		</div>

		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<div class="col-md-4 cent">
						<img src="img/logo_blue.png" alt="logo" />
					</div>
					<div class="col-md-8">
						<h1>Note <span class="blue">Attached</span></h1>
						<p>Link: <strong><?php echo urldecode($url); ?></strong></p>
						<p>Note: <strong><?php echo urldecode($note); ?></strong></p>
						<p>Using the code: <strong><?php echo $guid ?></strong></p>
						<br>
						<p><strong>You may now close this tab.</strong></p>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<footer class="right">
				<p><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> &copy; Connor Bond 2014</p>
			</footer>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>
