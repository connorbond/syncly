<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Syncly | Device Setup">
	<meta name="author" content="Connor Bond">
	<title>Syncly | Device Setup</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Custom styles-->
	<link href="css/styles.css" rel="stylesheet">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><img src="img/logo_retina.png" alt="logo" width="30px" height="30px" /> <span class="blue">Syncly</span> | Sync Device</a>
			</div>
		</div>
	</div>
	
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-md-12 cent">
					<h1>Enter your Unique Code:</h1>
					<form id="entercode" class="navbar-form in" role="form" action="#" method="get">
						<div class="form-group">
							<input type="text" class="ucode input-lg" name="code" id="code" placeholder="Existing Code..." class="form-control">
						</div>
					</form>
					<button class="btn btn-primary btn-lg in" onclick="checkcode()">Sync Bookmark</button>
					<p class="valid">&nbsp;</p>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="container">
		<div class="row">
			<footer class="cent">
				<p><img src="img/logo_retina.png" alt="logo" width="30px" height="30px"/> <span class="blue">Syncly</span> &copy; Connor Bond 2014</p>
			</footer>
		</div>
	</div>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>	
	<script>
		$(".valid").html("&nbsp;");

		$('.ucode').keyup(function(){
			this.value = this.value.toUpperCase();
		});

		function checkcode() {
			value = $(".ucode").val();
			if (value.length == 7) {
				$('#entercode').get(0).setAttribute('action', 'list.php');
				document.getElementById("entercode").submit();
				$(".valid").html("<span class='text-success'>Syncing...</span>");
			} else {
				$(".valid").html("<span class='text-danger'>Not 7 chars.</span>");
			}
		}
	</script>
</body>
</html> 