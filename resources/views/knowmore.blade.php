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
	<h1 class="km-logo"><a href="#">Work<b>Median</b></a></h1>
	<div class="km-navi">
		<a href="{{ url('/login') }}" class="km-navi-login">Log In</a>
		<a href="{{ url('/register') }}" class="km-navi-signup">Sign Up</a>
	</div>
</header>
<section class="km-hero-section">
<img src="{{ my_asset('images/know-img/hero-bg.png') }}" alt="" class="km-imgBg"/>
	<div class="km-container">
		<h2 data-aos="fade-up" data-aos-duration="1200" data-aos-anchor-placement="top-bottom">LET’S CHANGE THE WAY PROFESSIONALS INTERACT</h2>
		<h4 data-aos="fade-up" data-aos-duration="1500" data-aos-anchor-placement="top-bottom">User problem mentioning ( Seeker and provider )</h4>
		<p data-aos="fade-up" data-aos-duration="1800" data-aos-anchor-placement="top-bottom">We end up sharing resume without knowing what happened, <br />we never want to be in that state. Leave the traditional , follow the future </p>
		<div class="km-wmusers">
			<img class="km-imgMaxW" src="{{ my_asset('images/know-img/workmedian-user.png') }}" alt=""/>
		</div>
		<a href="#" data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-bottom" class="km-btn">Get Started</a>
	</div>
</section>
<section class="km-common-section bottom-spaceSec">
	<div class="km-container">
		<div class="km-twoColumn">
			<div class="km-disFlex km-colOrderTwo" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<img class="km-imgMaxW" src="{{ my_asset('images/know-img/seeking-job.png') }}" alt="" />
			</div>
			<div class="km-disFlex km-colOrderOne km-seekingjob" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<h3 class="km-main-title">Seeking job or bored of current one ?</h3>
				<p>Float your Resume , Go faster, easier and traceable</p>
			</div>
		</div>
	</div>
</section>
<section class="km-common-section km-gray-bg km-skew-bg">
	<div class="km-container">
		<div class="km-twoColumn">
			<div class="km-disFlex" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<img class="km-imgMaxW" src="{{ my_asset('images/know-img/recuting.png') }}" alt="" />
			</div>
			<div class="km-disFlex km-seekingjob" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<h3 class="km-main-title">Recruiting best for your organization?</h3>
				<p>Go Faster and easier way to float Resume</p>
			</div>
		</div>
	</div>
</section>
<section class="km-common-section km-skew-minus">
	<div class="km-container">
		<div class="km-twoColumn">
			<div class="km-disFlex km-colOrderTwo" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<img class="km-imgMaxW" src="{{ my_asset('images/know-img/get-happy.png') }}" alt="" />
			</div>
			<div class="km-disFlex km-colOrderOne km-seekingjob" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<h3 class="km-main-title">Let’s do it better</h3>
				<p>An inherent mantra, which triggers solve problems in better way and each day</p>
			</div>
		</div>
	</div>
</section>
<section class="km-common-section km-gray-bg">
	<div class="km-container">
		<h3 class="km-main-title bottom-space">Growth figures</h3>
		<ul class="km-growth">
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<span class="km-growth-num">32,023</span>
				<span class="km-growth-icon"><img src="{{ my_asset('images/know-img//user-icon.png') }}" alt="" /></span>
				<span class="km-growth-title">Users</span>
			</li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<span class="km-growth-num">34</span>
				<span class="km-growth-icon"><img src="{{ my_asset('images/know-img/corporate-icon.png') }}" alt="" /></span>
				<span class="km-growth-title">corporates</span>
			</li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<span class="km-growth-num">23</span>
				<span class="km-growth-icon"><img src="{{ my_asset('images/know-img/companies-icon.png') }}" alt="" /></span>
				<span class="km-growth-title">companies</span>
			</li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom">
				<span class="km-growth-num">4,665</span>
				<span class="km-growth-icon"><img src="{{ my_asset('images/know-img/resuem-icon.png') }}" alt="" /></span>
				<span class="km-growth-title">Resume</span>
			</li>
		</ul>
	</div>
</section>
<section class="km-common-section km-applScre">
	<div class="km-container">
		<h3 class="km-main-title bottom-space">Our Application</h3>
		<div class="km-screens">
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom">Application Screen</li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom">Application Screen</li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom">Application Screen</li>
		</div>
		<a href="#" data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="km-btn">Get Started</a>
	</div>
</section>
<section class="km-common-section km-gray-bg">
	<div class="km-container">
		<h3 class="km-main-title bottom-space">How it work</h3>
		<div class="km-howitwork">Video will here...</div>
	</div>
</section>
<section class="km-common-section">
	<div class="km-container">
		<h3 class="km-main-title">Be part of great team</h3>
		<p class="km-team-para">Problem solving, entrepreneurial , sales acumen</p>
		<div class="km-teams">
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom"><img src="{{ my_asset('images/know-img/team-pic1.jpg') }}" alt="" /></li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom"><img src="{{ my_asset('images/know-img/team-pic2.jpg') }}" alt="" /></li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom"><img src="{{ my_asset('images/know-img/team-pic3.jpg') }}" alt="" /></li>
			<li data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="becomMember">
				<span class="kmQues">?</span>
				<p>If you love to solve problem, then we should connect and know each other better</p>
				<a href="mailto:contact@workmedian.com" class="km-btn">Become A Member</a>
			</li>
		</div>
	</div>
</section>
<section class="km-common-section km-gray-skyblu">
	<div class="km-container">
		<h3 class="km-main-title">Contact us regarding business, parterning, investments</h3>
		<p class="skyblu-para">Drop a mail at <a href="mailto:contact@workmedian.com">contact@workmedian.com</p>
		<a href="mailto:contact@workmedian.com" class="km-btn">Send Us</a>
		<span class="km-teamcontact">Team will get back asap</span>
	</div>
</section>
<footer class="km-footer">
	<div class="km-container">
		<div class="km-footer-row">
			<h3 class="km-main-title">Stay Connected</h3>
			<div class="km-footer-social">
				<!--<a href="#" target="_blank"><img src="img/f-fb-icon.svg" style="" alt="" /></a>
				<a href="#" target="_blank"><img src="img/f-tw-icon.svg" style="" alt="" /></a>
				<a href="#" target="_blank" style="padding-top:5px;"><img src="img/f-yt-icon.svg" alt="" /></a>
				<a href="#" target="_blank"><img src="img/f-li-icon.svg" style="" alt="" /></a>-->
				<a href="#" target="_blank" class="km-foot-fb"><i class="fab fa-facebook-f"></i></a>
				<a href="#" target="_blank" class="km-foot-tw"><i class="fab fa-twitter"></i></a>
				<a href="#" target="_blank" class="km-foot-yt"><i class="fab fa-youtube"></i></a>
				<a href="#" target="_blank" class="km-foot-li"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<div class="km-footer-copRight">Copyrights @2018-19. All Rights Reserved <a href="#">Terms & Condition</a>  |  <a href="#">Privacy Policy</a></div>
		</div>
	</div>
</footer>
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
