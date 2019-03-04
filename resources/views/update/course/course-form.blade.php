@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=courseInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=courseInfo');
}
?>

<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>{{isset($course['id'])?'Update':'Add'}}  subject</h1>
            </div>
        </div>
    </div>
</section>
<div class="section wrappit" ng-app="CourseFromApp" ng-controller="myCtrl">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="big-center-box">
                    <div class="inner-half-container" id="loginDiv">
                        <div class="row">
                            <div class="">
                                <form action="{{URL::to('update/course-save')}}" method="POST" id="courseForm" name="courseForm"
                                    novalidate>

                                    <div class="input-field custom-form">
                                        <input id="course" name="course" type="text" class="fourlength validate" value="{{isset($course['course'])?$course['course']:''}}"
                                            required>
                                        <label for="course" ng-class="{ active:  course }">Name of subject<span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="school" name="school" type="text" class="companyname" required value="{{isset($course['school'])?$course['school']:''}}"
                                            ng-model="school">
                                        <label for="school" ng-class="{ active:  school }">School / College /
                                            University <span>*</span></label>
                                    </div>
                                    <ul class="d-flex mb0">
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="dd" name="dd" ng-model="dd">
                                                    <option value="" selected>DD</option>
                                                    @foreach($dd as $d)
                                                    <option value="{{$d}}"
                                                        {{(isset($course['dd']) && $course['dd']==$d)?'selected=selected':''}}>{{$d}}</option>
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
                                                        {{(isset($course['mm']) && $course['mm']==$m)?'selected=selected':''}}>{{$m}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="mm">MM</label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn">
                                            <div class="input-field">
                                                <select id="yyyy" name="yyyy" required data-msg="Required">
                                                    <option value="" selected>YYYY</option>
                                                    <?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
                                                    <option value="{{$i}}"
                                                        {{(isset($course['yyyy']) && $course['yyyy']==$i)?'selected=selected':''}}>{{$i}}</option>
                                                    <?php } ?>
                                                </select>
                                                <label class="active" for="yyyy">YYYY <span>*</span></label>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="row mb0">
                                        <div class="col s6 pl0">
                                            <div class="input-field">
                                                <select id="grade" name="grade" ng-required="gradeValue" ng-model="grade">
                                                    <option value="">Select</option>
                                                    <option value="grade"
                                                        {{(isset($course['grade']) && $course['grade']=="grade")?'selected=selected':''}}>Grade</option>
                                                    <option value="percentage"
                                                        {{(isset($course['grade']) && $course['grade']=="percentage")?'selected=selected':''}}>Percentage</option>
                                                    <option value="gpa"
                                                        {{(isset($course['grade']) && $course['grade']=="gpa")?'selected=selected':''}}>GPA</option>
                                                </select>
                                                <label class="active" for="grade">Grade / Marks</label>
                                            </div>
                                        </div>
                                        <div class="col s6 pr0">
                                            <div class="input-field">
                                                <input id="gradeValue" name="gradeValue" type="text" class="onelength validate"
                                                    value="{{isset($course['gradeValue'])?$course['gradeValue']:''}}">
                                                <label ng-class="{ active:  gradeValue }" for="gradeValue">Value</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" custom-form mb20 custm-lbl">
                                        <div class="display-inline">
                                            <input class="with-gap" name="best" type="checkbox" id="best" value="1"
                                                {{(isset($course['best']) && $course['best']=='1')?'checked=checked':''}} />
                                            <label for="best">Highlight above as Key achievement</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if(isset($course['id']) && $course['id']!='')
                                        <div class="col s6 pl0" id="remove">
                                            <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                        </div>
                                        @else
                                        <div class="col s6 pl0" id="cancel">
                                            <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        @endif

                                        <div class="col s6 pr0 custom-submit">
                                            <input type="hidden" name="id" id="id" value="{{isset($course['id'])?$course['id']:''}}">
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

        $("#courseForm").validate({
            rules: {
                course: {
                    required: true
                },
                school: {
                    required: true
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
                }
                //gradeValue: { required: true }

            },
            messages: {
                course: {
                    required: "Required"
                },
                /*gradeValue: {
                    required: "Grade required"
                },*/

                school: {
                    required: "Required"
                },
                mm: {
                    required: "Required"
                },
                yyyy: {
                    required: "Required"
                },
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
                var formData = $("#courseForm").serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type: "POST",
                    url: $("#courseForm").attr("action"),
                    data: formData,
                    success: function (response) {
                        window.location.href = "{{url($returnUrl)}}";
                    }
                });
            }
        });

        @if(isset($course['id']) && $course['id'] != '')
        $("#remove").on("click", function (event) {
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "{{URL::to('update/course/remove')}}/" + $("#id").val(),
                    data: formData,
                    success: function (response) {
                        if (response.error == 0) {
                            window.location.href = "{{url($returnUrl)}}";
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

    /*var app = angular.module('CourseFromApp', []);

    function getCourseDetails(){
        app.controller('myCtrl', function($scope, $http) {
            $http.post("{{URL::to('update/get-course-details')}}",{'id':'{{$id}}' })
            .then(function(response) {
                if(response.data.error == false){
                    $('#id').val(response.data.course.id);
                    $scope.course = response.data.course.course;
                    $scope.school = response.data.course.school;
                    $scope.dd = response.data.course.dd;
                    $scope.mm = response.data.course.mm;
                    $scope.yyyy = response.data.course.yyyy;
                    $scope.grade = response.data.course.grade;
                    $scope.gradeValue = response.data.course.gradeValue;



                    $('#dd').find('option[value="'+response.data.course.dd+'"]').prop('selected', true);
                    $("#dd").material_select();
                    $scope.dd = response.data.course.dd;

                    $('#mm').find('option[value="'+response.data.course.mm+'"]').prop('selected', true);
                    $("#mm").material_select();
                    $scope.mm = response.data.course.mm;

                    $('#yyyy').find('option[value="'+response.data.course.yyyy+'"]').prop('selected', true);
                    $("#yyyy").material_select();
                    $scope.yyyy = response.data.course.yyyy;


                    $('#grade').find('option[value="'+response.data.course.grade+'"]').prop('selected', true);
                    $("#grade").material_select();
                    $scope.grade = response.data.course.grade;

                    if(response.data.course.best == "1"){
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

    getCourseDetails();*/
</script>


@endsection
