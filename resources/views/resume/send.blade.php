@extends('layouts.app')
@section('content')
<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>Send my resume</h1>
            </div>
        </div>
    </div>
</section>
<section class="section wrappit">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="ak-custom-center-box">
                    <div class="p-0" id="loginDiv">
                        <div class="row m-0 form-wrapper">
                            <div class="">
                                <div class="ak-comn-title">Choose mail or phone option to send your resume. You may <a class="text-primary"
                                             href="{{ url('/update') }}">edit</a> or <a class="text-primary" href="{{ url('/update') }}">update</a> or
                                            <a class="text-primary" href="{{ url('/resume') }}">view</a> your resume before you send</div>
                                <form class="m-0" method="post" action="{{url('/resume/send-save')}}" id="sendSaveForm">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="request" value="sendResume">
                                        <input type="hidden" name="isResend" id="isResend" value="0">
                                        <div class="custom-from cf-hide mb25">
                                            <div class="form-control">
                                                    <input type="radio" class="with-gap" name="is_secure" id="is_secure1" value="0" checked>
                                                    <label for="is_secure1">
                                                        {{$url1}} (Passkey would be required)
                                                    </label>
                                            </div>
                                            <div class="form-control">
                                                    <input type="radio" class="with-gap" name="is_secure" id="is_secure2" value="1">
                                            <label for="is_secure2">{{$url2}} (Passkey is not required)</label>
                                            </div>
                                        </div>
                                              <div class="clearfix">&nbsp;</div>
                                    <div class="custom-form cf-hide mb25">
                                        <ul class="send-resume-options resume-options">
                                            <li class="display-inline">
                                                <input autocomplete="false" class="with-gap" name="option" type="radio" id="email-option" value="email" checked>
                                                <label for="email-option">Email</label>
                                            </li>
                                            <li class="display-inline">
                                                <input autocomplete="false" class="with-gap" name="option" type="radio" id="phonenumber-option" value="phone">
                                                <label for="phonenumber-option">Phone number</label>
                                            </li>

                                        </ul>
                                    </div>
                                    <div>
                                        <div id="email-option-content" class="send-resume-tab input-field custom-form">
                                            <input id="send-resume-email" name="email" type="text" class="" value="" required>
                                            <label for="send-resume-email">Email <span>*</span> </label>
                                        </div>
                                        <div id="phonenumber_options" class="send-resume-tab input-field custom-form" style="display:none">
                                            <ul class="d-flex mobile-number-field reset-list-style">
                                                <li class="input-field custom-form country-code">
                                                    <div class="input-field">
                                                        <label for="country_code" class="active">Country code</label>
                                                       <select id="country_code" name="country_code" required>
                                                            <option value="">Country code</option>
                                                            @foreach($countryCodeList as $key => $val)
                                                                 <option value="{{$val}}">+{{$val}} ({{$countryNameList[$key]}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="input-field custom-form">
                                                    <input id="mobile_number" name="mobile_number" type="text" class=" " value="" required>
                                                    <label for="mobile_number">Mobile number <span>*</span> </label>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="input-field custom-form">
                                        <textarea id="send-resume-message" name="message" class="text-hgt"></textarea>
                                        <label for="send-resume-message">Enter message</label>
                                    </div>

                                    <div class="row mb0">
                                        <div class="col s6 pl0" id="skip">
                                            <a href="resumesample.html" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{$profileData->wmid}}">
                                            <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Send" />
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
<div id="modelBoxInvite" class="modal">
    <div class="modal-content">
        <h4 class="green-text text-darken-4"> Resume sent !</h4>
        <p>
            We found that user is not on WorkMedian, would you like to invite <span class="blue-text text-darken-4 email-span"></span> ?
        </p>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-close green darken-1 waves-effect white-text btn-flat" onclick="redirectToActivity()">No</a>
        <a href="javascript:void(0);" class="modal-close red darken-3 white-text waves-effect btn-flat" onclick="invite(1, 1)">Yes</a>
      </div>
</div>

<div id="modelBoxResend" class="modal">
    <div class="modal-content">
        <h4>Re send ?</h4>
        <p>You have already sent your resume to <span class="blue-text text-darken-4 email-span"></span> do you want to send again ?</p>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-close green darken-1 waves-effect white-text btn-flat" onclick="redirectToActivity()">No</a>
        <a href="javascript:void(0);" class="modal-close red darken-3 white-text waves-effect btn-flat" onclick="resend()">Yes</a>
      </div>
</div>

<script>
    function resend() {
        $("#isResend").val('1');
        $("#sendSaveForm").submit();
    }
    function redirectToActivity() {
        window.location.href = "{{url('resume/track')}}";
    }
    // inviting user to view his resume
    function invite(invite = 0, resend = 0) {
        $.ajax({
                type:"POST",
               	dataType: "JSON",
                url: "{{url('resume/send-invitation')}}",
                data:$("#sendSaveForm").serialize() + '&isInvite=' + invite+'&isResend='+resend,
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                        window.location.href = "{{url('resume/track')}}";
                    }

                },
                error: function(response) {
                    $("#loading").hide();
                }
            });
    }

    $(document).ready(function(){
    $( "#sendSaveForm" ).validate({
            ignore: [],
            rules: {
                option: {required: true},
                email: {
                    required: function(){
                        if($("input[name='option']:checked").val() === 'email') {
                            return true
                        } else { return false;}
                    },
                    email: true
                },
                mobile_number: {
                    required: function(){
                        if($("input[name='option']:checked").val() === 'phone') {
                            return true;
                        } else { return false;}
                    },

                },
                country_code: {
                    required: function(){
                        if($("input[name='option']:checked").val() === 'phone') {
                            return true;
                        } else { return false;}
                    }
                },

            },
            messages: {
                option: {
                    required: "Required"
                },
                email: {
                    required: "Required",
                    email: "Enter vaild email"
                },
                mobile_number: {
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
                url:$("#sendSaveForm").attr("action"),
                data:$("#sendSaveForm").serialize(),
                beforeSend: function(){$("#loading").show();$(".email-span").html("");},
                success: function(response){
                    var redirectFlag = 1;
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                        if(response.invite_user == '1') {
                            $(".email-span").html($("#send-resume-email").val());
                            $('#modelBoxInvite').modal('open');
                           redirectFlag = 0;
                        }
                        if(response.resend_invitation == '1') {
                            $(".email-span").html($("#send-resume-email").val());
                            $('#modelBoxResend').modal('open');
                            redirectFlag = 0;
                        }
                        if(redirectFlag == 1) {
                            window.location.href = "{{url('resume/track')}}";
                        }
                    }
                },
                error: function(response) {
                    $("#loading").hide();
                }
            });
            }
        });

       $(".with-gap").on('click', function(){

        if($("input[name='option']:checked").val() === 'email') {
            $("#phonenumber_options").hide();
            $("#email-option-content").show();
        }
        if($("input[name='option']:checked").val() === 'phone') {
            $("#email-option-content").hide();
            $("#phonenumber_options").show();
        }
       });
       // init model
       $('.modal').modal();

    $( "#send-resume-email" ).autocomplete({
      source: "{{url('user/search')}}",
      minLength: 2,
      select: function( event, ui ) {
            $( "#send-resume-email" ).val(ui.item.id); //ui.item is your object from the array
            return false;
        }
    });

    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
