@extends('layouts.app')
@section('content')
<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>Request resume</h1>
            </div>
        </div>
    </div>
</section>
<section class="section wrappit">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="ak-custom-center-box-big">
                    <div class="p-0" id="loginDiv">
                        <div class="row m-0 form-wrapper">
                            <div class="">
                                <div class="ak-comn-title">You can request / ask for updated floating resume quickly from your known connections. Select option to request via Phone Or Email</div>
                            <form autocomplete="off" class="m-0" action="{{url('requestresume')}}" method="post" name="sendRequestForm" id="sendRequestForm">
                                    {{ csrf_field() }}
                                <div class="custom-form cf-hide mb25">
                                        <ul class="request-resume-options resume-options">
                                            <li class="display-inline">
                                                <input class="with-gap" name="option" type="radio" id="email-option" value="email" checked>
                                                <label for="email-option">Email</label>
                                            </li>
                                            <li class="display-inline">
                                                <input class="with-gap" name="option" type="radio" id="phonenumber-option" value="phone">
                                                <label for="phonenumber-option">Phone number</label>
                                            </li>
                                            <li class="display-inline">
                                                <input class="with-gap" name="option" type="radio" id="wmid-option" value="wmid">
                                                <label for="wmid-option">Workmedian ID</label>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <div id="email-option-content" class="request-resume-tab input-field custom-form">
                                            <input id="email" name="email" type="text" class=" " value=""  required>
                                            <label for="email">Email <span>*</span> </label>
                                        </div>
                                        <div id="phonenumber-option-content" class="request-resume-tab input-field custom-form resume-tab">
                                            <ul class="d-flex mobile-number-field reset-list-style">
                                                <li class="input-field custom-form country-code">
                                                    <div class="input-field">
                                                        <select id="country_code" name="country_code">
                                                                <option value="">Country code</option>
                                                                @foreach($countryCodeList as $key => $val)
                                                                     <option value="{{$val}}">+{{$val}} ({{$countryNameList[$key]}})</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="input-field custom-form">
                                                    <input id="mobile" type="text" name="mobile" class="" value="">
                                                    <label for="mobile">Mobile number <span>*</span> </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="wmid-option-content" class="request-resume-tab input-field custom-form resume-tab">
                                                <input id="wmid" type="text" class="" name="wmid" value="">
                                                <label for="wmid">Enter user's WM ID <span>*</span> </label>
                                        </div>

                                    </div>
                                    <div class="input-field custom-form">
                                        <textarea id="request-resume-message"  class=" " ></textarea>
                                        <label for="request-resume-message">Enter message</label>
                                    </div>

                                    <div class="row">
                                        <div class="col s6 pl0" id="skip">
                                            <a href="#" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        <div class="col s6 pr0  custom-submit">
                                            <input type="hidden" name="id" id="id" value=" ">
                                            <input type="submit"  class="waves-effect waves-light btn-blue input-btn display-block" value="Request" />
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
</section>
<script>

$(document).ready(()=>{

    $( "#sendRequestForm" ).validate({
        ignore: [],
        rules: {
            option: {required: true},
            email: {
                required: function(){
                    if($("input[name='option']:checked").val() == 'email') {
                        return true;
                    } else {
                        return false;
                    }
                },
                email: true
            },
            mobile: {
                required: function(){
                    if($("input[name='option']:checked").val() == 'phone') {
                        return true;
                    } else {
                        return false;
                    }
                },
                number: true
            },

            country_code: {
                required: function(){
                    if($("input[name='option']:checked").val() == 'phone') {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            wmid: {
                required: function(){
                    if($("input[name='option']:checked").val() == 'wmid') {
                        return true;
                    } else {
                        return false;
                    }
                },

            },

        },
        messages: {
            option: {
                required: "Required"
            },
            wmid: {
                required: "Required"
            },
            email: {
                required: "Required",
                email: "Enter vaild email"
            },
            mobile: {
                required: "Required",
                number: "Enter vaild phone"
            },
            country_code: {
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
            $.ajax({
            type:"POST",
            dataType: "JSON",
            url:$("#sendRequestForm").attr("action"),
            data:$("#sendRequestForm").serialize(),
            beforeSend: function(){$("#loading").show();},
            success: function(response){
                $("#loading").hide();
                if(response.error == true){
                    $.notify({ content:response.errorMsg, timeout:3000});
                } else {

                    window.location.reload();// = "{{url('resume/view')}}";
                }

            },
            error: function(response) {
                $("#loading").hide();
            }
        });
        }
    });
    $(".with-gap").on('click', function(){
        $(".request-resume-tab").hide();
        if($("input[name='option']:checked").val() === 'email') {
            $("#email-option-content").show();
        }
        if($("input[name='option']:checked").val() === 'phone') {
            $("#phonenumber-option-content").show();
        }
        if($("input[name='option']:checked").val() === 'wmid') {
            $("#wmid-option-content").show();
        }
    });
});

</script>
@endsection
