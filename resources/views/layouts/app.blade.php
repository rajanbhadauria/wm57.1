<!--<!DOCTYPE html>-->
<html lang="en">
<head>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0"/>
  <title>WorkMedian - Build and float your resume</title>
  <link rel="shortcut icon" href="images/favicon.png?v=1.0">
  <meta name="_token" content="{!! csrf_token() !!}" />
  <!-- Fonts  -->
    <script>
        var BASE_URL = "{{url('/')}}";
    </script>
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
<!-- CSS  -->
  <link href="{{ my_asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ my_asset('css/materialize.min.css') }}" rel="stylesheet">

  <link href="{{ my_asset('css/user-menu.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!--  <link href="css/chosen.css" rel="stylesheet" type="text/css"/>-->
  <link href="{{ my_asset('css/select3.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ my_asset('css/custom.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ my_asset('css/main.css') }}" type="text/css" rel="stylesheet"/>
  <link href="{{ my_asset('css/ak-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900|Open+Sans:400,600,700,800" rel="stylesheet">
  <link href="{{ my_asset('notify/notify.css') }}" rel="stylesheet">
  <!-- File Upload -->


  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="{{ my_asset('js/jquery.mask.js') }}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ my_asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ my_asset('js/select3-full.js') }}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ my_asset('js/tgn.js') }}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ my_asset('notify/jquery.notify.js')}}"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script>

  <style type="text/css">
    .password-strength-indicator {
      position: absolute;
      top: 10px;
      right: 0;
      width: 5px;
      padding: 0 15px;
    }
    .password-strength-indicator span {
        display: block;
        width: 5px;
        height: 5px;
        margin-bottom: 2px;
        background: #ebeef1;
        border-radius: 5px;
    }
    .successMessage{
      position: fixed;
      top:50px;
      right:50px;
      background-color: #090;
      color: #FFF;
      padding: 10 20px;
      border-radius: 20px;
    }
    .select-wrapper .validationError,#fixSalaryType  .validationError{bottom: -16px;}

    #loading {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 100;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #CFCFCF;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        opacity: .5;
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


<body id="app-layout">
<div id="loading"></div>
<div id="mask-div" style="display: none">
<!-- <img src="{{my_asset('images/loader.gif')}}" alt="Loading ....."> -->
    @include("layouts.include.header")
    @include("layouts.include.nav")
    @if(session('success'))
    <div class="container">
    <script>
    $.notify({ content:" {{session('success')}}", timeout:0});
    </script>
    </div>
    @endif

    @yield('content')
</div>
      <script type="text/javascript" src="{{ my_asset('js/materialize.min.js') }}"></script>
      <script type="text/javascript" src="{{ my_asset('js/menu-backdrop.js') }}"></script>
      <script type="text/javascript" src="{{ my_asset('js/init.js') }}"></script>
      <script type="text/javascript" src="{{ my_asset('js/main.js') }}"></script>

      <?php $resize = true; ?>
<script>
$(document).ready(function(){
    $('#loading').hide();
    $('#mask-div').show();
});
</script>

</body>
</html>
