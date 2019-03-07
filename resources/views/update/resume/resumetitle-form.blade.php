@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=resumetitleInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=resumetitleInfo');
}
?>

<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1> @if(isset($resume_title['id'])) Update @else Add @endif Resume title and cover note</h1>
                    <ul class="panel-actions resumebox-actions pull-right">
                            <li>
                                <a href="{{url('/update')}}" class="text-primary"><i class="tiny material-icons">edit</i></a>
                            </li>
                            <li><a href="{{url('resume/view')}}" class="text-primary"><i class="small-text material-icons">picture_in_picture</i></a></li>
                        </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="ResumeTitleFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row mb20">
                        <div class="">
                            <form action="{{URL::to('update/resume-title-save')}}" method="POST" id="resumeTitleForm" name="resumeTitleForm">
                            {{ csrf_field() }}

                            <div class="input-field custom-form">
                                <input id="resume_title" name="resume_title"
                                    value="{{isset($resume_title['resume_title'])?$resume_title['resume_title']:''}}"
                                    data-length="50"
                                    ng-model="resume_title"
                                    ng-maxlength="50"
                                    type="text">

                                <label for="resume_title" ng-class="{ active:  resume_title }" >Resume title <span>*</span></label>
                            </div>
                                <div class="input-field custom-form">
                                    <textarea id="resume_brand" name="resume_brand"
                                        value="{{isset($resume_title['resume_brand'])?$resume_title['resume_brand']:''}}"
                                        data-length="200"

                                        ng-model="resume_brand"

                                        ng-maxlength="200"
                                    ></textarea>
                                    <label for="resume_brand" ng-class="{ active:  resume_brand }" >Brand yourself , mention what are you passionate about</label>
                                </div>

                                <div class="input-field custom-form">
                                    <textarea id="resume_message" name="resume_message"
                                    value="{{isset($resume_title['resume_message'])?$resume_title['resume_message']:''}}"
                                    ng-maxlength="200"
                                    data-length="200"
                                    ng-model="resume_message"
                                    ></textarea>
                                    <label for="resume_message" ng-class="{ active:  resume_message }">Why do you fit for the job you are appling for</label>
                                </div>
                                <div class="input-field custom-form">
                                    <textarea id="thanks_note" name="thanks_note"
                                    value="{{isset($resume_title['thanks_note'])?$resume_title['thanks_note']:''}}"
                                    ng-maxlength="200"
                                    data-length="200"
                                    ng-model="thanks_note"
                                    ></textarea>
                                    <label for="thanks_note" ng-class="{ active:  thanks_note }">Closing message and thank employer for the job opportunity</label>
                                </div>

                                <div class="row">
                                    @if(isset($resume_title['id']) && $resume_title['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pr0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif

                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{isset($resume_title['id'])?$resume_title['id']:''}}">
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

        $( "#resumeTitleForm" ).validate({
            rules: {
                resume_title: {required: true, maxlength:50},
                resume_brand: { maxlength:200, minlength:50},
                resume_message: {maxlength:200},
                thanks_note: {maxlength:200},

            },
            messages: {
                resume_title: {
                    required: "Required",
                    maxlength: "Max length should be 50 characters",
                    //minlength: "Minimum length should be 25 characters"
                },
                // resume_brand: {
                //     required: "Required",
                //     maxlength: "Max length should be 200 characters",
                //     minlength: "Minimum length should be 50 characters"
                // },
                resume_message: {
                    maxlength: "Max length should be 200 characters",
                },
                thanks_note: {
                    maxlength: "Max length should be 200 characters",
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
                var formData = $('#resumeTitleForm').serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    url:$("#resumeTitleForm").attr("action"),
                    data:formData,
                    success: function(response){
                        window.location.href = "{{url($return_url)}}";
                    }
                });
            }
        });

        @if(isset($resume_title['id']) && $resume_title['id']!='')
        $("#remove").on("click", function(event){
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/resume-title/remove')}}/"+$("#id").val(),
                    data:formData,
                    success: function(response){
                        if(response.error == 0){
                            window.location.href = "{{url($return_url)}}";
                        }
                    }
                });

            }
        });
        @endif
    });
</script>

<script>
var app = angular.module('ResumeTitleFromApp', []);

function getResumeTitleDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-resume-title-details')}}",{"_token": "{{ csrf_token()}}"})
        .then(function(response) {
                if(response.data.error == false){
                $('#id').val(response.data.resumetitle.id);
                $scope.resume_title = response.data.resumetitle.resume_title;
                $scope.resume_brand = response.data.resumetitle.resume_brand;
                $scope.resume_message = response.data.resumetitle.resume_message;
                $scope.thanks_note = response.data.resumetitle.thanks_note;
                $("#cancel").hide();
                $("#remove").show();
            }
            console.log(response)
        });
    });
}

getResumeTitleDetails();

</script>

@endsection
