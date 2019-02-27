@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=awardInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=awardInfo');
}
?>

    <section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>{{isset($award['id'])?'Update':'Add'}} awards and recognition</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="AwardFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row ">
                        <div class="">
                            <form action="{{URL::to('update/award-save')}}" method="POST" id="awardForm" name="awardForm" >

                                <div class="input-field custom-form">
                                    <input id="award" name="award" type="text" class="validate fourlength" required value="{{isset($award['award'])?$award['award']:''}}"
                                    >
                                    <label for="award" ng-class="{ active:  award }">Name of awards / recognition <span>*</span></label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="school" name="school" type="text" class="companyname" required value="{{isset($award['school'])?$award['school']:''}}" >
                                    <label for="school" ng-class="{ active:  school }">School / College / University / Company <span>*</span></label>
                                </div>
                                <ul class="d-flex mb0">
                                    <li class="custom-form dt-drpdwn mr10">
                                        <div class="input-field">
                                            <select id="dd" name="dd"
                                            >
                                                <option value="" selected>DD</option>
                                                @foreach($dd as $d)
                                                    <option value="{{$d}}" {{(isset($award['dd']) && $award['dd']==$d)?'selected=selected':''}}>{{$d}}</option>
                                                @endforeach
                                              </select>
                                            <label class="active" for="dd">DD</label>
                                        </div>
                                    </li>
                                    <li class="custom-form dt-drpdwn mr10">
                                        <div class="input-field">
                                            <select id="mm" name="mm"
                                            >
                                                <option value="" selected>MM</option>
                                                @foreach($mm as $m)
                                                    <option value="{{$m}}" {{(isset($award['mm']) && $award['mm']==$m)?'selected=selected':''}}>{{$m}}</option>
                                                @endforeach
                                            </select>
                                            <label class="active" for="mm">MM</label>
                                        </div>
                                    </li>
                                    <li class="custom-form dt-drpdwn">
                                        <div class="input-field">
                                            <select id="yyyy" name="yyyy"
                                                required
                                                data-msg="Required"
                                            >
                                                <option value="" selected>YYYY</option>
                                                <?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
                                                    <option value="{{$i}}" {{(isset($award['yyyy']) && $award['yyyy']==$i)?'selected=selected':''}}>{{$i}}</option>
                                                <?php } ?>
                                            </select>
                                            <label class="active" for="yyyy">YYYY <span>*</span></label>
                                        </div>
                                    </li>
                                </ul>

                                <div class="input-field custom-form">
                                    <input id="city" name="city" type="text" class="alpha fourlength" value="{{isset($award['city'])?$award['city']:''}}"

                                        ng-model="city"
                                    >
                                    <label for="city" ng-class="{ active:  city }">City</label>
                                </div>

                                <div class="input-field custom-form">
                                    <input id="country" name="country" type="text" class="alpha fourlength" value="{{isset($award['country'])?$award['country']:''}}"

                                        ng-model="country"
                                    >
                                    <label for="country" ng-class="{ active:  country }">Country </label>
                                </div>
                                <div class=" custom-form mb20 custm-lbl" >
                                    <div class="display-inline">
                                        <input class="with-gap" name="best" type="checkbox" id="best" value="1" {{(isset($award['best']) && $award['best']=='1')?'checked=checked':''}} />
                                        <label for="best">Highlight above as Key achievement</label>
                                    </div>
                                </div>

                                <div class="row">
                                    @if(isset($award['id']) && $award['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif
                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{isset($award['id'])?$award['id']:''}}">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save"/>
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

        $( "#awardForm" ).validate({
            rules: {
                award: {required: true},
                school: { required: true},
                mm: {
                    required: function(element){
                        return $("#dd").val()!="";
                    }
                },
                yyyy: {
                    required: function(element){
                        return ($("#mm").val()!="" || $("#yyyy").val()!="");
                    }
                }

            },
            messages: {
                award: {
                    required: "Required"
                    //alphanumeric: "Please enter alpha numeric value only."
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
                var formData = $("#awardForm").serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    url:$("#awardForm").attr("action"),
                    data:formData,
                    success: function(response){
                        console.log(response);
                        window.location.href = "{{$redirectBack}}";
                    }
                });
            }
        });


        @if(isset($award['id']) && $award['id']!='')
            $("#remove").on("click", function(event){
                event.preventDefault();
                var r = confirm("Are you sure you want to delete!");
                if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                    $.ajax({
                        type:"POST",
                        dataType : "JSON",
                        url:"{{URL::to('update/award/remove')}}/"+$("#id").val(),
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

        $('#dd').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#mm').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#yyyy').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
    });
</script>

<script>
var app = angular.module('AwardFromApp', []);

function getAwardDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-award-details')}}",{'id':'{{$id}}' })
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.award.id);
                $scope.award = response.data.award.award;
                $scope.school = response.data.award.school;
                $scope.dd = response.data.award.dd;
                $scope.mm = response.data.award.mm;
                $scope.yyyy = response.data.award.yyyy;
                $scope.city = response.data.award.city;
                $scope.country = response.data.award.country;



                $('#dd').find('option[value="'+response.data.award.dd+'"]').prop('selected', true);
                $("#dd").material_select();
                $scope.dd = response.data.award.dd;

                $('#mm').find('option[value="'+response.data.award.mm+'"]').prop('selected', true);
                $("#mm").material_select();
                $scope.mm = response.data.award.mm;

                $('#yyyy').find('option[value="'+response.data.award.yyyy+'"]').prop('selected', true);
                $("#yyyy").material_select();
                $scope.yyyy = response.data.award.yyyy;

                if(response.data.award.best == "1"){
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

getAwardDetails();
</script>


@endsection
