@extends('layouts.app')
@section('content')
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12">
                    <h1>Change password</h1>
                    @if (session()->has('success'))
                      <span class="successMessage">Pasword updated</span>
                    @endif
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
                <form action="{{ url('/change-password-save') }}" ng-app="changePasswordFormApp" ng-controller="validateCtrl" name="changePasswordForm">
                  
                  <div class="input-field">
                    <input id="oldPassword" name="oldPassword" type="password" class="validate" ng-model="oldPassword" required value="">
                    @if (session()->has('passwordMissmatch'))
                      <span class="validationError" ng-show="changePasswordForm.oldPassword.$pristine">
                        <span>Old password mismatch</span>
                      </span>
                    @endif
                    <span class="validationError" ng-show="changePasswordForm.oldPassword.$dirty && changePasswordForm.oldPassword.$invalid">
                      <span ng-show="changePasswordForm.oldPassword.$error.required">Old password is required</span>
                    </span>
                    <label class="active" for="oldPassword">Old password</label>
                  </div>

                  <div class="input-field">
                    <input password-strength id="newPassword" name="newPassword" type="password" class="validate" ng-model="newPassword" ng-model-options="{ updateOn: 'blur' }" required value="">
                    <span class="validationError" ng-show="changePasswordForm.newPassword.$dirty && changePasswordForm.newPassword.$invalid">
                      <span ng-show="changePasswordForm.newPassword.$error.required">New password required</span>
                    </span>
                    <label class="active" for="newPassword">New password</label>
                  </div>

                  <div class="input-field">
                    <input password-match="newPassword" id="confirmPassword" name="confirmPassword" type="password" class="validate" ng-model="confirmPassword" ng-model-options="{ updateOn: 'blur' }" required value="">
                    
                    @if (session()->has('passwordNotMissmatch'))
                      <span class="validationError" ng-show="changePasswordForm.oldPassword.$pristine">
                        <span>Confirm password mismatch</span>
                      </span>
                    @endif
                    <span class="validationError" ng-show="changePasswordForm.confirmPassword.$dirty && changePasswordForm.confirmPassword.$invalid">
                      <span ng-show="changePasswordForm.confirmPassword.$error.required">confirm password is required.</span>
                      <span ng-show="changePasswordForm.confirmPassword.$dirty">Confirm password must match</span>                      
                    </span>
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
  var app = angular.module('changePasswordFormApp', []);
  app.controller('validateCtrl', function($scope) {
    
      
  }).directive('passwordMatch', function() {
    return {
      require: 'ngModel',
      scope: {
        otherModelValue: '=passwordMatch'
      },
      link: function(scope, element, attributes, ngModel) {
        ngModel.$validators.compareTo = function(modelValue) {
          return modelValue === scope.otherModelValue;
        };
        scope.$watch('otherModelValue', function() {
          ngModel.$validate();
        });
      }
    };
  });
</script>

<script src="/assets/js/changePasswordStrength.js"></script>
@endsection