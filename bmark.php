<?php session_start(); require("includes/connect.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Syncly | Your Tabs, Shared.">
		<meta name="author" content="Connor Bond">
		<title>Syncly | Get Bookmarklet</title>
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
		<!-- Script to give favicon to bookmarklet (MUST change page) -->
		<!-- Reference Guide: http://www.tapper-ware.net/blog/?p=267 | Author: Hans Schmucker -->
		<script>
		  top["bookmark@syncly"] = ''
			+'<!DOCTYPE html>'
			+'<html>'
			  +'<head>'
				+'<title>Syncly | Got it?</title>'
				+'<link rel="icon" href="http://penguin.uclan.ac.uk/~cjbond2/syncly/img/bmk.png" />'
				+'<link href="css/bootstrap.css" rel="stylesheet">'
				+'<link href="css/style.css" rel="stylesheet">'
				+'<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">'
			  +'</head>'
			  +'<body>'
				+'<div class="navbar navbar-default navbar-fixed-top" role="navigation">'
					+'<div class="container">'
						+'<div class="navbar-header">'
							+'<a class="navbar-brand" href="index.php" title="Home"><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> | Step 4/4</a>'
						+'</div>'
					+'</div>'
				+'</div>'
			  	+ '<div class="jumbotron">'
					+ '<div class="container">'
						+ '<div class="row">'
							+ '<div class="col-md-12 cent">'
								+ '<h1 class="msg">Do you see your button in the bar?</h1><br>'
								+ '<p><a href="#" onclick="history.back();" title="< Try again"><button class="btn btn-warning btn-lg hugeBtn">No - I missed</button></a>'
								+ '&nbsp;&nbsp;&nbsp;'
								+ '<a href="http://penguin.uclan.ac.uk/~cjbond2/syncly/done.php" title="Finish >"><button class="btn btn-success btn-lg hugeBtn">Yes - Got it</button></a></p>'
							+ '</div>'
						+ '</div>'
					+ '</div>'
				+ '</div>'
				+ '<div class="container">'
					+ '<div class="row">'
						+ '<footer class="right">'
							+ '<p><img src="img/logo_dgrey.png" alt="logo"/><span class="blue">Syncly</span> &copy; Connor Bond 2014 &nbsp;&nbsp;&nbsp;</p>'
						+ '</footer>'
					+ '</div>'
				+ '</div>'
			  +'</body>'
			+'</html>'
		  ;
		</script>

		<!-- Make entry in database (to tell app to hide instructions screen), using a default link. -->
		<?php
			$guid = $_GET['guid'];
			$title = 'Welcome to Syncly!';
			$url = 'http://penguin.uclan.ac.uk/~cjbond2/syncly/';
			$note = "Any text you select appears here.";
			
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
					<a class="navbar-brand noselect" href="index.php" title="Home"><img src="img/logo_dgrey.png" alt="logo" /> <span class="blue">Syncly</span> | Step 3/4</a>
				</div>
				<div class="navbar-collapse collapse noselect">
					<form class="navbar-form navbar-right" role="form" action="done.php">
						<div class="form-group">
							Done? &nbsp;
						</div>
						<button type="submit" class="btn btn-default">Finish</button>
					</form>
				</div>
			</div>
		</div>
		
		<div class="jumbotron jbmk">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<h1 class="msg noselect noclick"><strong>Drag</strong> this little button to your Bookmarks Bar <i class="fa fa-hand-o-right"></i></h1>
					</div>
					<div class="col-md-3 cent bookWrap">
						<p><a id="bmk" class="bMark btn btn-primary btn-lg" ondragstart="dragS()" ondragend="this.click()" title="^ Drag me to your Bookmarks bar. ^" href="javascript:if(top['bookmark@syncly']){top['bookmark@syncly'];}else{function saveit(){var%20guid%20%3D%20'<?php echo $guid; ?>'%3Bvar%20title%20%3D%20escape(document.title)%3Bvar%20url%20%3D%20escape(window.location.href)%3Bvar%20note%20%3D%20%22note%22%3Bif%20(window.getSelection()!%3D'')%7Bnote%20%3D%20escape(window.getSelection())%3B%7Dwindow.open('http%3A%2F%2Fpenguin.uclan.ac.uk%2F~cjbond2%2Fsyncly%2Fdesktop%2Fsave.php%3Ftitle%3D'%2Btitle%2B'%26url%3D'%2Burl%2B'%26note%3D'%2Bnote%2B'%26guid%3D'%2Bguid)} saveit();}"><span class="bmktext"><i class="fa fa-refresh dblue sync"></i>Sync Tab<i class="fa fa-bars dblue bbars"></i></span></a></p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container noselect">
			<div class="row">
				<div class="col-md-6 cent">
					<p class="dropInst">Drop your icon like shown:</p>
					<p><div id="theBar"><img src="img/bookbar.png" onMouseDown="return false;" title="Drop your button down as shown here." alt="Bookmark Bar Location" /></div></p>
				</div>
				<div class="col-md-6 cent">
					<br>
					<p class="note">
						<a href="#" class="show" onclick="showInst()" title="Show how to open the Bookmarks bar.">Can't see your Bookmarks Bar?</a>
						<p class="inst hide">For <strong class="blue">Firefox</strong>, right click the <kbd>Favourite's Star <i class="fa fa-star"></i></kbd> and tick <kbd>Bookmarks Toolbar</kbd>.</p>
						<p class="inst hide">For <strong class="blue">Internet Explorer</strong>, click <kbd>Tools</kbd>, point to <kbd>Toolbars</kbd> and click <kbd>Favorites Bar</kbd>.</p>
						<p class="inst hide">For <strong class="blue">Chrome</strong>, just press <kbd>CTRL</kbd> + <kbd>SHIFT</kbd> + <kbd>B</kbd>.</p>
					</p>
					<br>
					<p class="faint">Your Code: <strong><?php echo $guid; ?></strong></p>
				</div>
			</div>
		</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/jquery.cookie.js"></script>
		<script>
			var cursorY;
			document.ondragover = function(e){
				cursorY = e.pageY;
				//$('.y').html(cursorY);
				if (cursorY < 5) {
					$('.msg').html('Now let go on the Bookmark\'s bar.');
				} else if (cursorY < 50) {
					$('.msg').html('So close now!<br>Go go go.');
				} else if (cursorY < 100) {
					$('.msg').html('Nearly there, keep going.<br>Keep going.');
				} else if (cursorY < 220) {
					$('.msg').html('Right that\'s it, now just drag me up top :)');
				} else if (cursorY < 300) {
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
			
			function shakeItUp() {
				$('#bmk').removeClass('bounce').addClass('bounce' + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
					$(this).removeClass('bounce');
				});
			};
			
			$('.jbmk').bind("mouseenter", shakeItUp());
		</script>	
	</body>
</html> 