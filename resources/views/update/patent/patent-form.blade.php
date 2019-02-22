@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=patentInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=patentInfo');
}
?>


    <section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Add patent</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="PatentFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row">
                        <div class="">
                            <form action="{{URL::to('update/patent-save')}}" method="POST" id="patentForm" name="patentForm" novalidate>

                                <div class="input-field custom-form">
                                    <input id="patent" name="patent" type="text" class="alphanumeric fourlength validate" value="{{isset($patent['patent'])?$patent['patent']:''}}"
                                        required
                                    >
                                    <label for="patent" ng-class="{ active:  patent }">Project name <span>*</span></label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="reference" name="reference" type="text" class="alphanumeric fourlength" value="{{isset($patent['reference'])?$patent['reference']:''}}"
                                        ng-model="reference"
                                    >
                                    <label for="reference" ng-class="{ active:  reference }">Patent number / reference </label>
                                </div>


                                <div class="input-field custom-form">
                                    <input id="status" name="status" type="text" class="" value="{{isset($patent['status'])?$patent['status']:''}}"
                                        ng-model="status"
                                    >
                                    <label for="status" ng-class="{ active:  status }">Patent status </label>
                                </div>
                                <div class=" custom-form mb20 custm-lbl" >
                                    <div class="display-inline">
                                        <input class="with-gap" name="best" type="checkbox" id="best" value="1"  {{(isset($patent['best']) && $patent['best']=='1')?'checked=checked':''}} />
                                        <label for="best">Highlight above as Key achievement</label>
                                    </div>
                                </div>

                                <div class="row">
                                    @if(isset($patent['id']) && $patent['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif

                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{isset($patent['id'])?$patent['id']:''}}">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save" />
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

        $( "#patentForm" ).validate({
            rules: {
                patent: {required: true,alphanumeric:true }
            },
            messages: {
                patent: {
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
                var formData = $("#patentForm").serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    url:$("#patentForm").attr("action"),
                    data:formData,
                    success: function(response){
                        console.log(response);
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });
        /*$("#patentForm").submit(function( event ) {
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
       @if(isset($patent['id']) && $patent['id']!='')
        $("#remove").on("click", function(event){
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/patent/remove')}}/"+$("#id").val(),
                    data:formData,
                    success: function(response){
                        if(response.error == 0){
                            window.location.href = "{{$redirectBack}}";
                        }
                    }
                });

            }
        });
        @endif

        $("#best").on("click", function(){
            if($(this).is(":checked")){
                $(this).val("1");
            } else {
                $(this).val("0");
            }
        });

    });

/*var app = angular.module('PatentFromApp', []);

function getPatentDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-patent-details')}}",{'id':'{{$id}}' })
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.patent.id);
                $scope.patent = response.data.patent.patent;
                $scope.reference = response.data.patent.reference;
                $scope.status = response.data.patent.status;

                if(response.data.patent.best == "1"){
                    $("#best").val("1");
                    $("#best").prop('checked', true);
                }

                $("#cancel").hide();
                $("#remove").show();
            }
            console.log(response)
        });
    });
}

getPatentDetails();*/
</script>


@endsection
