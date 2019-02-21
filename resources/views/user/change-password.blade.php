@extends('layouts.app')
@section('content')
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12">
                    <h1>Change password</h1>

                </div>
            </div>
        </div>

    </section>
    <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="medium-center-box">
              <div class="login-form center-align" id="loginDiv"  >
                <form autocomplete="off" action="{{ url('/change-password-save') }}"  name="changePasswordForm" id="changePasswordForm">

                  <div class="input-field">
                    <input id="oldPassword" name="oldPassword" type="password" class="validate" required value="">
                    @if (session()->has('passwordMissmatch'))
                      <span class="validationError" ng-show="changePasswordForm.oldPassword.$pristine">
                        <span>Old password mismatch</span>
                      </span>
                    @endif
                    <label class="active" for="oldPassword">Old password</label>
                  </div>

                  <div class="input-field">
                    <input password-strength id="newPassword" name="newPassword" type="password" class="validate" required value="">
                    <label class="active" for="newPassword">New password</label>
                  </div>

                  <div class="input-field">
                    <input password-match="newPassword" id="confirmPassword" name="confirmPassword" type="password" class="validate" required value="">

                    @if (session()->has('passwordNotMissmatch'))
                      <span class="validationError" ng-show="changePasswordForm.oldPassword.$pristine">
                        <span>Confirm password mismatch</span>
                      </span>
                    @endif

                    <label class="active" for="confirmPassword">Confirm new password</label>
                  </div>


                  <div class="input-field row">
                      <a href="{{ url('/home') }}" id="cancel-password" class="col s6 waves-effect waves-light btn-black">Cancel</a>
                      <input type="submit" class="col s6 waves-effect waves-light btn-blue input-btn" value="Submit" />
                  </div>
                </form>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
  $(document).ready(function(){
    $( "#changePasswordForm" ).validate({
            rules: {
                oldPassword: {required: true },
                newPassword: {required: true,minlength:6},
                confirmPassword: {required: true, equalTo: "#newPassword"}

            },
            messages: {
                oldPassword: {
                    required: "Required",
                },
                newPassword:{
                    required: "Required",
                    minlength: "Minimum password length should be 6 characters"
                },
                confirmPassword: {
                    required: "Required",
                    equalTo: "New password mismatch"
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


<script src="/assets/js/changePasswordStrength.js"></script>
@endsection
