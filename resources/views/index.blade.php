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
  <link href="{{ my_asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ my_asset('css/custom.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ my_asset('css/ak-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900|Open+Sans:400,600,700,800" rel="stylesheet">
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
  <body class="main-container" onload="$('#loading').hide();">
  <div id="loading"></div>
  <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container ak-full-container">
            <div class="center-box">
              <div class="login-form center-align" id="loginDiv"  >
                <div class="logo-wrapper">
                  <img src="{{ my_asset('images/demo-logo.svg') }}" alt="">
                </div>
                <h1 class="home-logo-text ak-logoTxt">Work<b>Median</b></h1>
                <p class="common-para ak-logoslognTxt">Check and keep floating your Resume</p>
                <a href="know-more" class="waves-effect waves-light gray-link display-block ak-homeKnowMore">Know more</a>
				<ul class="ak-user-face ak-homeUser">
                @if($user_counts>0)
                    <?php foreach( $users as $user) { ?>
				    <li><img src="{{get_user_image($user->avatar)}}" alt="{{$user->name}}" /></li>
                    <?php } ?>
                @endif
				</ul>
				<p class="common-para">{{$user_counts}} users</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer id="footer">
        <div class="footer-inner-container pt0">
            <div class="fa-width50">
                <a href="{{ url('/register') }}" class="waves-effect waves-light btn-black display-block w110 fl">Sign up</a>
            </div>
            <div class="fa-width50">
                <a href="{{ url('/login') }}" class="waves-effect waves-light btn-blue w110 fr">Login</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>
  <!--  Scripts-->
  </body>
</html>
