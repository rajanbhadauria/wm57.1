@extends('layouts.app')

@section('content')
<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12">
					<h1>Forgot password ?</h1>
				</div>
			</div>
		</div>
	</section>
    <div class="section wrappit ng-scope" ng-app="resetEmailFormApp" ng-controller="validateCtrl">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="ak-custom-center-box">
                    <div class="login-form" id="loginDiv">
                        <div class="ak-comn-title">Enter your registered email to receive password reset link</div>

						<form method="POST" action="{{ route('password.email') }}" id="resetPassword">
                        @csrf
                            <div class="input-field">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' ng-invalid' : '' }} ng-pristine ng-empty ng-valid-email ng-invalid-required ng-touched" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block validationError">
                                        Use valid active email
                                    </span>
                                @endif
                                <span class="validationError ng-hide" ng-show="resetEmailForm.email.$dirty &amp;&amp; resetEmailForm.email.$invalid">
                                    <span ng-show="resetEmailForm.email.$error.required">Enter valid registered email</span>
                                    <span ng-show="resetEmailForm.email.$error.email" class="ng-hide">Enter valid registered email</span>
                                </span>
                                <label for="email" class="col-md-4 control-label ">Enter your email</label>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <i class="waves-effect waves-light btn-blue input-btn display-block waves-input-wrapper" style=""><input type="submit" class="waves-button-input" value="Send password reset link" ng-disabled="resetEmailForm.$invalid" disabled="disabled"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	<script type="text/javascript">
		var app = angular.module('resetEmailFormApp', []);
		app.controller('validateCtrl', function($scope) {});
            $(document).ready(function(){
            $( "#resetPassword" ).validate({
                    rules: {
                        email: {required: true,email:true },
                    },
                    messages: {
                        email: {
                            required: "Required",
                            email: "Enter valid email"
                        },
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
	</script>

@endsection
