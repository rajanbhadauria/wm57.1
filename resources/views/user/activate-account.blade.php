@extends('layouts.app')
@section('content')
<section class="title-bar">
	  <div class="container">
		<div class="row mb0">
		  <div class="col s12 pr">
			<div class="top-panel">
			  <h1>Pending account activation</h1>
			</div>
		  </div>
		</div>
	  </div>
	</section>
	<div class="section wrappit secondary-bg">
	  <div class="container">
		<div class="center-wrapper" id="heightSet">
		  <div class="center-container">
			<div class="ak-custom-center-box" id="loginDiv">
			<div class="">
				<div class="container-card">
				  <div class="notification-ico">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
					  <circle class="path circle" fill="none" stroke="#5cb85c" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
					  <polyline class="path check" fill="none" stroke="#5cb85c" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
					</svg>
				  </div>
				  <div class="text-center">
                  <h2>Account activation required</h2>
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
              $("#loader").addClass("green-text");
            }
        });
    });
  });
</script>
@endsection
