@extends('layouts.app')
@section('content')


<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=projectInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=projectInfo');
}
?>

<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>{{isset($project['id'])?'Update':'Add'}} key assignment / project</h1>
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
<div class="section wrappit" ng-controller="myCtrl">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="big-center-box">
                    <div class="inner-half-container" id="loginDiv">
                        <div class="row">
                            <div class="">
                                <form action="{{URL::to('update/project-save')}}" method="POST" id="projectForm" name="projectForm"
                                    novalidate>
                                    {{ csrf_field() }}
                                    <div class="input-field custom-form">
                                        <input id="project" name="project" type="text" class="validate"
                                            value="{{isset($project['project'])?$project['project']:''}}" required>
                                        <label for="project" ng-class="{ active:  project }">Name of assignment /
                                            project <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="school" name="school" type="text" class="alphanumeric validate"
                                            value="{{isset($project['school'])?$project['school']:''}}" required>
                                        <label for="school" ng-class="{ active:  school }">School / College / Company
                                            <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form mb10">
                                        <textarea id="projectDesc" name="projectDesc" class="mb10" ng-model="projectDesc">{{isset($project['projectDesc'])?$project['projectDesc']:''}}</textarea>
                                        <label for="projectDesc" ng-class="{ active:  projectDesc }">Description</label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="url" name="url" type="text" class="validate" value="{{isset($project['url'])?$project['url']:'http://'}}"
                                            ng-model="url">
                                        <label for="url" ng-class="{ active:  url }">URL</label>
                                    </div>

                                    <ul class="d-flex mb0">
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="dd" name="dd" ng-model="dd">
                                                    <option value="" selected>DD</option>
                                                    @foreach($dd as $d)
                                                    <option value="{{$d}}"
                                                        {{(isset($project['dd']) && $project['dd']==$d)?'selected=selected':''}}>{{$d}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="dd">DD</label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="mm" name="mm" ng-model="mm">
                                                    <option value="" selected>MM</option>
                                                    @foreach($mm as $m)
                                                    <option value="{{$m}}"
                                                        {{(isset($project['mm']) && $project['mm']==$m)?'selected=selected':''}}>{{$m}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="mm">MM</label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn">
                                            <div class="input-field">
                                                <select id="yyyy" name="yyyy" ng-model="yyyy" required data-msg="Required">
                                                    <option value="" selected>YYYY</option>
                                                    <?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
                                                    <option value="{{$i}}"
                                                        {{(isset($project['yyyy']) && $project['yyyy']==$i)?'selected=selected':''}}>{{$i}}</option>
                                                    <?php } ?>
                                                </select>
                                                <label class="active" for="yyyy">YYYY<span>*</span></label>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="input-field custom-form">
                                        <input id="city" name="city" type="text" class="alpha fourlength check_condition"
                                            value="{{isset($project['city'])?$project['city']:''}}" ng-model="city">
                                        <label for="city" ng-class="{ active:  city }">City</label>
                                    </div>

                                    <div class="input-field custom-form">
                                        <input id="country" name="country" type="text" class="alpha fourlength check_condition"
                                            value="{{isset($project['country'])?$project['country']:''}}" ng-model="country">
                                        <label for="country" ng-class="{ active:  country }">Country </label>
                                    </div>
                                    <div class=" custom-form mb20 custm-lbl">
                                        <div class="display-inline">
                                            <input class="with-gap" name="best" type="checkbox" id="best" value="1"
                                                {{(isset($project['best']) && $project['best'] == '1') ? 'checked=checked':''}} />
                                            <label for="best">Highlight above as Key achievement</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if(isset($project['id']) && $project['id']!='')
                                        <div class="col s6 pl0" id="remove">
                                            <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                        </div>
                                        @else
                                        <div class="col s6 pr0" id="cancel">
                                            <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        @endif
                                        <div class="col s6 pr0 custom-submit">
                                            <input type="hidden" name="id" id="id" value="{{isset($project['id'])?$project['id']:''}}">
                                            <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block"
                                                value="Save" />
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
    $(document).ready(function () {

        $.validator.addMethod("alphanumeric", function (value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Please enter alpha numeric value only.");
        $.validator.setDefaults({
            ignore: [],
            onfocusout: function () {
                return true;
            }
        });

        $("#projectForm").validate({
            rules: {
                project: {
                    required: true,
                    //alphanumeric: true
                },
                school: {
                    required: true,
                    //alphanumeric: true
                },
                mm: {
                    required: function (element) {
                        return $("#dd").val() != "";
                    }
                },
                yyyy: {
                    required: function (element) {
                        return ($("#yyyy").val() == "yyyy" || $("#yyyy").val() == "");
                    }
                },
                url: {
                    url: true
                }


            },
            messages: {
                project: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                school: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                mm: {
                    required: "Required"
                },
                yyyy: {
                    required: "Required"
                },
                url: {
                    url: 'Enter vaild url'
                }
            },
            errorClass: 'validationError',
            errorElement: 'span',
            //errorLabelContainer: '.validationError',
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents("span").addClass(errorClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents("span").removeClass(errorClass);
            },
            submitHandler: function (form) {
                var formData = $('#projectForm').serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type: "POST",
                    url: $("#projectForm").attr("action"),
                    data: formData,
                    success: function (response) {
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });

        @if(isset($project['id']) && $project['id'] != '')
        //$("#remove").hide();

        $("#remove").on("click", function (event) {
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $('#projectForm').serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "{{URL::to('update/project/remove')}}/" + $("#id").val(),
                    data: formData,
                    success: function (response) {
                        if (response.error == 0) {
                            window.location.href = "{{$redirectBack}}";
                        }
                    }
                });

            }
        });
        @endif

        $("#best").on("click", function () {
            if ($(this).is(":checked")) {
                $(this).val("1");
            } else {
                $(this).val("0");
            }
        });


        $('#dd').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#mm').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#yyyy').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
    });

    /*var app = angular.module('ProjectFromApp', []);

    function getProjectDetails(){
        app.controller('myCtrl', function($scope, $http) {
            $http.post("{{URL::to('update/get-project-details')}}",{'id':'{{$id}}' })
            .then(function(response) {
                if(response.data.error == false){
                    $('#id').val(response.data.project.id);
                    $scope.project = response.data.project.project;
                    $scope.school = response.data.project.school;
                    $scope.projectDesc = response.data.project.projectDesc;
                    $scope.url = response.data.project.url;
                    $scope.dd = response.data.project.dd;
                    $scope.mm = response.data.project.mm;
                    $scope.yyyy = response.data.project.yyyy;
                    $scope.city = response.data.project.city;
                    $scope.country = response.data.project.country;



                    $('#dd').find('option[value="'+response.data.project.dd+'"]').prop('selected', true);
                    $("#dd").material_select();
                    $scope.dd = response.data.project.dd;

                    $('#mm').find('option[value="'+response.data.project.mm+'"]').prop('selected', true);
                    $("#mm").material_select();
                    $scope.mm = response.data.project.mm;

                    $('#yyyy').find('option[value="'+response.data.project.yyyy+'"]').prop('selected', true);
                    $("#yyyy").material_select();
                    $scope.yyyy = response.data.project.yyyy;

                    if(response.data.project.best == "1"){
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

    getProjectDetails();*/
</script>


@endsection
