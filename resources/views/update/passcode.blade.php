@extends('layouts.app')
@section('content')
<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>My resume passkey</h1>
            </div>
        </div>
    </div>
</section>
<div class="section wrappit">
  <div class="container">
    <div class="center-wrapper" id="heightSet">
      <div class="center-container">
        <div class="ak-custom-center-box" id="loginDiv">
            <div class="ak-comn-title">Give this passkey to other to access your resume directly</div>
            <div class="">
                <form>
                    <div class="access-code-container" id="passkeytext">
                      {{Auth::user()->resume_passcode}}
                    </div>
                    <div class="link-container text-center">
                        <a class="text-primary modal-trigger" href="#confirmChangeBox" id="generatePasskey">{{Auth::user()->resume_passcode != '' ? 'Change' : 'Create'}} passkey</a>
                    </div>
                </form>
            </div>
            <input type="button" id="copyText" class="waves-effect waves-light btn-blue input-btn display-block ak-acs-btn" value="Copy" />
        </div>
      </div>
    </div>
  </div>
</div>
<div class="valign-wrapper">
<div id="confirmChangeBox" class="modal">
    <div class="modal-content">
        <h5 class="center">Change passkey?</h5>
        <p>Resume viewers with old passkey wont be able to view your resume,
            do you continue to change resume passkey?</p>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="green darken-1 waves-effect white-text btn-flat modal-close">No</a>
        <a href="javascript:void(0)" onclick="changePasskey()" class="modal-close red darken-3 white-text waves-effect btn-flat">Yes</a>
    </div>
</div>
</div>
<script>
    function changePasskey() {
        $.ajax({
                    type:"POST",
                    url:"{{url('update/change/passcode')}}",
                    data:{"_token": "{{ csrf_token()}}"},
                    beforeSend: ()=>{
                        $("#passkeytext").html('<marquee behavior="alternate" style="font-size:.6em" direction="right" scrollamount="6" class="red-text">.........</marquee>');
                    },
                    success: function(response){
                        $("#passkeytext").html(response.passcode);
                    },
                    error: (error) => {
                        $("#passkeytext").html('<span class="red-text" style="font-size:.6em"> There is some server error, please try later</span>');
                    }
                });
    }
$(document).ready(()=>{
    $("#copyText").on('click', ()=>{

        var range = document.createRange();
        range.selectNode(document.getElementById('passkeytext'));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        $.notify({ content:"Passkey copied!", timeout:3000});
    });
    $('.modal').modal();
});
</script>
@endsection
