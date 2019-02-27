@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=educationInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=educationInfo');
}
?>


<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>{{isset($education['id'])?'Update':'Add'}} education</h1>
            </div>
        </div>
    </div>
</section>
<div class="section wrappit" ng-app="EducationFromApp" ng-controller="myCtrl">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="big-center-box">
                    <div class="inner-half-container" id="loginDiv">
                        <div class="row mb20">
                            <div class="">
                                <form action="{{URL::to('update/education-save')}}" method="POST" id="educationForm"
                                    name="educationForm" novalidate>
                                    {{ csrf_field() }}
                                    <div class="input-field custom-form">
                                        <select id="education" name="education" required ng-model="education">
                                            <option value="">Select</option>
                                            <option value="1"
                                                {{(isset($education['education']) && $education['education']=="1")?'selected=selected':''}}>Post
                                                graduation</option>
                                            <option value="2"
                                                {{(isset($education['education']) && $education['education']=="2")?'selected=selected':''}}>Graduation</option>
                                            <option value="3"
                                                {{(isset($education['education']) && $education['education']=="3")?'selected=selected':''}}>Under
                                                graduation</option>
                                        </select>
                                        <label class="active">Education <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="school" name="school" type="text" class="fivelength companyname validate"
                                            value="{{isset($education['school'])?$education['school']:''}}" required
                                            ng-model="school">
                                        <label for="school" ng-class="{ active:  school }">School / College /
                                            University <span>*</span></label>
                                    </div>

                                    <div class="input-field custom-form">
                                        <input id="city" name="city" type="text" class="alpha fourlength check_condition validate"
                                            value="{{isset($education['city'])?$education['city']:''}}" required
                                            ng-model="city">
                                        <label for="city" ng-class="{ active:  city }">City <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="country" name="country" type="text" class="alpha fourlength check_condition validate"
                                            value="{{isset($education['country'])?$education['country']:''}}" required
                                            ng-model="country">
                                        <label for="country" ng-class="{ active:  country }">Country <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="educationName" name="educationName" type="text" class="companyname check_condition validate"
                                            value="{{isset($education['educationName'])?$education['educationName']:''}}"
                                            required ng-model="educationName">
                                        <label for="educationName" ng-class="{ active:  educationName }">Education name
                                            <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="branch" name="branch" type="text" class="alphanumeric fourlength check_condition validate"
                                            value="{{isset($education['branch'])?$education['branch']:''}}">
                                        <label for="branch" ng-class="{ active:  branch }">Course / Specialization</label>
                                    </div>

                                    <ul class="d-flex mb0">
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="dd" name="dd" ng-model="dd">
                                                    <option value="" selected>DD</option>
                                                    @foreach($dd as $d)
                                                    <option value="{{$d}}"
                                                        {{(isset($education['dd']) && $education['dd']==$d)?'selected=selected':''}}>{{$d}}</option>
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
                                                        {{(isset($education['mm']) && $education['mm']==$m)?'selected=selected':''}}>{{$m}}</option>
                                                    @endforeach
                                                </select>

                                                <label class="active" for="mm">MM</label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn">
                                            <div class="input-field">
                                                <select id="yyyy" name="yyyy" required ng-model="yyyy" data-msg="Required">
                                                    <option value="" selected>YYYY</option>
                                                    <?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
                                                    <option value="{{$i}}"
                                                        {{(isset($education['yyyy']) && $education['yyyy']==$i)?'selected=selected':''}}>{{$i}}</option>
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
                                                        {{(isset($education['grade']) && $education['grade']=="grade")?'selected=selected':''}}>Grade</option>
                                                    <option value="percentage"
                                                        {{(isset($education['grade']) && $education['grade']=="percentage")?'selected=selected':''}}>Percentage</option>
                                                    <option value="gpa"
                                                        {{(isset($education['grade']) && $education['gradeValu']=="gpa")?'selected=selected':''}}>GPA</option>
                                                </select>
                                                <label class="active" for="grade">Grades / Marks</label>
                                            </div>
                                        </div>
                                        <div class="col s6 pr0">
                                            <div class="input-field">
                                                <input id="gradeValue" name="gradeValue" type="text" class="onelength cgpa validate"
                                                    ng-required="grade" ng-model="gradeValue" value="{{isset($education['gradeValue'])?$education['gradeValue']:''}}">
                                                <label ng-class="{ active:  gradeValue }" for="gradeValue">Value</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" custom-form mb20 custm-lbl">
                                        <div class="display-inline">
                                            <input class="with-gap" name="best" type="checkbox" id="best" value="1"
                                                {{(isset($education['best']) && $education['best']=='1')?'checked=checked':''}} />
                                            <label for="best">Highlight above as Key achievement</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(isset($education['id']) && $education['id']!='')
                                        <div class="col s6 pl0" id="remove">
                                            <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                        </div>
                                        @else
                                        <div class="col s6 pr0" id="cancel">
                                            <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        @endif

                                        <div class="col s6 pr0 custom-submit">
                                            <input type="hidden" name="id" id="id" value="{{isset($education['id'])?$education['id']:''}}">
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

        $("#educationForm").validate({
            rules: {
                education: {
                    required: true
                },
                school: {
                    required: true
                },
                city: {
                    required: true,
                    alphanumeric: true
                },
                country: {
                    required: true,
                    alphanumeric: true
                },
                educationName: {
                    required: true
                },
                gradeValue: {
                    required: function (element) {
                        return $("#grade").val() != "";
                    }
                },
                grade: {
                    required: function (element) {
                        return $("#gradeValue").val() != "";
                    }
                },
                mm: {
                    required: function (element) {
                        return $("#dd").val() != "";
                    }
                },
                yyyy: {
                    required: function (element) {
                        return ($("#mm").val() != "" || $("#yyyy").val() != "");
                    }
                }
                //  branch: { required: true, alphanumeric:true }

            },
            messages: {
                education: {
                    required: "Required"
                },
                gradeValue: {
                    required: "Required"
                },
                grade: {
                    required: "Required"
                },

                school: {
                    required: "Required"
                },
                mm: {
                    required: "Required"
                },
                yyyy: {
                    required: "Required"
                },
                city: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                country: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                educationName: {
                    required: "Required"
                },
                /*branch: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },*/
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

                $.ajax({
                    type: "POST",
                    url: $("#educationForm").attr("action"),
                    data: $("#educationForm").serialize(),
                    success: function (response) {
                        console.log(response);
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });

        /*$("#educationForm").submit(function( event ) {
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

        @if(isset($education['id']) && $education['id'] != '')
        $("#remove").on("click", function (event) {
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "{{URL::to('update/education/remove')}}/" + $("#id").val(),
                    data: $(this).serialize(),
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
        $('#education').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });


    });

    /*var app = angular.module('EducationFromApp', []);

    function getEducationDetails(){
        app.controller('myCtrl', function($scope, $http) {
            $http.post("{{URL::to('update/get-education-details')}}",{'id':'{{$id}}' })
            .then(function(response) {
                if(response.data.error == false){
                    $('#id').val(response.data.education.id);

                    $scope.school = response.data.education.school;
                    $scope.city = response.data.education.city;
                    $scope.city = response.data.education.city;
                    $scope.country = response.data.education.country;
                    $scope.educationName = response.data.education.educationName;
                    $scope.branch = response.data.education.branch;
                    $scope.grade = response.data.education.grade;
                    $scope.gradeValue = response.data.education.gradeValue;


                    $('#education').find('option[value="'+response.data.education.education+'"]').prop('selected', true);
                    $("#education").material_select();
                    $scope.education = response.data.education.education;


                    $('#dd').find('option[value="'+response.data.education.dd+'"]').prop('selected', true);
                    $("#dd").material_select();
                    $scope.dd = response.data.education.dd;

                    $('#mm').find('option[value="'+response.data.education.mm+'"]').prop('selected', true);
                    $("#mm").material_select();
                    $scope.mm = response.data.education.mm;

                    $('#yyyy').find('option[value="'+response.data.education.yyyy+'"]').prop('selected', true);
                    $("#yyyy").material_select();
                    $scope.yyyy = response.data.education.yyyy;

                    $('#grade').find('option[value="'+response.data.education.grade+'"]').prop('selected', true);
                    $("#grade").material_select();
                    $scope.grade = response.data.education.grade;

                    if(response.data.education.best == "1"){
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

    getEducationDetails();*/
</script>


@endsection
