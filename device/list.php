<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="author" content="Connor Bond">
	<title>Syncly</title>

	<!-- Android 'Webapp' -->
	<meta name="mobile-web-app-capable" content="yes">
  	<link rel="icon" sizes="196x196" href="img/icon/android.png">

  	<!-- Apple 'Webapp' -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<!-- iOS 7 iPad (retina) -->
	<link href="img/icon/apple-touch-icon-152x152.png"
	sizes="152x152"
	rel="apple-touch-icon">
	<!-- iOS 6 iPad (retina) -->
	<link href="img/icon/apple-touch-icon-144x144.png"
	sizes="144x144"
	rel="apple-touch-icon">
	<!-- iOS 7 iPhone (retina) -->
	<link href="img/icon/apple-touch-icon-120x120.png"
	sizes="120x120"
	rel="apple-touch-icon">
	<!-- iOS 6 iPhone (retina) -->
	<link href="img/icon/apple-touch-icon-114x114.png"
	sizes="114x114"
	rel="apple-touch-icon">
	<!-- iOS 7 iPad -->
	<link href="img/icon/apple-touch-icon-76x76.png"
	sizes="76x76"
	rel="apple-touch-icon">
	<!-- iOS 6 iPad -->
	<link href="img/icon/apple-touch-icon-72x72.png"
	sizes="72x72"
	rel="apple-touch-icon">
	<!-- iOS 6 iPhone -->
	<link href="img/icon/apple-touch-icon-57x57.png"
	sizes="57x57"
	rel="apple-touch-icon">
	
	<!-- Bootstrap CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Normalize CSS -->
	<link href="css/normalize.css" rel="stylesheet">
	<!-- Custom Styles -->
	<link href="css/styles.css" rel="stylesheet">
	<!-- Font Awesome Icon Set -->
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!-- Animate.css | http://daneden.github.io/animate.css/ -->
	<link href="css/animate.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<!-- Check for device, set variable and device-specific styles -->
	<?php 
		$ua = $_SERVER['HTTP_USER_AGENT'];
		$iphone = strpos($ua,"iPhone");
		$safari = strpos($ua,"Safari"); 
		// If an iphone, style statusbar to fit with app's colour scheme
		if ($iphone == true && $safari == false){
			echo '<style type="text/css"> .statusbar{ background: #F8F8F8; height: 200px; width:100%; position: fixed; top:-180px; z-index: 9999; } body, .head{ margin-top: 14px; } .preview { top: 64px; } .copypop { top: 54px; } </style>';
		} else {
			echo '<style type="text/css"> .statusbar{ display:none; } </style>';
		}
	?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<script>
		// Check if device is android, and running as a full screen web app
		document.onreadystatechange = function(e){
		    if (document.readyState === 'complete'){
		    	var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
		        if (isAndroid && (screen.height-document.documentElement.clientHeight<40)){
		        	//alert('Android Webapp.')
					$('body').css("padding-top","0");
					$('body').css("padding-bottom","0");
					$('body').css("background","#F4FAFF");
			 		$(".setup").html("<div class='webapp-setup'>" +
			 			"<div class='pane'>" +
			 			"<img src='img/logo_blue.png' alt='logo' width='140px' height='140px' onclick='location.reload();' />" +
			 			"<br><span class='emp'>Hello from Syncly!</span>" +
			 			"<br><br><p>Now that's saved, we can get you<br>a <strong>bookmarklet</strong>.</p>" +
			 			"<p><span class='blue'>Swipe</span> or tap <span class='blue'>Next</span> to continue...</p>" +
			 			"<br>" +
			 			"<div class='point b'></div><div class='point'></div><div class='point'></div><div class='point'></div>" +
			 			"<p><button class='btn btn-primary' onclick='nextStep(1)'>Next</button></p>" +
			 			"</div>" +
			 			"<div class='pane'>" +
			 			"<p><i class='fa fa-arrow-up fa-5x blue animated bounce infinite'></i></p><br><br>" +
			 			"<p>Look back to your <strong>desktop</strong>, and <strong>click:</strong></p>" +
						"<p><div class='frame'><button class='btn btn-primary btn-lg' onclick='nextStep(2)'>Okay, I've done that.</button></div></p>" +
						"<br>" +
						"<div class='point'></div><div class='point b'></div><div class='point'></div><div class='point'></div>" +
						"<p><button class='btn btn-primary' onclick='nextStep(2)'>Next</button></p>" +
						"</div>" +
						"<div class='pane'>" +
						"<p><i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i></p><br>" +
						"<p>When asked, enter the <strong>passcode</strong>:</p>" +
						"<p><div class='frame pushdown'>JAEGER</div></p>" +
						"<p class='pushdown'>This is just to check you got this far.</p>" +
						"<div class='point'></div><div class='point'></div><div class='point b'></div><div class='point'></div>" +
						"<p><button class='btn btn-primary' onclick='nextStep(3)'>Next</button></p>" +
						"</div>" +
						"<div class='pane'>" +
						"<p><i class='fa fa-check fa-5x blue animated tada infinite'></i></p><br>" +
						"<p class='emp'>Once you have your bookmarklet...<br><span class='blue'>Congrats! Thats you set!</span><p>" +
						"<p>Tap below to begin...<p>" +
						"<br><br>" +
						"<div class='point'></div><div class='point'></div><div class='point'></div><div class='point b'></div>" +
						"<p><button class='btn btn-primary' onclick='location.reload();'>Ive got it.</button></p>" +
						"</div>" +
					"</div>");
		        }
		    }
		};
	</script>

	<script src="js/jquery.scrollstop.js"></script>
	<script src="js/jquery.easing.min.js"></script>
	<script src="js/jquery.scrollsnap.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(document).scrollsnap({
				direction: 'x',
				snaps: '.pane',
				proximity: 200,
				latency: 50,
				duration: 300
			});
		});
	</script>
