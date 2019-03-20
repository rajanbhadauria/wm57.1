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
                                        <div class="custom-from cf-hide mb25">
                                            <div class="form-control">
                                                    <input type="radio" class="with-gap" name="is_secure" id="is_secure1" value="0" checked>
                                                    <label for="is_secure1">Copy link - Secure (User need passkey)</label>
                                            </div>
                                            <div class="form-control">
                                                    <input type="radio" class="with-gap" name="is_secure" id="is_secure2" value="1">
                                                    <label for="is_secure2">Copy link - Public (User direct access)</label>
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
<div id="modelBox" class="modal">
    <div class="modal-content">
        <h4>Invite User</h4>
        <p>User is not existing in our network. Do you want to invite him to join our network?</p>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="modal-close green darken-1 waves-effect white-text waves-green btn-flat" onclick="refreshPage()">No</a>
        <a href="javascript:void(0);" class="modal-close red darken-3 white-text waves-effect waves-green btn-flat" onclick="invite()">Yes</a>
      </div>
</div>
<a data-target="modelBox" id="modelTigger" class="btn modal-trigger hide"></a>
<script>
    function refreshPage() {
        window.location.href = "{{url('resume/view')}}";
    }
    // inviting user to view his resume
    function invite() {
        $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:"{{url('resume/invite')}}",
                data:$("#sendSaveForm").serialize(),
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                        window.location.href = "{{url('resume/view')}}";
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
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                    	$('#success').css({'visibility': 'visible'});
                    if(response.invite_user == '1') {
                       // $("#modelTigger").trigger('click');
                       $('.modal').modal('open');
                    } else {
                        window.location.href = "{{url('resume/view')}}";
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
    });
</script>
@endsection
