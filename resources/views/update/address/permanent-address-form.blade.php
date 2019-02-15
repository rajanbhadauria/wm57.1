@extends('layouts.app')
@section('content')

<?php 
// This section is for redirect back 

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=permanent-address');
    }
} else {
    $redirectBack = URL::to('update?sectionid=permanent-address');
}
?>
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Update permanent address</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="PermanentAddressFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row mb20">
                        <div class="">
                            <form action="{{URL::to('update/permanent-address-save')}}" method="POST" id="permanentAddressForm" name="permanentAddressForm" novalidate>
                                
                                <div class="input-field custom-form">
                                    <input id="houseNumber" name="houseNumber" type="text" class="validaddress fourlength validate" value="{{isset($permanentAddress['houseNumber'])?$permanentAddress['houseNumber']:''}}"
                                    	required 
                                    	ng-model="houseNumber"
                                    >
                                    <label for="houseNumber" ng-class="{ active:  houseNumber }">Room / Flat / House number</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="blockSector" name="blockSector" type="text" class="alphanumeric fourlength validate" value="{{isset($permanentAddress['blockSector'])?$permanentAddress['blockSector']:''}}"
                                    	required 
                                    	ng-model="blockSector"
                                    >
                                    <label for="blockSector" ng-class="{ active:  blockSector }">Block / Sector</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="societyName" name="societyName" type="text" class="alphanumeric fourlength validate" value="{{isset($permanentAddress['societyName'])?$permanentAddress['societyName']:''}}"
                                    	required 
                                    	ng-model="societyName"
                                    >
                                    <label for="societyName" ng-class="{ active:  societyName }">Building / Locality / Society name</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="landmark" name="landmark" type="text" class="alphanumeric fourlength validate" value="{{isset($permanentAddress['landmark'])?$permanentAddress['landmark']:''}}"
                                    	ng-model="landmark"
                                    >
                                    <label for="landmark" ng-class="{ active:  landmark }">Road / Landmark</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="area" name="area" type="text" class="validate" value="{{isset($permanentAddress['area'])?$permanentAddress['area']:''}}"
                                    	required 
                                    	ng-model="area"
                                    >
                                    <label for="area" ng-class="{ active:  area }">Area name</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="pincode" name="pincode" type="text" class="alphanumeric validate"  value="{{isset($permanentAddress['pincode'])?$permanentAddress['pincode']:''}}"
                                    	ng-model="pincode"
                                    >
                                    <label for="pincode" ng-class="{ active:  pincode }">Area pin code</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="city" name="city" type="text" class="alphanu fourlength validate"  value="{{isset($permanentAddress['city'])?$permanentAddress['city']:''}}"
                                    	required 
                                    	ng-model="city"
                                    >
                                    <label for="city" ng-class="{ active:  city }">City</label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="country" name="country" type="text" class="alpha fourlength validate"  value="{{isset($permanentAddress['country'])?$permanentAddress['country']:''}}"
                                    	required 
                                    	ng-model="country"
                                    >
                                    <label for="country" ng-class="{ active:  country }">Country</label>
                                </div>
                                                                                                
                                <div class="row">
                                    @if(isset($permanentAddress['id']) && $permanentAddress['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif
                                    <div class="col s6 pr0 custom-submit">
                                    	<input type="hidden" name="id" id="id" value="{{isset($permanentAddress['id'])?$permanentAddress['id']:''}}">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save" ng-disabled="permanentAddressForm.$invalid" />
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

        $( "#permanentAddressForm" ).validate({
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
                    //required: "Required"
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
                    url:$("#permanentAddressForm").attr("action"),
                    data:$("#permanentAddressForm").serialize(),
                    success: function(response){
                        console.log(response);
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });
        /*$("#permanentAddressForm").submit(function( event ) {
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

        @if(isset($permanentAddress['id']) && $permanentAddress['id']!='')


        $("#remove").on("click", function(event){
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/permanent-address/remove')}}/"+$("#id").val(),
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
/*

var app = angular.module('PermanentAddressFromApp', []);

function getPermanentAddressDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-permanent-address-details')}}")
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.permanentAddress.id);
                $scope.houseNumber 	= response.data.permanentAddress.houseNumber;
                $scope.blockSector 	= response.data.permanentAddress.blockSector;
                $scope.societyName 	= response.data.permanentAddress.societyName;
                $scope.landmark    	= response.data.permanentAddress.landmark;
                $scope.area 		= response.data.permanentAddress.area;		
                $scope.pincode 		= response.data.permanentAddress.pincode;
                $scope.city 		= response.data.permanentAddress.city;
                $scope.country 		= response.data.permanentAddress.country;
                $("#cancel").hide();
                $("#remove").show();
            }
            console.log(response)
        });
    });
}

getPermanentAddressDetails();
*/
</script>
@endsection