</head>

<?php require("../includes/connect.php"); ?>

<body>
	<div class="statusbar"> </div>
    <?php
        $guid = $_GET['code'];

        $textquery = mysql_query("SELECT url, title, note, pos FROM sync WHERE guid='$guid' ORDER BY pos DESC");
        $rowCount = mysql_num_rows($textquery);
        if($rowCount > 0){
            while ($row = mysql_fetch_array($textquery)){
                $currUrl[] = $row['url'];
                $currTitle[] = $row['title'];
                $currNote[] = $row['note'];
            }
            $ext = pathinfo($currUrl, PATHINFO_EXTENSION);
        };
		
		if ($currUrl == ""){
			echo "<span class='state hide'>No Content</span>";
		} else {
			echo "<span class='state hide'>Content</span>";
		}
    ?>
	
	<!-- SETUP -->
	<span class="setup hide">
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php"><img src="img/logo_retina.png" alt="logo" width="30px" height="30px" /><span class="blue">Syncly</span> | Step 2/4 &nbsp;<span class="faint">'<? echo $guid ?>'</span></a>
				</div>
			</div>
		</div>
	
		<div class="jumbotron">
			<div class="container">
				<div class="row">
					<div class="col-md-12 cent">
						<h1>Hey, you made it!</h1>
						<p>This is where your links will appear, so it's best you save it somewhere safe.</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12 cent">
					<p class='inst'>Set-up Instructions.</p>
				</div>
			</div>
		</div>
		
		<div class="jumbotron second_step">
			<div class="container">
				<div class="row">
					<div class="col-md-12 cent">
						<p>If youve done that, we can then get you a bookmarklet...<br>(a fancy little button, just for you)</p>
						<p>Please look back to your <span class="blue">desktop</span>, and <strong>click:</strong></p>
						<p><button class="btn btn-primary btn-lg">Okay, I've done that.</button></p>
						<br>
						<p>To check you have got this far, you will be asked for a <strong>codeword</strong>.</p>
						<p>When asked, enter:</p>
						<p><strong class="blue big">JAEGER</strong></p>
						<p>to continue the set-up process.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="container second_step">
			<div class="row">
				<div class="col-md-12 cent">
					<p class="blue">You're half way there, only 2 steps to go!</p>
				</div>
			</div>
		</div>
	</span>

	<!-- LIST -->
	<span class="list hide">
		<div id="urlcopy" class="copypop">Click to Copy</div>
		<div class="head">
			<div class="btns noselect">
				<div class="wideBtn left fL cur" onclick="toggleMore()"><p>&nbsp;&nbsp;&nbsp;<span class="view">More</span></p></div>
				<div class="btnLogo" onclick="location.reload();"><p><img src="img/logo_retina.png" alt="logo" width="30px" height="30px" /> Syncly</p></div>
				<a href="<? echo $currUrl[0] ?>"><div class="wideBtn right fR"><p>Open&nbsp;&nbsp;&nbsp;</p></div></a>
			</div>
			<div class="page_title more hide">
				<div class="preview noselect">
					<img src="http://api.webthumbnail.org?width=48&height=44&screen=1024&url=<? echo $currUrl[0] ?>" alt="WebThumb" width="40px" height="40px" />
				</div>
				<div class="title_out in">
					<div class="thetitle in"><input type="text" id="titlebox" name="titlebox" value="<? echo urldecode($currTitle[0]) ?>" onFocus="this.selectionStart=0; this.selectionEnd=this.value.length;" onTouchEnd="this.selectionStart=1; this.selectionEnd=this.value.length; $('.foot').addClass('hide');" onblur="$('.foot').removeClass('hide');" onMouseUp="return false" title="Click to Select, Ctrl+C to Copy"></div>
				</div>
			</div>
			<div class="url_out in">
				<div class="in fav noselect"><img class="favicon" src="http://google.com/s2/favicons?domain=<? echo $currUrl[0] ?>" alt="Fav" /></div>
				<div class="theurl in"><input type="text" id="urlbox" name="urlbox" value="<? echo  $currUrl[0] ?>" onFocus="this.selectionStart=0; this.selectionEnd=this.value.length; $('.copypop').addClass('hide');" onTouchEnd="this.selectionStart=1; this.selectionEnd=this.value.length; $('.copypop').addClass('hide'); $('.foot').addClass('hide');" onblur="$('.foot').removeClass('hide');" onMouseUp="return false" title="Click to Select, Ctrl+C to Copy"></div>
			</div>
			<div class="note_out in more hide">
				<div class="in note noselect"><i class="fa fa-file-o"></i></div>
				<p class="in">
					<?php 
						if ($currNote[0] != "note") {
							echo '<input type="text" id="notebox" name="notebox" class="notebox" value="' . urldecode($currNote[0]) . '" onFocus="this.selectionStart=0; this.selectionEnd=this.value.length;" onTouchEnd="this.selectionStart=1; this.selectionEnd=this.value.length;$(\'.foot\').addClass(\'hide\');" onblur="$(\'.foot\').removeClass(\'hide\');" onMouseUp="return false">';
						} else {
							echo '<input type="text" id="notebox" name="notebox" class="notebox" value="No note saved. Select text to save it." onFocus="this.selectionStart=0; this.selectionEnd=this.value.length;" onTouchEnd="this.selectionStart=1; this.selectionEnd=this.value.length; $(\'.foot\').addClass(\'hide\');" onblur="$(\'.foot\').removeClass(\'hide\');" onMouseUp="return false" title="No note saved.">';
						}
					?>
				</p>
			</div>
			<div class="history_bar noselect">
				<p>History</p>
			</div>
		</div>
		<div class="headSpace"></div>
		
		<div class="history">
			<div class="linkItem tip toptip noselect">
			   <div class="fL">
					<p class="in icon"><i class="fa fa-info-circle fa-2x"></i></p>
					<span class="in text tipTxt">Tips &amp; Advice</span>
			   </div>
			</div>  
			<?php
				for ($i = 1; $i <= $rowCount-1; $i++) {
					echo '
						<div class="linkItem">
							<div class="fL favicon"><img src="http://google.com/s2/favicons?domain=' . $currUrl[$i] . '" alt="Fav" /></div>
							<div class="in url"><p><input type="text" name="linkbox' . $i . '" value="' . $currUrl[$i] . '" class="linkbox' . $i . '" title="Click to Select, Ctrl+C to Copy" onFocus="if(iphone == false){this.selectionStart=0; this.selectionEnd=this.value.length;}" onTouchEnd="if(dragging == false){$(\'.foot\').addClass(\'hide\');}else{$(\'.foot\').removeClass(\'hide\');}" onblur="$(\'.foot\').removeClass(\'hide\');" onMouseUp="return false"></p></div>
							<a href="' . $currUrl[$i] . '" target="_blank"><div class="chev" title="View More"><p><i class="fa fa-chevron-right fa-2x"></i></p></div></a>
						</div>
					';
				}
			?>	
		</div>

		<div class="total">
			<?php
				if ($rowCount == 1){
					echo $rowCount . " Link";
				} else {
					echo $rowCount . " Links";
				}
			?>
		</div>
		<div class="end"></div>

		<div class="foot">
			<div class="fL footL cur" onclick="location.reload();"><p><span class="blue">Refresh</span></p></div>
			<div class="fR footR"><p>Code: <span class="blue"><? echo $guid ?></span></p></div>
		</div>
	</span>

	<script src="js/bootstrap.js"></script>	
	<script>
		var dragging = false;
		var iphone = false;
	
		if ($('.state').html() == "Content") {
			$('.list').removeClass("hide");
			$('.statusbar').css("background","#F8F8F8");
		} else {
			$('.setup').removeClass("hide");
			$('.statusbar').css("background","#F4FAFF");
		}
		
		$("body").bind("touchmove", function(){
			dragging = true;
		});
		$("body").bind("touchstart", function(){
			dragging = false;
		});

		//if being viewed as a 'web-app' on iOS, show specific instructions...
		if (("standalone" in window.navigator) && window.navigator.standalone){
			$("body").css("overflow", "hidden");
			$('body').css("padding-top","0");
			$('body').css("padding-bottom","0");
			$('body').css("background","#F4FAFF");
	 		$(".setup").html("<div class='webapp-setup'>" +
	 			"<div class='pane'>" +
	 			"<img src='img/logo_blue.png' alt='logo' width='140px' height='140px' onclick='location.reload();' />" +
	 			"<br><span class='emp'>Hello from Syncly!</span>" +
	 			"<br><br><p>Now that's saved, we can get you<br>a <strong>bookmarklet</strong>.</p>" +
	 			"<p><span class='blue'>Swipe</span> or tap <span class='blue'>Next</span> to continue...</p>" +
	 			"<br>" +
	 			"<div class='point b'></div><div class='point'></div><div class='point'></div><div class='point'></div>" +
	 			"<p><button class='btn btn-primary' onclick='nextStep(1)'>Next</button></p>" +
	 			"</div>" +
	 			"<div class='pane'>" +
	 			"<p><i class='fa fa-arrow-up fa-5x blue animated bounce infinite'></i></p><br><br>" +
	 			"<p>Look back to your <strong>desktop</strong>, and <strong>click:</strong></p>" +
				"<p><div class='frame'><button class='btn btn-primary btn-lg' onclick='nextStep(2)'>Okay, I've done that.</button></div></p>" +
				"<br>" +
				"<div class='point'></div><div class='point b'></div><div class='point'></div><div class='point'></div>" +
				"<p><button class='btn btn-primary' onclick='nextStep(2)'>Next</button></p>" +
				"</div>" +
				"<div class='pane'>" +
				"<p><i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i> <i class='fa fa-star fa-3x blue in'></i></p><br>" +
				"<p>When asked, enter the <strong>passcode</strong>:</p>" +
				"<p><div class='frame pushdown'>JAEGER</div></p>" +
				"<p class='pushdown'>This is just to check you got this far.</p>" +
				"<div class='point'></div><div class='point'></div><div class='point b'></div><div class='point'></div>" +
				"<p><button class='btn btn-primary' onclick='nextStep(3)'>Next</button></p>" +
				"</div>" +
				"<div class='pane'>" +
				"<p><i class='fa fa-check fa-5x blue animated tada infinite'></i></p><br>" +
				"<p class='emp'>Once you have your bookmarklet...<br><span class='blue'>Congrats! Thats you set!</span><p>" +
				"<p>Tap below to begin...<p>" +
				"<br><br>" +
				"<div class='point'></div><div class='point'></div><div class='point'></div><div class='point b'></div>" +
				"<p><button class='btn btn-primary' onclick='location.reload();'>Ive got it.</button></p>" +
				"</div>" +
			"</div>");
		}

		function nextStep(mult) {
			$('html, body').animate({scrollLeft: $(window).width()*mult}, 500);
		}
			
		var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
		var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());

		if (isiDevice) {
			iphone == true;
		}

		if (isiDevice) {
			$(".copypop").html("Tap to Copy");
			$(".tipTxt").html("<span class='blue'>Tap a URL to Copy. Tap <i class=\"fa fa-chevron-right\"></i> to open.</span>");
			$('.second_step').addClass("hide");
		} else if (isAndroid) {;
			$(".copypop").html("Tap to Copy");
			$(".tipTxt").html("<span class='blue'>Tap a URL to Copy. Tap <i class=\"fa fa-chevron-right\"></i> to open.</span>");
		} else {
			$(".tipTxt").html("<span class='blue'>Click a URL to Copy. Click <i class=\"fa fa-chevron-right\"></i> to open.</span>");
		}

		if (isiDevice) {
			$('.inst').html('Seeing as you are on an iOS device,<br>here\'s how you save this page directly to the home screen...<br /><br />Tap Share:<br /><br /><img src=img/share.png width="30px" height="30px" /><br /><br />then Add to Home Screen...<br /><br /><img src=img/addhome.png width="60px" height="60px" /><br /><br>The rest is all set for you, so just tap <span class="blue">Add</span>.<br><br>');
		} else if (isAndroid) {
			$('.inst').html('Seeing as you are on an Android device,<br>here\'s how you save this page directly to the home screen (in Chrome)...<br /><br />Tap Menu:<br /><br /><img src=img/menu.png width="30px" /><br /><br />then Add to home screen...<br /><br /><img src=img/addto.png width="161px" height="40px" /><br /><br>The rest is all set for you, so just tap <span class="blue">Add</span>.<br><br>');
		} else {
			$('.inst').html('Save this page as a <span class="blue">Bookmark</span>, or even to your <span class="blue">Homescreen</span>. Just <strong>keep it somewhere safe</strong> for me, okay.<br><br>');
		}
		
		var open = 0;
		function toggleMore() {
			$('.more').toggleClass('hide');
			$('.headSpace').toggleClass('bighead');
			if (open == 0) {
				$('.view').hide().html('Less').fadeIn();
				$('.copypop').addClass('hide');
				open = 1;
			} else {
				$('.view').hide().html('More').fadeIn();
				open = 0;
			}
		}
		
		var hidetip = setInterval(function(){
			$('.history').animate({
				top: ["-=50", "linear"]
			}, 1000);
			clearInterval(hidetip);
		},2500);
		
		var hidehelp = setInterval(function(){
			$('.copypop').fadeOut("slow");
			clearInterval(hidehelp);
		},2500);

        var prev = setInterval(function(){
			$(".preview").html("<img src=\"http://api.webthumbnail.org?width=48&height=44&screen=1024&url=<? echo $currUrl[0] ?>\" alt=\"WebThumb\" width=\"48px\" height=\"44px\" />")
			clearInterval(prev);
		},8000);

    </script>
</body>
</html> 