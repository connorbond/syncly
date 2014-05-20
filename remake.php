<?php session_start(); require("includes/connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Syncly | Your Tabs, Shared.">
		<meta name="author" content="Connor Bond">
		<title>Syncly | Remake Bookmarklet</title>
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
		<!-- Script to give favicon to bookmarklet, then send user back (all in 10ms) -->
		<!-- Reference: http://www.tapper-ware.net/blog/?p=267 | Author: Hans Schmucker -->
		<script>
		  top["bookmark@make"] = ''
			+'<!DOCTYPE html>'
			+'<html>'
			  +'<head>'
				+'<title>Syncly | Adding icon...</title>'
				+'<link rel="icon" href="http://penguin.uclan.ac.uk/~cjbond2/syncly/img/bmk.png" />'
			  +'</head>'
			  +'<body>'
			  	+'Got the icon for your button, sending you back... <a href="#" onclick="history.back();">Take me back.</a>'
				+'<script>'
				  +'window.onload=function(){'
					+'window.setTimeout(function(){'
					  +'history.back();'
					+'},10);'
				  +'};'
				+'</scr'+'ipt>' //if not broken up, attempts to close the initial script tag too early and errors.
			  +'</body>'
			+'</html>'
		  ;
		</script>
		<?php
			$givenguid = strtoupper($_GET['oldcode']);
		
			$textquery = mysql_query("SELECT guid FROM sync WHERE guid='$givenguid' LIMIT 1");
			$rowCount = mysql_num_rows($textquery);
			if($rowCount > 0){
				while ($row = mysql_fetch_array($textquery)){
					$dbGuid = $row['guid'];
				}
			};
			
			if ($dbGuid == ""){
				echo "<span class='state hide'>Incorrect</span>";
			} else {
				echo "<span class='state hide'>Correct</span>";
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
					<a class="navbar-brand" href="index.php" title="Home"><i class="fa fa-chevron-left"></i> <img src="img/logo_dgrey.png" alt="logo" /><span class="blue">Syncly</span></a>
				</div>
				<div class="navbar-collapse collapse">
					<div class="navbar-form navbar-right correct hide" role="form">
						<div class="form-group">
							Done? Page refreshed? &nbsp;
						</div>
						<a href="https://www.google.co.uk"><button class="btn btn-success">Go find cool things!</button></a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- INCORRECT -->
		<span class="incorrect hide">
			<div class="jumbotron">
				<div class="container">
					<div class="row">
						<div class="col-md-12 cent">
							<h1>Sorry, that code isn't valid. Try again:</p></h1>
							<form id="entercode" class="navbar-form in" role="form" action="#" method="get">
								<div class="form-group">
									<input type="text" name="oldcode" id="oldcode" placeholder="Existing Code..." class="input-lg dark ucode">
								</div>
							</form>
							<button class="btn btn-primary btn-lg in" onclick="checkcode()">Make</button>
							<p class="valid">&nbsp;</p>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<p>Attempted to generate using the code: <strong><? echo $givenguid; ?></strong></p>
				</div>
			</div>
		</span>
		
		<!-- CORRECT -->
		<span class="correct hide">
			<div class="jumbotron" onmouseover="shakeItUp()">
				<div class="container">
					<div class="row">
						<div class="col-md-9">
							<h1 class="msg"><strong>Drag</strong> this <span class="blue">*new*</span> little button to your Bookmarks Bar <span class="hand"><i class="fa fa-hand-o-right"></i></span></h1>
						</div>
						<div class="col-md-3 cent bookWrap">
							<p><a id="bmk" class="bMark btn btn-primary btn-lg" ondragstart="dragS()" ondragend="dragE(); this.click()" title="^ Drag me to your Bookmarks bar. ^" href="javascript:if(top['bookmark@make']){top['bookmark@make'];}else{function saveit(){var%20guid%20%3D%20'<?php echo $givenguid; ?>'%3Bvar%20title%20%3D%20escape(document.title)%3Bvar%20url%20%3D%20escape(window.location.href)%3Bvar%20note%20%3D%20%22note%22%3Bif%20(window.getSelection()!%3D'')%7Bnote%20%3D%20escape(window.getSelection())%3B%7Dwindow.open('http%3A%2F%2Fpenguin.uclan.ac.uk%2F~cjbond2%2Fsyncly%2Fdesktop%2Fsave.php%3Ftitle%3D'%2Btitle%2B'%26url%3D'%2Burl%2B'%26note%3D'%2Bnote%2B'%26guid%3D'%2Bguid)} saveit();}"><span class="bmktext"><i class="fa fa-refresh dblue sync"></i>Sync Tab<i class="fa fa-bars dblue bbars"></i></span></a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<br>
						<p>If you want your links to appear on a <strong>second device</strong> too, just <strong>scan</strong> this <i class="fa fa-hand-o-right"></i> and follow the set-up like you did last time.</p>
						<p>You can do this on as many devices as you'd like. Now isn't that just <span class="blue">awesome</span>.</p>
						<br>
						<p>Generated using the code: <span class="blue"><strong><? echo $givenguid; ?></strong></span></p>
					</div>
					<div class="col-md-3 cent">
						<p><img class="qr" src="http://chart.apis.google.com/chart?cht=qr&chs=150x150&chl=http://penguin.uclan.ac.uk/~cjbond2/syncly/device/list.php?code=<?php echo $givenguid ?>" title="Scan this with your device." /></p>
					</div>
				</div>
			</div>
		</span>

		<!-- FOOTER -->
		<hr>
		<div class="container">
			<div class="row">
				<footer class="right">
					<p><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> &copy; Connor Bond 2014  &nbsp;&nbsp;&nbsp;</p>
				</footer>
			</div>
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script>
			if ($('.state').html() == "Correct") {
				$('.correct').removeClass("hide");
			} else {
				$('.incorrect').removeClass("hide");
			}
			
			var cursorY;
			document.ondragover = function(e){
				cursorY = e.pageY;
				//$('.y').html(cursorY);
				if (cursorY < 5) {
					$('.msg').html('Drop it here <img src="img/bookbar.png">. The page will refresh, dont fret.');
				} else if (cursorY < 50) {
					$('.msg').html('So close now!<br>Go go go.');
				} else if (cursorY < 100) {
					$('.msg').html('Nearly there, keep going.<br>Keep going.');
				} else if (cursorY < 300) {
					$('.msg').html('Right that\'s it, now just drag me up top :)');
				} else if (cursorY < 350) {
					$('.msg').html('Go up!<br>...');
				} else if (cursorY > 351) {
					$('.msg').html('Well, that\'s just the wrong way isn\'t it...');
				}
			}
			
			function showInst() {
				$('.inst').toggleClass("hide");
			}
			
			function dragS() {
				$('.msg').html('Right, now just drag it up top :)');
			}
			
			function dragE() {
				if (cursorY <= 10) {
					$('.msg').html('Woo! You did it! <br>Now continue as you were.');
				} else {
					$('.msg').html('You missed! <br>Try dragging again.');
				}
			}
			
			function shakeItUp() {
				$('#bmk').removeClass('bounce').addClass('bounce' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					$(this).removeClass('bounce');
				});
			};
			
			$('.ucode').keyup(function(){
				this.value = this.value.toUpperCase();
			});

			function checkcode() {
				value = $(".ucode").val();
				if (value.length == 7) {
					$('#entercode').get(0).setAttribute('action', 'remake.php');
					document.getElementById("entercode").submit();
					$(".valid").html("Making...");
				} else {
					$(".valid").html("Code not valid.");
				}
			}
		</script>
	</body>
</html>