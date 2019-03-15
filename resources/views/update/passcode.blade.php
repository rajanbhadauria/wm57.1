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
                        <a class="text-primary" href="javascript:void(0)" id="generatePasskey">{{Auth::user()->resume_passcode != '' ? 'Change' : 'Create'}} passkey</a>
                    </div>
                </form>
            </div>
            <input type="button" class="waves-effect waves-light btn-blue input-btn display-block ak-acs-btn" value="Copy" />
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(()=>{
    $("#generatePasskey").on('click', ()=>{
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
    });
});
</script>
@endsection
