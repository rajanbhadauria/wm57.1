@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=current-address');
    }
} else {
    $redirectBack = URL::to('update?sectionid=current-address');
}
?>
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Update current address</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="CurrentAddressFromApp">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row mb20">
                        <div class="">
                            <form action="{{URL::to('update/current-address-save')}}" method="POST" id="currentAddressForm" name="currentAddressForm" >
                            {{ csrf_field() }}
                                <div class="input-field custom-form">
                                    <input id="houseNumber" name="houseNumber" type="text" class="validaddress fourlength validate" value="{{isset($currentAddress['houseNumber'])?$currentAddress['houseNumber']:''}}"
                                    	required
                                    	ng-model="houseNumber"
                                    >
                                    <label for="houseNumber" ng-class="{ active:  houseNumber }">Room / Flat / House number</label>
                                </div>
                                <div class="input-field custom-form" ng-class="{true: 'error'}[submitted && form.blockSector.$invalid]">
                                    <input id="blockSector" name="blockSector" type="text" class="validaddress fourlength validate" value="{{isset($currentAddress['blockSector'])?$currentAddress['blockSector']:''}}"
                                    	required
                                    	ng-model="blockSector"
                                    >
                                    <label for="blockSector" ng-class="{ active:  blockSector }">Block / Sector</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="societyName" name="societyName" type="text" class="alphanumeric fourlength validate" value="{{isset($currentAddress['societyName'])?$currentAddress['societyName']:''}}"
                                    	required
                                    	ng-model="societyName"
                                    >
                                    <label for="societyName" ng-class="{ active:  societyName }">Building / Locality / Society name</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="landmark" name="landmark" type="text" class="alphanumeric fourlength validate" value="{{isset($currentAddress['landmark'])?$currentAddress['landmark']:''}}"
                                    	ng-model="landmark"
                                    >
                                    <label for="landmark" ng-class="{ active:  landmark }">Road / Landmark</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="area" name="area" type="text" class="validate" value="{{isset($currentAddress['area'])?$currentAddress['area']:''}}"
                                    	required
                                    	ng-model="area"
                                    >
                                    <label for="area" ng-class="{ active:  area }">Area name</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="pincode" name="pincode" type="text" class="alphanumeric validate"  value="{{isset($currentAddress['pincode'])?$currentAddress['pincode']:''}}"
                                    	ng-model="pincode"
                                        maxlength="6"
                                    >
                                    <label for="pincode" ng-class="{ active:  pincode }">Area pin code</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="city" name="city" type="text" class="alpha fourlength validate"  value="{{isset($currentAddress['city'])?$currentAddress['city']:''}}"
                                    	required
                                    	ng-model="city"
                                    >
                                    <label for="city" ng-class="{ active:  city }">City</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="country" name="country" type="text" class="alpha fourlength validate"  value="{{isset($currentAddress['country'])?$currentAddress['country']:''}}"
                                    	required
                                    	ng-model="country"
                                    >
                                    <label for="country" ng-class="{ active:  country }">Country</label>
                                </div>

                                <div class="row">
                                    @if(isset($currentAddress['id']) && $currentAddress['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif
                                    <div class="col s6 pr0 custom-submit">
                                    	<input type="hidden" name="id" id="id" value="{{isset($currentAddress['id'])?$currentAddress['id']:''}}">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save" ng-click="submitted=true"/>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>

	$(document).ready(function() {

        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Please enter alpha numeric value only.");
        $.validator.setDefaults({
            ignore: [],
            onfocusout: function () { return true; }
        });

        $( "#currentAddressForm" ).validate({
            rules: {
                houseNumber: { required: true, alphanumeric:true },
                blockSector: { required: true, alphanumeric:true },
                societyName: { required: true, alphanumeric:true },
                //area: { required: true},
                level: { alphanumeric:true },
                pincode: { required:true,alphanumeric:true },
                city: { required:true, alphanumeric:true  },
                country: { required:true, alphanumeric:true  }

            },
            messages: {

                houseNumber: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                blockSector: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                societyName: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                //area: {
                //    required: "Required"
                //},
                pincode: {
                    required: "Required",
                    number: "Please enter alpha numeric value only."
                },
                city: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                country: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
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
            },
            submitHandler: function(form) {
                event.preventDefault();
                console.log($(this).attr("action"));
                $.ajax({
                    type:"POST",
                    url:$("#currentAddressForm").attr("action"),
                    data:$("#currentAddressForm").serialize(),
                    success: function(response){
                        console.log(response);
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });
        /*$("#currentAddressForm").submit(function( event ) {
            event.preventDefault();
            $.ajax({
                type:"POST",
                url:$(this).attr("action"),
                data:$(this).serialize(),
                success: function(response){
                    console.log(response);
                    window.location.href = "{{$redirectBack}}";
                }
            });
        });*/

        @if(isset($currentAddress['id']) && $currentAddress['id']!='')


        $("#remove").on("click", function(event){
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/current-address/remove')}}/"+$("#id").val(),
                    data:$(this).serialize(),
                    success: function(response){
                        if(response.error == 0){
                            window.location.href = "{{$redirectBack}}";
                        }
                    }
                });

            }
        });
        @endif

    });


/*var app = angular.module('CurrentAddressFromApp', []);

function getCurrentAddressDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-current-address-details')}}")
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.currentAddress.id);
                $scope.houseNumber 	= response.data.currentAddress.houseNumber;
                $scope.blockSector 	= response.data.currentAddress.blockSector;
                $scope.societyName 	= response.data.currentAddress.societyName;
                $scope.landmark    	= response.data.currentAddress.landmark;
                $scope.area 		= response.data.currentAddress.area;
                $scope.pincode 		= response.data.currentAddress.pincode;
                $scope.city 		= response.data.currentAddress.city;
                $scope.country 		= response.data.currentAddress.country;

                $("#cancel").hide();
                $("#remove").show();
            }
            console.log(response)
        });
    });
}*/

getCurrentAddressDetails();
</script>
@endsection
