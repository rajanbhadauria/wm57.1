@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=objectiveInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=objectiveInfo');
}
?>

<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Add objective</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="ObjectiveFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row mb20">
                        <div class="">
                            <form action="{{URL::to('update/objective-save')}}" method="POST" id="objectiveForm" name="objectiveForm">
                            {{ csrf_field() }}
                                <div class="input-field custom-form">
                                    <textarea id="objective" name="objective" class="" data-length="200"
                                        required
                                        ng-model="objective"
                                        ng-minlength="50"
                                        ng-maxlength="200"
                                        value="{{isset($objective['objective'])?$objective['objective']:''}}"

                                    ></textarea>

                                    <label for="Objective" ng-class="{ active:  objective }" >Objective <span>*</span></label>
                                </div>

                                <div class="row">
                                    @if(isset($objective['id']) && $objective['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pr0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif

                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{isset($objective['id'])?$objective['id']:''}}">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save" >
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

        $( "#objectiveForm" ).validate({
            rules: {
                objective: {required: true, maxlength:200, minlength:50}
            },
            messages: {
                objective: {
                    required: "Required",
                    maxlength: "Characters should not be greater than 200.",
                    maxlength: "Enter Objective with more than 50 characters "
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
                    url:$("#objectiveForm").attr("action"),
                    data:$("#objectiveForm").serialize(),
                    success: function(response){
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });

       /* $("#objectiveForm").submit(function( event ) {
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

       // $("#remove").hide();

        @if(isset($objective['id']) && $objective['id']!='')
        $("#remove").on("click", function(event){
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/objective/remove')}}/"+$("#id").val(),
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
</script>

<script>
var app = angular.module('ObjectiveFromApp', []);

function getObjectiveDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-objective-details')}}",{"_token": "{{ csrf_token()}}"})
        .then(function(response) {
                if(response.data.error == false){
                $('#id').val(response.data.objective.id);
                $scope.objective = response.data.objective.objective;
                $("#cancel").hide();
                $("#remove").show();
            }
            console.log(response)
        });
    });
}

getObjectiveDetails();

</script>

@endsection
