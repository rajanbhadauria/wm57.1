@extends('layouts.app')
@section('content')

<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>Invite a friend  / connection</h1>
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
                                <div class="ak-comn-title">You can invite a friend / connection by entering their valid email or / and mobile number</div>
                            <form autocomplete="off" class="m-0 container-card" id="inviteForm" action="{{url('invite')}}" method="POST" >
                                {{ csrf_field() }}
                                    <ul class="reset-list-style">
                                        <li class="input-field custom-form">
                                            <input id="email" name="email" type="text" class=" " value=""  required>
                                            <label for="email">Email <span>*</span> </label>
                                        </li>
                                       <!-- <li class="input-field custom-form">
                                            <ul class="d-flex mobile-number-field">
                                                <li class="input-field custom-form country-code">
                                                    <div class="input-field">
                                                        <label class="active">Country code</label>
                                                        <select id="country-code" name="yyyyStart">
                                                            <option value="" selected>Country code</option>
                                                            <option value="">+91</option>
                                                            <option value="">+01</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li class="input-field custom-form">
                                                    <input id="mobile-number" type="text" class=" " value=""  required>
                                                    <label for="mobile-number">Mobile number <span>*</span> </label>
                                                </li>
                                            </ul>
                                        </li> -->
                                        <li class="input-field custom-form">
                                            <textarea id="message" name="message"  class=" " ></textarea>
                                            <label for="message">Enter message</label>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col s6 pl0" id="skip">
                                        <a href="{{url('home')}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                        </div>
                                        <div class="col s6 pr0 custom-submit">
                                            <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Invite" />
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
 $(document).ready(function(){
    $( "#inviteForm" ).validate({
            ignore: [],
            rules: {
                email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                email: {
                    required: "Required",
                    email: "Enter vaild email"
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
                url:"{{url('user/invite')}}",
                data:$("#inviteForm").serialize(),
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                    	$('#success').css({'visibility': 'visible'});
                        window.location.href = "{{url('resume/track')}}";
                    }

                },
                error: function(response) {
                    $("#loading").hide();
                    $.notify({ content:"There is some server error please try later.", timeout:3000});
                }
            });
            }
        });
    });
</script>
@endsection
