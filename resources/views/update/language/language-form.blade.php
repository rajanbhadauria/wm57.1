@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=languageInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=languageInfo');
}
?>

    <section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>{{isset($language['id'])?'Update':'Add'}} language</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="LanguageFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row">
                        <div class="">
                            <form action="{{URL::to('update/language-save')}}" method="POST" id="languageForm" name="languageForm">

                                <div class="input-field custom-form">
                                    <input id="language" name="language" type="text" class="validate" value="{{isset($language['language'])?$language['language']:''}}"
                                        required
                                    >
                                    <label for="language" ng-class="{ active:  language }">Language <span>*</span></label>
                                </div>


                                <div class=" custom-form mb20">
                                    <label for="Fixsalary" class="active " style="width: 100%; display: block">Select  <span>*</span></label>
                                    <div class="display-inline">
                                        <input class="with-gap checkbox" name="read" type="checkbox" id="read" ng-model="read" value="1" {{(isset($language['read']) && $language['read']=='1')?'checked=checked':''}} />
                                        <label for="read">Read</label>
                                      </div>
                                    <div class="display-inline">
                                        <input class="with-gap checkbox" name="write" type="checkbox" id="write" ng-model="write" value="1" {{(isset($language['write']) && $language['write']=='1')?'checked=checked':''}}/>
                                        <label for="write">Write</label>
                                      </div>
                                    <div class="display-inline mr0">
                                        <input class="with-gap checkbox" name="speak" type="checkbox" id="speak" ng-model="speak" value="1"  {{(isset($language['speak']) && $language['speak']=='1')?'checked=checked':''}}/>
                                        <label class="pr0" for="speak">Speak</label>
                                      </div>
                                </div>

                                <div class="row">
                                    @if(isset($language['id']) && $language['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif
                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{isset($language['id'])?$language['id']:''}}">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save"  />
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

        $( "#languageForm" ).validate({
            rules: {
                language: {required: true}
            },
            messages: {
                language: {
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
            },
            submitHandler: function(form) {
                var formData = $("#languageForm").serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    url:$("#languageForm").attr("action"),
                    data:formData,
                    success: function(response){
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });


        $(".checkbox").on("click", function(){
            if($(this).is(":checked")){
                $(this).val("1");
            } else {
                $(this).val("0");
            }
        })

      //  $("#remove").hide();

        @if(isset($language['id']) && $language['id']!='')
        $("#remove").on("click", function(event){

            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/language/remove')}}/"+$("#id").val(),
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
    });
/*var app = angular.module('LanguageFromApp', []);

function getLanguageDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-language-details')}}",{'id':'{{$id}}' })
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.language.id);
                $scope.language = response.data.language.language;
                $scope.read = response.data.language.read;
                $scope.write = response.data.language.write;
                $scope.speak = response.data.language.speak;

                if(response.data.language.read == "1"){
                    $("#read").val("1");
                    $("#read").prop('checked', true);
                }

                if(response.data.language.write == "1"){
                    $("#write").val("1");
                    $("#write").prop('checked', true);
                }

                if(response.data.language.speak == "1"){
                    $("#speak").val("1");
                    $("#speak").prop('checked', true);
                }

                $("#cancel").hide();
                $("#remove").show();

            }
            console.log(response)
        });
    });
}

getLanguageDetails();*/
</script>


@endsection
