@extends('layouts.app')
@section('content')
<style type="text/css">
    #fixSalaryType-error {
        bottom: :-20px;
    }
</style>
<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=workInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=workInfo');
}
?>

<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                @if(isset($id) && $id!='')
                <h1>Update work</h1>
                @else
                <h1>Add work</h1>
                @endif
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
                                <form action="{{URL::to('update/work-save')}}" method="POST" id="workForm" name="workForm">
                                {{ csrf_field() }}
                                <input type="hidden" name="returnUrl" value="{{$returnUrl}}">
                                    <div class="input-field custom-form">
                                        <input id="company" name="company" type="text" class="tenlength companyname check_condition validate"
                                            value="{{isset($work['company'])?$work['company']:''}}" required data-msg="Company name required">

                                        <label for="company" ng-class="{ active:  company }">Company name <span>*</span>
                                        </label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <select id="employementType" name="employementType" required data-msg="Employement type required">
                                            <option value="">Select</option>
                                            <option value="1"
                                                {{(isset($work['employementType']) && $work['employementType']=='1')?'selected=selected':''}}>Full
                                                time</option>
                                            <option value="2"
                                                {{(isset($work['employementType']) && $work['employementType']=='2')?'selected=selected':''}}>Part
                                                time</option>
                                            <option value="3"
                                                {{(isset($work['employementType']) && $work['employementType']=='3')?'selected=selected':''}}>Contract</option>
                                            <option value="4"
                                                {{(isset($work['employementType']) && $work['employementType']=='4')?'selected=selected':''}}>Trainee</option>
                                        </select>
                                        <label class="active">Employement type <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <select id="employementStatus" name="employementStatus" required data-msg="Required">
                                            <option value="" selected>Select</option>
                                            <option value="1"
                                                {{(isset($work['employementStatus']) && $work['employementStatus']=='1')?'selected=selected':''}}>Current</option>
                                            <option value="2"
                                                {{(isset($work['employementStatus']) && $work['employementStatus']=='2')?'selected=selected':''}}>Previous</option>
                                        </select>

                                        <label class="active">Employement status <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="city" name="city" type="text" class="alpha fourlength check_condition"
                                            value="{{isset($work['city'])?$work['city']:''}}" required data-msg="Required">

                                        <label for="city" ng-class="{ active:  city }">City <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="country" name="country" type="text" class=" alpha fivelength check_condition"
                                            value="{{isset($work['country'])?$work['country']:''}}" required data-msg="Required">


                                        <label for="country" ng-class="{ active:  country }">Country <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form ">
                                        <input id="level" name="level" type="text" class="alphanumeric twolength check_condition"
                                            value="{{isset($work['level'])?$work['level']:''}}">
                                        <label for="level" ng-class="{ active: level }">Level band</label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="designation" name="designation" type="text" class="alpha tenlength check_condition"
                                            value="{{isset($work['designation'])?$work['designation']:''}}" required>
                                        <label for="designation" ng-class="{ active:designation }">Official designation
                                            <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form ">
                                        <input id="department" name="department" type="text" class="alpha tenlength check_condition"
                                            value="{{isset($work['department'])?$work['department']:''}}">
                                        <label for="department" ng-class="{ active:department }">Department / Function <span>*</span></label>
                                    </div>
                                    <div class="input-field custom-form ">
                                        <input id="role" name="role" type="text" class="check_condition"
                                            value="{{isset($work['role'])?$work['role']:''}}" ng-model="role">
                                        <label for="role" ng-class="{ active: role}">Role title</label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <textarea id="roleDesc" name="roleDesc" class="" data-length="1000" ng-model="roleDesc">{{isset($work['roleDesc'])?$work['roleDesc']:''}}</textarea>
                                        <label for="roleDesc" ng-class="{ active: roleDesc }">Role description</label>
                                    </div>
                                    <div class="input-field custom-form">
                                        <input id="teamSize" name="teamSize" type="text" class="" value="{{isset($work['teamSize'])?$work['teamSize']:''}}"
                                            ng-model="teamSize numeric">
                                        <label for="teamSize" ng-class="{ active: teamSize }">Team size</label>
                                    </div>

                                    <div class="input-field custom-form">
                                        <span class="form-label custm-lbl">Start date</span>
                                    </div>

                                    <ul class="d-flex mb0">
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="ddStart" name="ddStart" ng-model="ddStart">
                                                    <option value="" selected>DD</option>

                                                    @foreach($dd as $d)
                                                    <option value="{{$d}}"
                                                        {{(isset($work['ddStart']) && $work['ddStart']==$d)?'selected=selected':''}}>{{$d}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="ddStart">DD</label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="mmStart" name="mmStart" data-msg="Required" required>
                                                    <option value="" selected>MM</option>
                                                    @foreach($mm as $m)
                                                    <option value="{{$m}}"
                                                        {{(isset($work['mmStart']) && $work['mmStart']==$m)?'selected=selected':''}}>{{$m}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="mmStart">MM <span>*</span></label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn">
                                            <div class="input-field">
                                                <select id="yyyyStart" name="yyyyStart" required data-msg="Required">
                                                    <option value="" selected>YYYY</option>
                                                    <?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
                                                    <option value="{{$i}}"
                                                        {{(isset($work['yyyyStart']) && $work['yyyyStart']==$i)?'selected=selected':''}}>{{$i}}</option>
                                                    <?php } ?>

                                                </select>
                                                <label class="active" for="yyyyStart">YYYY <span>*</span></label>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="input-field custom-form">
                                        <span class="form-label custm-lbl">End date</span>
                                    </div>

                                    <ul class="d-flex mb0">
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="ddEnd" name="ddEnd" ng-model="ddEnd">
                                                    <option value="" selected>DD</option>
                                                    @foreach($dd as $d)
                                                    <option value="{{$d}}"
                                                        {{(isset($work['ddEnd']) && $work['ddEnd']==$d)?'selected=selected':''}}>{{$d}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="ddEnd">DD</label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn mr10">
                                            <div class="input-field">
                                                <select id="mmEnd" name="mmEnd">
                                                    <option value="" selected>MM</option>
                                                    @foreach($mm as $m)
                                                    <option value="{{$m}}"
                                                        {{(isset($work['mmEnd']) && $work['mmEnd']==$m)?'selected=selected':''}}>{{$m}}</option>
                                                    @endforeach
                                                </select>
                                                <label class="active" for="mmEnd">MM </label>
                                            </div>
                                        </li>
                                        <li class="custom-form dt-drpdwn">
                                            <div class="input-field">
                                                <select id="yyyyEnd" name="yyyyEnd">
                                                    <option value="" selected>YYYY</option>
                                                    <?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
                                                    <option value="{{$i}}"
                                                        {{(isset($work['yyyyEnd']) && $work['yyyyEnd']==$i)?'selected=selected':''}}>{{$i}}</option>
                                                    <?php } ?>
                                                </select>
                                                <label class="active" for="yyyyEnd">YYYY </label>
                                            </div>
                                        </li>
                                    </ul>

                                    <!--<div class="link-container-inside">
                                    <a class="blue-link more-form">More form</a>
                                </div> -->
                                    <div class="custom-form cf-hide">
                                        <div class="input-field">
                                            <label class="active block-label">Salary Currency</label>
                                            <select id="fixCurrency" name="fixCurrency" ng-model="fixCurrency">
                                                <option value="" selected>Select</option>
                                                <option value="USD"
                                                    {{(isset($work['fixCurrency']) && $work['fixCurrency']=='USD')?'selected=selected':''}}>USD</option>
                                                <option value="INR"
                                                    {{(isset($work['fixCurrency']) && $work['fixCurrency']=='INR')?'selected=selected':''}}>INR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="custom-form cf-hide mb8 custm-lbl">
                                        <label for="Fixsalary" class="active block-label" style="width: 100%; ">Fix
                                            salary</label>
                                        <div class="display-inline">
                                            <input class="with-gap" name="fixSalaryType" type="radio" id="fixSalaryType1"
                                                value="annual"
                                                {{(isset($work['fixSalaryType']) && $work['fixSalaryType']=='annual')?'checked=checked':''}} />
                                            <label for="fixSalaryType1">Annual</label>
                                        </div>
                                        <div class="display-inline">
                                            <input class="with-gap" name="fixSalaryType" type="radio" id="fixSalaryType2"
                                                value="month"
                                                {{(isset($work['fixSalaryType']) && $work['fixSalaryType']=='month')?'checked=checked':''}} />
                                            <label for="fixSalaryType2">Month</label>
                                        </div>
                                    </div>
                                    <div class="input-field custom-form cf-hide ">
                                        <input id="fixSalary" name="fixSalary" type="text" class="" value="{{(isset($work['fixSalary']) && $work['fixSalary']!='')?$work['fixSalary']:''}}">
                                        <label for="fixSalary" ng-class="{ active: fixSalary }">Fix salary number</label>
                                    </div>

                                    <div class=" custom-form cf-hide mb8 custm-lbl">
                                        <label for="Variablesalary" class="active numeric block-label" style="width: 100%;">Variable
                                            salary</label>
                                        <div class="display-inline">
                                            <input class="with-gap" name="variableSalaryType" type="radio" id="variableSalaryType1"
                                                value="annual"
                                                {{(isset($work['variableSalaryType']) && $work['variableSalaryType']=='annual')?'checked=checked':''}} />
                                            <label for="variableSalaryType1">Annual</label>
                                        </div>
                                        <div class="display-inline">
                                            <input class="with-gap" name="variableSalaryType" type="radio" id="variableSalaryType2"
                                                value="month"
                                                {{(isset($work['variableSalaryType']) && $work['variableSalaryType']=='month')?'checked=checked':''}} />
                                            <label for="variableSalaryType2">Month</label>
                                        </div>
                                    </div>
                                    <div class="input-field custom-form cf-hide">
                                        <input id="variableSalary" name="variableSalary" type="text" class="numeric"
                                            value="{{(isset($work['variableSalary']) && $work['variableSalary']!='')?$work['variableSalary']:''}}">
                                        <label for="variableSalary" ng-class="{ active: variableSalary }">Variable
                                            salary number</label>
                                    </div>
                                    <div class="input-field custom-form cf-hide">
                                        <input id="ctc" name="ctc" type="text" readonly="readonly" class="readonly-field"
                                            value="{{(isset($work['ctc']) && $work['ctc']!='')?$work['ctc']:''}}">
                                        <label for="ctc" id="ctc_label"  ng-class="{ active:  ctc }">CTC</label>
                                    </div>
                                    <div class=" custom-form mb20 custm-lbl">
                                        <div class="display-inline">
                                            <input class="with-gap" name="best" type="checkbox" id="best" value="1"
                                                {{(isset($work['best']) && $work['best']==1)?'checked=checked':''}} />

                                            <label for="best">Highlight above as Key achievement</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(isset($work['id']) && $work['id']!='')
                                        <div class="col s6 pl0" id="remove">
                                            <a href="{{$redirectBack}}" class="waves-effect waves-light btn-red display-block">Remove</a>
                                        </div>
                                        @else
                                        <div class="col s6 pl0" id="cancel">
                                            <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        @endif

                                        <div class="col s6 pr0 custom-submit">
                                            <input type="hidden" name="id" id="id" value="{{isset($work['id'])?$work['id']:''}}">
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
    function formatNumber(number) {
        number = number.toString();
        number = number.replace(/,/g , '');
        var lastThree = number.substring(number.length-3);
        var otherNumbers = number.substring(0,number.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var newNumber = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return newNumber;
    }
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

        $("#workForm").validate({
            rules: {
                company: {
                    required: true
                },
                employementType: {
                    required: true
                },
                employementStatus: {
                    required: true
                },
                country: {
                    required: true,
                    alphanumeric: true
                },
                level: {
                    alphanumeric: true
                },
                department: {
                    alphanumeric: true,
                    required: true
                },
                fixSalary: {
                    number: true
                },
                variableSalary: {
                    number: true
                },
                ctc: {
                   // number: true
                },
                designation: {
                    required: true,
                    alphanumeric: true
                },
                fixCurrency: {
                    required: function (element) {
                        //return $("#fixSalary").val()!="";
                        return ($('input[name=fixSalaryType]').is(':checked') || $("#fixSalary").val() !=
                            "")
                    }
                },
                fixSalaryType: {
                    required: function (element) {
                        return ($("#fixCurrency").val() != "" || $("#fixSalary").val() != "");
                    }
                },
                fixSalary: {
                    required: function (element) {
                        return ($("#fixCurrency").val() != "" || $('input[name=fixSalaryType]').is(
                            ':checked'));
                    }
                },
                mmStart: {
                    required: function (element) {
                        return ($("#ddStart").val() != "" || $("#mmStart").val() == "");
                    }
                },
                mmEnd: {
                    required: {
                        depends: function(element) {
                            return $("#employementStatus").val() === "2";
                        }
                    }
                },
                yyyyEnd: {
                    required: {
                        depends: function(element) {
                            return $("#employementStatus").val() === "2";
                        }
                    }
                },


            },
            messages: {
                company: "Required",
                employementType: "Required",
                fixCurrency: "Required",
                fixSalaryType: "Required",
                employementStatus: "Required",
                mmStart: "Required",
                mmEnd: "Required",
                yyyyEnd: "Required",
                country: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                level: {
                    alphanumeric: "Please enter alpha numeric value only."
                },
                department: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
                },
                fixSalary: {
                    required: "Required",
                    number: "Please enter numeric value only."
                },
                variableSalary: {
                    number: "Please enter numeric value only."
                },
                ctc: {
                    number: "Please enter numeric value only."
                },
                designation: {
                    required: "Required",
                    alphanumeric: "Please enter alpha numeric value only."
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
                event.preventDefault();
                //console.log($(this).attr("action"));
                $.ajax({
                    type: "POST",
                    url: $("#workForm").attr("action"),
                    data: $("#workForm").serialize(),
                    success: function (response) {
                        window.location.href = "{{$returnUrl}}";
                    }
                });
            }
        });

        @if(isset($work['id']) && $work['id'] != '')
        $("#remove").on("click", function (event) {
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "{{URL::to('update/work/remove')}}/" + $("#id").val(),
                    data: $("#workForm").serialize(),
                    success: function (response) {
                        if (response.error == 0) {
                            window.location.href = "{{$returnUrl}}";
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
        $('#employementType').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#employementStatus').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

        $('#ddEnd').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

        $('#mmEnd').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

        $('#yyyyEnd').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });


        $('#ddStart').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#mmStart').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#yyyyStart').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

        $('#fixCurrency').on('change', function (e) {
            if (e.target.value.trim() == '' || e.target.value == 0) {} else {
                if ($(this).parents().children('.validationError')) {
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#ctc').on('chnage', function (e) {
            if (e.which >= 37 && e.which <= 40) return;
            $('#ctc').val(formatNumber($('#ctc').val()));
        });
        $('#fixSalary').on('keyup', function (e) {
            if (e.which >= 37 && e.which <= 40) return;
            $('#fixSalary').val(formatNumber($('#fixSalary').val()));
            updateCtc();
        });
        $('#variableSalary').on('keyup', function (e) {
            if (e.which >= 37 && e.which <= 40) return;
            $('#variableSalary').val(formatNumber( $('#variableSalary').val()));
            updateCtc();
        });
        $('input[name=fixSalaryType]:radio').on('click', function (e) {
            updateCtc();
        });
        $('input[name=variableSalaryType]:radio').on('click', function (e) {
            updateCtc();
        });
       function updateCtc() {
            var fixcheck  = $('input[name=fixSalaryType]:checked').val();
            var varcheck = $('input[name=variableSalaryType]:checked').val();
            var fixmulti = 0, varmulti = 0;
            if(fixcheck == 'month') {
                fixmulti = 12;
            }
            if(fixcheck == 'annual') {
                fixmulti = 1;
            }
            if(varcheck == 'month') {
                varmulti = 12;
            }
            if(varcheck == 'annual') {
                varmulti = 1;
            }
            var varTotal =  parseInt($('#variableSalary').val().replace(/,/g , ''))*varmulti;
            var fixTotal = parseInt($('#fixSalary').val().replace(/,/g , ''))*fixmulti;
            console.log(varTotal, fixTotal);
            if(isNaN(varTotal)) {
                varTotal = 0;
            }

            if(isNaN(fixTotal)) {
                fixTotal = 0;
            }
            var totalCtc = varTotal+fixTotal;
            if(!isNaN(totalCtc)) {
                totalCtc = formatNumber(totalCtc);
                $('#ctc').val(totalCtc);
                $('#ctc_label').removeClass('active').addClass('active');
            }
       }

    });

</script>


@endsection
