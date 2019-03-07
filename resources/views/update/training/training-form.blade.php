@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=trainingInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=trainingInfo');
}
?>

<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>{{isset($training['id'])?'Update':'Add'}} trainings attended</h1>
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
<div class="section wrappit" ng-app="TrainingFromApp" ng-controller="myCtrl">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="big-center-box">
                    <div class="inner-half-container" id="loginDiv">
                        <div class="row">
                            <div class="">
                                <form action="{{URL::to('update/training-save')}}" method="POST" id="trainingForm" name="trainingForm"
                                    novalidate>

                                    <div class="input-field custom-form">
                                        <input id="training" name="training" type="text" class="fourlength validate"
                                            value="{{isset($training['training'])?$training['training']:''}}" required>
                                        <label for="training" ng-class="{ active:  training }">Name of training
                                            completed <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="school" name="school" type="text" class="companyname" required value="{{isset($training['school'])?$training['school']:''}}">
                                        <label for="school" ng-class="{ active:  school }">College / Insititute /
                                            Company</label>
                                    </div>
                                    <ul class="d-flex mb0">
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="dd" name="dd" ng-model="dd">
                                                    <option value="" selected>DD</option>
                                                    @foreach($dd as $d)
                                                    <option value="{{$d}}"
                                                        {{(isset($training['dd']) && $training['dd']==$d)?'selected=selected':''}}>{{$d}}</option>
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
                                                        {{(isset($training['mm']) && $training['mm']==$m)?'selected=selected':''}}>{{$m}}</option>
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
                                                        {{(isset($training['yyyy']) && $training['yyyy']==$i)?'selected=selected':''}}>{{$i}}</option>
                                                    <?php } ?>
                                                </select>
                                                <label class="active" for="yyyy">YYYY <span>*</span></label>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="input-field custom-form">
                                        <input id="city" name="city" type="text" class="alpha fourlength" value="{{isset($training['city'])?$training['city']:''}}">
                                        <label for="city" ng-class="{ active:  city }">City</label>
                                    </div>

                                    <div class="input-field custom-form">
                                        <input id="country" name="country" type="text" class="alpha fourlength" value="{{isset($training['country'])?$training['country']:''}}">
                                        <label for="country" ng-class="{ active:  country }">Country </label>
                                    </div>
                                    <div class="custom-form mb20 custm-lbl">
                                        <div class="display-inline">
                                            <input class="with-gap" name="best" type="checkbox" id="best" value="1"
                                                {{(isset($training['best']) && $training['best']=='1')?'checked=checked':''}} />
                                            <label for="best">Highlight above as Key achievement</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if(isset($training['id']) && $training['id']!='')
                                        <div class="col s6 pl0" id="remove">
                                            <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                        </div>
                                        @else
                                        <div class="col s6 pl0" id="cancel">
                                            <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        @endif

                                        <div class="col s6 pr0 custom-submit">
                                            <input type="hidden" name="id" id="id" value="{{isset($training['id'])?$training['id']:''}}">
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

        $("#trainingForm").validate({
            rules: {
                training: {
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

            },
            messages: {
                training: {
                    required: "Required"
                },
                school: {
                    required: "Required"
                },
                mm: {
                    required: "required"
                },
                yyyy: {
                    required: "required"
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
                var formData = $("#trainingForm").serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type: "POST",
                    url: $("#trainingForm").attr("action"),
                    data: formData,
                    success: function (response) {
                        window.location.href = "{{url($returnUrl)}}";
                    }
                });
            }
        });


        @if(isset($training['id']) && $training['id'] != '')

        $("#remove").on("click", function (event) {
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "{{URL::to('update/training/remove')}}/" + $("#id").val(),
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

    /*var app = angular.module('TrainingFromApp', []);

    function getTrainingDetails(){
        app.controller('myCtrl', function($scope, $http) {
            $http.post("{{URL::to('update/get-training-details')}}",{'id':'{{$id}}' })
            .then(function(response) {
                if(response.data.error == false){
                    $('#id').val(response.data.training.id);
                    $scope.training = response.data.training.training;
                    $scope.school = response.data.training.school;
                    $scope.dd = response.data.training.dd;
                    $scope.mm = response.data.training.mm;
                    $scope.yyyy = response.data.training.yyyy;
                    $scope.city = response.data.training.city;
                    $scope.country = response.data.training.country;



                    $('#dd').find('option[value="'+response.data.training.dd+'"]').prop('selected', true);
                    $("#dd").material_select();
                    $scope.dd = response.data.training.dd;

                    $('#mm').find('option[value="'+response.data.training.mm+'"]').prop('selected', true);
                    $("#mm").material_select();
                    $scope.mm = response.data.training.mm;

                    $('#yyyy').find('option[value="'+response.data.training.yyyy+'"]').prop('selected', true);
                    $("#yyyy").material_select();
                    $scope.yyyy = response.data.training.yyyy;

                    if(response.data.training.best == "1"){
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

    getTrainingDetails();*/
</script>


@endsection
