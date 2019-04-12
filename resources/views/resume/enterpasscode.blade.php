@extends('layouts.app')
@section('content')
<link href="{{my_asset('css/mainresume.css')}}" rel="stylesheet" media="all" />
<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <div class="top-panel">
                    <ul class="panel-actions resumebox-actions">
                        <li><a href="javascript:void(0);"  class="text-primary tooltipped ak-resume-moreFetu" data-position="bottom" data-tooltip="More"><i class="material-icons">more_horiz</i></a></li>
                    </ul>
                    <div class="ak-resume-moreFetuList">
                        <ul>
                            <li><a href="javascript:void(0);"><i class="material-icons tiny">lock_outline</i> Enter passkey</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons tiny">insert_drive_file</i> Request resume</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section wrappit ak-resume-sample">
    <div class="container">
        <div class="center-wrapper" id="heightSet">
            <div class="center-container">
                <div class="big-center-box" id="loginDiv">
                    <div class="inner-half-container">
                        <div class="wrapper resume-wrapper">
                            <div class="ak-otherus-resume-sec">
                            <div class="center center-text">
                                <i class="material-icons medium grey-text text-lighten-2">lock</i>
                            </div>
                            <div class="row akhetxt">{{$user->first_name}} {{$user->last_name}} resume is private with controlled access</div><br /><br>
                            <form class="m-0" method="post" action="{{url('/resume/verify-passcode')}}" id="passcodeSaveForm">
                                {{ csrf_field() }}
                            <input type="hidden" id="url" name="url"  value="{{$id}}">
                            <div class="pass-ky-row resume-control-row center-align ak-otherus-resume-PaKey">
                                <h5>Enter 6 digits passkey <a href="javascript:void(0);" class="ak-reMsseClose ak-repkClose"></a></h5>
                                <div class="num-col col s2">
                                    <input type="text" onkeypress="return isNumberKey(event)" pattern="[0-9]*"
                                        maxlength="1" name="n1" id="n1" value="" class="keycode">
                                </div>
                                <div class="num-col col s2">
                                    <input type="text" onkeypress="return isNumberKey(event)" pattern="[0-9]*"
                                        maxlength="1" name="n2" id="n2" value="" class="keycode">
                                </div>
                                <div class="num-col col s2">
                                    <input type="text" onkeypress="return isNumberKey(event)" pattern="[0-9]*"
                                        maxlength="1" name="n3" id="n3" value="" class="keycode">
                                </div>
                                <div class="num-col col s2">
                                    <input type="text" onkeypress="return isNumberKey(event)" pattern="[0-9]*"
                                        maxlength="1" name="n4" id="n4" value="" class="keycode">
                                </div>
                                <div class="num-col col s2">
                                    <input type="text" onkeypress="return isNumberKey(event)" pattern="[0-9]*"
                                        maxlength="1" name="n5" id="n5" value="" class="keycode">
                                </div>
                                <div class="num-col col s2">
                                    <input type="text" onkeypress="return isNumberKey(event)" pattern="[0-9]*"
                                        maxlength="1" name="n6" id="n6" value="" class="keycode">
                                </div>
                            </div>
                            <div class="ak-otherus-resume-btnsec" style="width:55%;">

                                    <div class="row">
                                            <div class="col m6 s12">
                                                    <i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper">
                                                            <input type= "submit" class="waves-button-input" value="Enter passkey">
                                                    </i>
                                                </div>
                                                <div class="col m6 s12">
                                                    <a href="{{Auth::id() ? 'javascript:requestResume()' : url('login')}}" class="waves-effect waves-light btn-black p-5">Request resume</a>
                                                </div>

                                    </div>
                            </div>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    function requestResume(invite = 1, resend = 1) {
            $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:"{{url('requestresume')}}",
                data:{email: "{{$user->email}}", "_token": "{{csrf_token()}}", option: "email", isResend: "1", message: ""},
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.errorMsg, timeout:3000});
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

        $( "#passcodeSaveForm" ).validate({
                //debug: true,
                rules: {
                    n1: {required: true, maxlength:1, number: true},
                    n2: {required: true, maxlength:1, number: true},
                    n3: {required: true, maxlength:1, number: true},
                    n4: {required: true, maxlength:1, number: true},
                    n5: {required: true, maxlength:1, number: true},
                    n6: {required: true, maxlength:1, number: true},

                },
                messages: {
                    n1: {
                        required: "Required",
                        maxlength: "Only 1 number allowed",
                        number: "Enter vaild number"
                    },
                    n2: {
                        required: "Required",
                        maxlength: "Only 1 number allowed",
                        number: "Enter vaild number"
                    },
                    n3: {
                        required: "Required",
                        maxlength: "Only 1 number allowed",
                        number: "Enter vaild number"
                    },
                    n4: {
                        required: "Required",
                        maxlength: "Only 1 number allowed",
                        number: "Enter vaild number"
                    },
                    n5: {
                        required: "Required",
                        maxlength: "Only 1 number allowed",
                        number: "Enter vaild number"
                    },
                    n6: {
                        required: "Required",
                        maxlength: "Only 1 number allowed",
                        number: "Enter vaild number"
                    },

                },
                errorClass: 'validationError',
                errorElement : 'span',
                //errorLabelContainer: '.validationError',
                errorPlacement: function( error, element ) {
                    //error.insertAfter( element);
                },
                highlight: function (element, errorClass, validClass) {
                    //$(element).parents("span").addClass(errorClass);
                    $(element).addClass('pink lighten-5');
                },
                unhighlight: function (element, errorClass, validClass) {
                    //$(element).parents("span").removeClass(errorClass);
                    $(element).removeClass('pink lighten-5');
                },
                submitHandler: function(form) {
                    $.ajax({
                    type:"POST",
                    dataType: "JSON",
                    url:$("#passcodeSaveForm").attr("action"),
                    data:$("#passcodeSaveForm").serialize(),
                    beforeSend: function(){$("#loading").show();},
                    success: function(response){
                        $("#loading").hide();
                        if(response.error == true){
                            $.notify({ content:response.errorMsg, timeout:3000});
                        } else {
                           window.location.href = "{{url('wm')}}/"+$("#url").val()+"/"+response.passcode;
                        }

                    },
                    error: function(response) {
                        $("#loading").hide();
                    }
                });
                }
            });




            $('#covernote').on('click', function(){
               if($(this).prop('checked')){
                   if(!$(this).hasClass('active')){
                       window.location.href = '/html/covernote.php';
                   }else{
                        $('#covernoteText').show();
                   }

               }else{
                   $('#covernoteText').hide();
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

           $('body').on('keyup', 'input.keycode', function(event)
            {
            var key = event.keyCode || event.charCode;
            var inputs = $('input.keycode');
            if(($(this).val().length === this.size) && key != 32)
            {
                inputs.eq(inputs.index(this) + 1).focus();
            }
            if( key == 8 || key == 46 )
            {
                var indexNum = inputs.index(this);
                if(indexNum != 0)
                {
                    inputs.eq(inputs.index(this)).val('').focus();
                    inputs.eq(inputs.index(this)-1).focus();
                }
            }

            });
        });

    </script>
@endsection
