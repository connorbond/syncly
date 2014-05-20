<?php session_start(); require("../includes/connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Syncly | Your Tabs, Shared.">
		<meta name="author" content="Connor Bond">
		<title>Syncly | Tab Saved.</title>
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
			//Validated data to be saved to database - for safety
			function valid($data) {
			  $data = mysql_real_escape_string($data);
			  $data = htmlspecialchars($data);
			  $data = urlencode($data);
			  return $data;
			}

			$guid = $_GET['guid'];
			$title = valid($_GET['title']);
			$url = $_GET['url'];
			$note = valid($_GET['note']);
			

			//Delete the first default link when one is added
			$delete = "DELETE FROM sync WHERE guid='$guid' AND url='The link will appear here. Tap to copy.'";
			$dresult = mysql_query($delete);
			
			//Send the tab data to the database
			$query = "INSERT INTO sync (guid, url, title, note) VALUES ('$guid', '$url', '$title', '$note')";
			$result = mysql_query($query);
		?>
		
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="../index.php" title="Syncly | Home"><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> | Tab Saved!</a>
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
						<h1>Tab <span class="blue">Saved.</span></h1>
						<p>Title: <strong><?php echo urldecode($title); ?></strong></p>
						<p>Link: <strong><?php echo urldecode($url); ?></strong></p>
						<?php 
							if ($note != "note") { 
								echo '<p>Note: <strong>' . urldecode($note) . '</strong></p>'; 
							} 
						?>
						<p>Using the code: <strong><?php echo $guid ?></strong></p>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12 cent">
					<?php
						if ($note == "note") {
							echo '<p><strong class="blue">Did you know:</strong> If you <strong>select some text</strong> on a page, we\'ll automatically save that as a note.</p><hr /><p>Want to add a note manually now?</p>';
						} else {
							echo '<p>Your <strong>selection was saved</strong> as a note.<br />Want to <strong class="blue">edit</strong> this note?</p>';
						}
					?>
					<form class="navbar-form noteform" role="form" action="note.php" method="get">
						<div class="form-group noteform">
							<input type="hidden" id="guid" name="guid" value="<?php echo $guid ?>">
							<input type="hidden" id="url" name="url" value="<?php echo $url ?>">
							<input type="text" id="notenew" name="notenew" value="<?php if ($note != "note") { echo $note; } ?>" placeholder="Note..." class="form-control noteinput">
						</div>
						<button type="submit" class="btn btn-primary" title="Add a note.">Add</button>
					</form>
				</div>
			</div>

			<hr>

			<footer class="right">
				<p><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> &copy; Connor Bond 2014</p>
			</footer>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>
