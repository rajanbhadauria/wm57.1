@extends('layouts.app')

@section('content')
<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12">
					<h1>Create an account</h1>
				</div>
			</div>
		</div>
</section>
<div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
            <div class="center-container">
                <div class="ak-custom-center-box">
                    <div class="login-form" id="loginDiv">
                    <div class="logo-wrapper">
						  <img src="{{ my_asset('images/demo-logo.svg') }}" alt="">
						</div>
                        <form class="form-horizontal no-card" autocomplete="off" role="form" method="POST" action="{{ url('/register') }}" name="signUpForm" id="signUpForm">
                            {{ csrf_field() }}

                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control emailvalidate" name="email" value="{{ old('email') }}" >
                                @if ($errors->has('email'))
                                    <span class="help-block validationError">
                                        <strong>Email has already been taken, use your email for account registration</strong>
                                    </span>
                                @endif
                                <label for="email" class="col-md-4 control-label active">Enter your email</label>
                            </div>

                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input password-strength id="password" type="password" class="form-control" name="password" ng-model="password"

                                    ng-minlength="6"
                                    <?php //ng-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,}$/" ?>
                                    >
                                @if ($errors->has('password'))
                                    <span class="help-block validationError">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <label for="password" class="col-md-4 control-label">Keep password</label>
                            </div>

                            <div class="row mb0">
                                <div class="col s6 r600pl0">
                                    <div class="input-field{{ $errors->has('first_name') ? ' has-error' : '' }}">

                                        <input id="first_name" type="text" class="form-control alpha" name="first_name" value="{{ old('first_name') }}" maxlength="20" ng-model="first_name"
                                        ng-pattern="/^[a-zA-Z]*$/"
                                        >
                                        @if ($errors->has('first_name'))
                                            <span class="help-block validationError">
                                                <strong>Enter first name</strong>
                                            </span>
                                        @endif

                                        <label for="first_name" class="col-md-4 control-label"> First name</label>
                                    </div>
                                </div>


                                <div class="col s6 r600pr0">
                                    <div class="input-field{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <input id="last_name" type="text" class="form-control alpha" name="last_name" value="{{ old('last_name') }}" maxlength="20"  ng-model="last_name"

                                        >

                                        <label for="last_name" class="col-md-4 control-label"> Last name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="input-field">
                                <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block alpha" value="Sign up" >


<!--                                <button type="submit" class="btn btn-black" style="width:100%" ng-disabled="signUpForm.email.$dirty && signUpForm.email.$invalid || signUpForm.password.$dirty && signUpForm.password.$invalid || signUpForm.first_name.$dirty && signUpForm.first_name.$invalid || signUpForm.$invalid">
                                    SIGN UP
                                </button>-->
                            </div>

                            <div class="link-container blue-text">
                                <label for="accept">By logging in, you (user) agree to WorkMedian's <a class="blue-link link-underline fln " href="term.html">Terms</a> and <a class="blue-link link-underline fln" href="term.html">Policy</a></label>
                            </div>

                        </form>
                        <div class="link-container">
                            <a href="{{ url('/login') }}" class="waves-effect waves-light btn-black display-block">Already a user ? Login</a>
                        </div>
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

    $(document).ready(function() {
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Please enter alpha numeric value only.");
        $.validator.setDefaults({
            ignore: [],
            onfocusout: function () { return true; }
        });

        $( "#signUpForm" ).validate({
            rules: {
                email: {required: true,email: true },
                password: {required: true,minlength:6},
                first_name: {required: true}

            },
            messages: {
                email: {
                    required: "Required",
                    email: "Enter valid email"
                },
                password:{
                    required: "Required",
                    minlength: "Minimum length should be 6 char"
                },
                first_name: {
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

    /*var app = angular.module('signUpFormApp', []);
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
    });*/

</script>
<script src="{{my_asset('assets/js/signupPasswordStrength.js')}}"></script>
@endsection
