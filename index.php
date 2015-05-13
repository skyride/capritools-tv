<?php

include("config.php");

	//Get a list of available streams from the HLS document root
	foreach(glob($hls_location."*.m3u8") as $file) {
		$file = str_replace($hls_location, "", $file);
		$file = str_replace(".m3u8", "", $file);
		$streams[] = $file;
	}
	
	//No streams are live
	if(count($streams) == 0) {
		$options = "";
		$stream = "";
		$page_title = $title;
	}
	
	//One stream is live
	if(count($streams) == 1) {
		$options = '<li class="active"><a href="'.$tv_urn.$streams[0].'">'.$streams[0].'</a></li>';
		$stream = $streams[0];
		$page_title = $title . " - " . $stream;
	}
	
	//Multiple streams are live
	if(count($streams) > 1) {
		//Check if any stream to watch was given in the URN
		if(isset($_GET['stream']) == true) {
			$stream = $_GET['stream'];
		} else {
			$stream = $streams[0];
		}
		
		$page_title = $title . " - " . $stream;
		
		$options = "";
		foreach($streams as $str) {
			if($str == $stream) {
				$options .= '<li class="active"><a href="'.$tv_urn.$str.'">'.$str.'</a></li>';
			} else {
				$options .= '<li><a href="'.$tv_urn.$str.'">'.$str.'</a></li>';
			}
		}
	}
?>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title><?php echo $page_title; ?></title>

	<!-- Latest compiled and minified CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<?php include("switcher.php"); ?>
	<link href="http://vjs.zencdn.net/4.11/video-js.css" rel="stylesheet">
	<script src="http://vjs.zencdn.net/4.11/video.js"></script>
	<script src="videojs-media-sources.js"></script>
	<script src="videojs.hls.min.js"></script>
	
	<!-- Optional theme -->
	<!-- Latest compiled and minified JavaScript -->
	
	<!-- Custom Page CSS -->
</head>
<body>
	
	<nav class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"><?php echo $title; ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php echo $options; ?>
          </ul>
		  
		  <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" onclick="$('#dropdown').toggle();" id="dropdownT" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Themes <b class="caret"></b></a>
					<ul id="dropdown" class="dropdown-menu" role="menu" aria-labelledby="dropdownT">
						<li><a href="/switcher.php?theme=flatly">Flatly (Default)</a></li>
						<li><a href="/switcher.php?theme=darkly">Darkly</a></li>
						<li><a href="/switcher.php?theme=slate">Slate</a></li>
						<li><a href="/switcher.php?theme=cyborg">Cyborg</a></li>
					</ul>
				</li>
			</ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


	<div class="container">
		<div class="starter-template">
				<div align="center">
					<? if(count($streams) > 0) { ?>
						<video id="MY_VIDEO_1" class="video-js vjs-default-skin" controls preload="auto" width="1000" height="625" data-setup="{}">
							<source src="<?php echo $hls_url . $stream; ?>.m3u8" type="application/x-mpegURL"/>
						</video>
					<?php } else { ?>
						<h2> No Streams are live atm ;___;</h2>
					<?php } ?>
				</div>
		</div>
	</div>
</body>
