@extends('layouts.app')

@section('content')
<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12">
                <h1>Login</h1>
            </div>
        </div>
    </div>
</section>

<div class="section wrappit">
    <div class="container">

    <div class="center-wrapper" id="heightSet" >
        <div class="center-container">
            <div class="ak-custom-center-box">
                <div class="login-form center-align" id="loginDiv">
                <div class="logo-wrapper">
						  <img src="{{ my_asset('images/demo-logo.svg') }}" alt="">
						</div>
                    <form class="form-horizontal mb15 no-card" role="form" method="POST" action="{{ url('/login') }}" ng-app="loginFormApp" ng-controller="validateCtrl" name="loginForm" id="loginForm">
                        {{ csrf_field() }}
                        @if ($errors->has('email'))
                        @if($errors->first('email')  == "These credentials do not match our records.")
                                  <script>
                                  $.notify({title :'', content:"Incorrect user mail or password", timeout:5000});
                                  </script>
                                @else
                            <div class="alert alert-danger" role="alert">

                                    {{$errors->first('email')}}

                            </div>
                            @endif
                            <script>
                                setTimeout(function(){
                                    $('.alert-danger').slideUp();
                                }, 5000);
                            </script>
                        @endif

                        @if ($errors->has('password'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('password') }}
                            </div>
                            <script>
                                setTimeout(function(){
                                    $('.alert-danger').slideUp();
                                }, 5000);
                            </script>
                        @endif
                        <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email"  name="email" value="{{ old('email') }}" validate-email class="emailvalidate">

                            <label for="email" class="active">Enter email</label>
                        </div>

                        <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" name="password" >

                            <label for="password" class="active">Enter password</label>
                        </div>

                        <div class="input-field">
                            <input type="submit" class="waves-effect waves-light input-btn display-block alpha btn-blue" value="Login" >
                        </div>
                    </form>
                    <div class="link-container cf p-0">
                        <a class="blue-link m-0" href="{{ url('/forgot-password') }}">Forgot password ?</a>
                    </div>
                    <div class="socialmedia-login-label">
                        <label for="">Sign in fast by Social Connects below</label>
                    </div>
                    <div class="socialmedia-logins">
                        <div class="link-container">
                            <a class="waves-effect waves-light display-block" href="{{ url('/login/google') }}">
                                <img src="{{my_asset('images/google.png')}}">
                            </a>
                        </div>
                        <div class="link-container">
                            <a class="waves-effect waves-light display-block" href="{{ url('/login/linkedin') }}">
                                <img src="{{my_asset('images/linkedin.png')}}">
                            </a>
                        </div>
                        <div class="link-container">
                            <a class="waves-effect waves-light display-block" href="{{ url('/login/facebook') }}">
                                <img src="{{my_asset('images/facebook.png')}}">
                            </a>
                        </div>
                    </div>


                    <div class="link-container">
                        <a href="{{ url('/register') }}" class="waves-effect waves-light btn-black display-block">New user ? Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("body").addClass("no-card-container");
    });
</script>
<script type="text/javascript">
    var app = angular.module('loginFormApp', []);
    app.controller('validateCtrl', function($scope) {});
    app.directive('validateEmail', function() {
      var EMAIL_REGEXP = /^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;

      return {
        require: 'ngModel',
        restrict: '',
        link: function(scope, elm, attrs, ctrl) {
          // only apply the validator if ngModel is present and Angular has added the email validator
          if (ctrl && ctrl.$validators.email) {

            // this will overwrite the default Angular email validator
            ctrl.$validators.email = function(modelValue) {
              return ctrl.$isEmpty(modelValue) || EMAIL_REGEXP.test(modelValue);
            };
          }
        }
      };
    });

</script>

<script type="text/javascript">
    $(document).ready(function() {
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Please enter alpha numeric value only.");
        $.validator.setDefaults({
            ignore: [],
            onfocusout: function () { return true; }
        });

        $( "#loginForm" ).validate({
            rules: {
                email: {required: true,email: true },
                password: {required: true}

            },
            messages: {
                email: {
                    required: "Required",
                    email: "Enter valid email"
                },
                password:{
                    required: "Required"
                }
            },
            errorClass: 'validationError',
            errorElement : 'span',
            //errorLabelContainer: '.validationError',
            errorPlacement: function( error, element ) {
                error.insertAfter( element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents("span").addClass(errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents("span").removeClass(errorClass);
            }
        });


    });

    $(function() {
      $("#email").focus();
    });
</script>
@endsection
