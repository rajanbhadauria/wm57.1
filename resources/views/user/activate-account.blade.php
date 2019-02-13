@extends('layouts.app')
@section('content')
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12">
                    <h1>Account pending for activation</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="center-box">
              <div class="message-box" id="loginDiv"  >
                   
                  <h2>Thank You!</h2>
                  <p>Please check your email box an activation link has been sent to you</p>
                  <h4>Or</h4>
                  <h6><a href="javascript:void(0)" id="resend">Click here</a> to resend activation link</h6>
                  <p id="loader">Sending activation link...</p>
              </div>
            </div>  
          </div>
        </div>  
      </div>
    </div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#loader").hide();
    $("#resend").on("click", function(){
        $.ajax({
            type:"GET",
            url:"{{URL::to('resend-activation')}}",
            beforeSend: function(){
              $("#loader").show();
            },
            success: function(response){
              $("#loader").html("Sent");
            }
        });
    });
  });
</script>
@endsection