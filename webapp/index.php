<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs kredd http://www.webappers.com/2012/07/09/30-toolbar-icons-for-user-interface-design/
  ================================================== -->
	<meta charset="utf-8">
	<title>Plan</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />


	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<link rel="stylesheet" type="text/css" href="js/slider/jquery.pageslide.css">
	<link rel="stylesheet" type="text/css" media="screen" href="stylesheets/baesla.css" />
	
	<!-- Scripts
  ================================================== -->
		

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">




</head>
<body >
	<div id="banner">
    	<div id="banner-content">
    		<a href="_meny.php" class="slider"><img src="images/wrench.png" height="64" width="64" alt="token" /></a>
    		<b><strong>Plan</strong></b>
    		<hr></hr>
    	</div>
  	</div>


	<!-- Primary Page Layout
	================================================== -->

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
	 		var js, fjs = d.getElementsByTagName(s)[0];
	 		if (d.getElementById(id)) return;
	 		js = d.createElement(s); js.id = id;
	 		js.src = "//connect.facebook.net/nb_NO/all.js#xfbml=1";
	 		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>


<?php


		switch ($_GET["page"]) {
			case 'hme':
            	include_once('sider/hjem.php');
			break;

			case 'timeplan':
            	include_once('sider/timeplan.php');
			break;

			case 'settings_prf':
            	include_once('sider/settings_profil.php');
			break;

			case 'settings_tmp':
            	include_once('sider/settings_timeplan.php');
			break;

			case 'kontaktliste':
            	include_once('sider/kontaktliste.php');
			break;

			case 'kreditt':
            	include_once('sider/kreditt.php');
			break;

			case 'nam':
            	include_once('sider/404.php');
			break;
			
			default:
           		include_once('sider/hjem.php');
			break;
		}
        
          ?>


<!-- End Document
================================================== -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="js/slider/jquery.pageslide.min.js"></script>
<script type="text/javascript" src="js/bea_tools/bea_tool.js"></script>


	<script>
        /* Default pageslide, moves to the right */
        $(".slider").pageslide();

    </script>

    <script type="text/javascript"> 
    function loggetInn()
    {
    	console.log("1: " + readCookie("c_navn") != null  );
		if(readCookie("c_navn") != null)
		{
			if(readCookie("c_type") == "Klasse")
			{
				document.write(readCookie("c_klasse") );
			}else{
				document.write(readCookie("c_navn") );
			}
		}else{
			document.write("<a href='/webapp/?page=settings_prf'>Logg inn for å bruke tjenesten</a>");
		}
    }
	
	</script>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!-- Scripts
================================================== -->
</body>

<footer>
	<center><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://plan.bevster.net" data-text="Plan" data-lang="no" data-hashtags="AkershusPlan"></a><div class="fb-like" data-href="http://plan.bevster.net/webapp/" data-width="450" data-layout="button_count" data-action="recommend" data-show-faces="false" data-send="true"></div></center>
	<center>Bevster © 2013 | <script type="text/javascript">loggetInn();</script> </center>
	<?php include_once('sider/ads.php'); ?>

</footer>
</html>