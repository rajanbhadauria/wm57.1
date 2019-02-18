@extends('layouts.app')
@section('content')

<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12">
                    <h1>{{ __('Reset Password') }}</h1>
                </div>
            </div>
        </div>
    </section>
	<div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="ak-custom-center-box">
              <div class="login-form center-align" id="loginDiv"  >
                <div class="ak-comn-title">Reset your password</div>
                <form method="POST" action="{{ route('password.update') }}" id="restPasswordForm">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                  <div class="input-field">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                                    <span class="help-block validationError">
                                        <strong>Use valid active email</strong>
                                    </span>
                                @endif
                  <label class="" for="email">Email</label>
                  </div>

                  <div class="input-field">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                  @if ($errors->has('password'))
                                    <span class="help-block validationError">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    <label class="" for="newPassword">Password</label>
                  </div>

                  <div class="input-field">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                  @if ($errors->has('password_confirmation'))
                    <span class="help-block validationError">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                    <label class="" for="confirmPassword">Confirm Password</label>
                  </div>


                  <div class="row">
                      <div class="col s6 pl0">
						<a href="{{url('/')}}" id="cancel-password" class="waves-effect waves-light btn-black display-block">Cancel</a>
                      </div>
					  <div class="col s6 pl0">
						<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper display-block" style="">
                        <input type="submit" class="waves-button-input" value="Change password"></i>
						</div>
                  </div>
                </form>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<script>
$(document).ready(function(){
    $( "#restPasswordForm" ).validate({
            rules: {
                email: {required: true,email:true },
                password: {required: true,minlength:6},
                password_confirmation: {required: true,minlength:6, equalTo: "#password"}

            },
            messages: {
                email: {
                    required: "Required",
                    email: "Enter vaild email"
                },
                password:{
                    required: "Required",
                    minlength: "Minimum length should be 6 char"
                },
                password_confirmation: {
                    required: "Required",
                    equalTo: "Confirm password must be same as new password"
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
</script>
@endsection
