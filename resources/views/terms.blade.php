<!DOCTYPE html>
<html lang="en">
<head>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>WorkMedian - Build effective resume to share in professionals and recruiters network</title>
  <link rel="shortcut icon" href="images/favicon.png?v=1.0">
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{ my_asset('css/know-more.css') }}">

  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900|Open+Sans:400,600,700,800" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <style>
  #loading {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }

        /* Add animation to “page content” */
        .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 }
        to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom {
        from{ bottom:-100px; opacity:0 }
        to{ bottom:0; opacity:1 }
        }

        #myDiv {
        display: none;
        text-align: center;
        }
</style>
</head>
  <body class="main-container" onload=" $('#loading').hide();">
  <div id="loading"></div>
<header class="km-header">
	<h1 class="km-logo"><a href="{{ url('/home') }}">Work<b>Median</b></a></h1>
	<div class="km-navi">
		<a href="{{ url('/login') }}" class="km-navi-login">Log In</a>
		<a href="{{ url('/register') }}" class="km-navi-signup">Sign Up</a>
	</div>
</header>


<section class="km-common-section">
	<div class="km-container">
		<h3 class="km-main-title">Terms and conditions</h3>
		<p class="km-team-para">some text</p>

	</div>
</section>


<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
	duration: 1000,
    //easing: 'ease-in-out-back'
  });
</script>
<script>
$(window).scroll(function() {
    var scroll = $(window).scrollTop();
	if (scroll >= 70) {
        $(".km-header").addClass("km-header-dark");
    }
	else {
        $(".km-header").removeClass("km-header-dark");
    }
});
</script>
 </body>
</html>
