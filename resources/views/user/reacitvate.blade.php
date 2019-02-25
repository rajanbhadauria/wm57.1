@extends('layouts.app')
@section('content')
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12">
                    <h1>Activate closed account</h1>
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

                  <h2></h2>
                  <p>
                        Your account ({{$email}}) has been closed, currently you can not use WorkMedian. For getting your account up click <a href="javascript:void(0);" id="activateAccount">here</a><br>( i agree to <a href="javascript:void(0);">terms</a> and <a href="javascript:void(0);">policy</a>)
                  </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<script>
$(document).ready(function(){
    $("#activateAccount").on("click", function(event){
            $.ajax({
                    type:"POST",
                    data: {"_token": "{{ csrf_token()}}", 'email': "{{$email}}"},
                    dataType : "JSON",
                    url:"{{URL::to('closed-activate')}}",
                    beforeSend: function(){
                        $(".modal-overlay").click();
                    },
                    success: function(response){
                        if(response.success == true){
                           window.location.href = "{{URL::to('login')}}";
                        }
                        else{
                            $.notify(response.message, "error");
                        }
                    }
                });
        });
});
</script>
@endsection
