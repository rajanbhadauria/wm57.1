@extends('layouts.app')
@section('content')
  <section class="title-bar">
      <div class="container">
          <div class="row mb0">
              <div class="col s12 pr">
                  <h1>Deactivate / Delete account</h1>
              </div>
          </div>
      </div>
  </section>
  <div class="section wrappit">
    <div class="container">
      <div class="center-wrapper" id="heightSet" >
        <div class="center-container">
          <div class="medium-center-box full-width-xs">
            <div class="row m-0 form-wrapper">
              <div class="">
                <div class="container-card">
                  <div class="notification-banner">Select deactivation period or permanent close. Deactivated account can be activated anytime by your Login credentials</div>
                    <ul class="reset-list-style mb-30">
                      <li class="option-list secondary-card">
                        <div class="option-list__text">Deactivate account</div>
                        <div class="option-list__select">
                            <input class="with-gap numeric" value="deactive" name="account_status" id="deactivate-options1" type="radio"/>
                            <label for="deactivate-options1"></label>
                        </div>
                      </li>
                      <li class="option-list secondary-card">
                        <div class="option-list__text">Close account</div>
                        <div class="option-list__select">
                            <input class="with-gap numeric" name="account_status" value="closed" id="deactivate-options2" type="radio"/>
                            <label for="deactivate-options2"></label>
                        </div>
                      </li>

                  </ul>
                  <div class="row">
                    <div class="col s12 pl0" id="skip">
                        <a href="#delete-acct-alert" id="modelClick" class="modal-trigger waves-effect waves-light btn-blue display-block">Submit</a>
                    </div>
                  </div>
                </div>

                <!-- modal popup -->
                <div id="delete-acct-alert" class="modal warning-modal delete-acct-modal">
                  <div class="modal-content">
                    <div class="modal-ico warning-ico">
                      <i class="material-icons">info_outline</i>
                    </div>
                    <p class="modal-text" id="process-text">Are you sure want to delete your account permanantly?</p>
                  </div>
                  <div class="modal-footer warning-modal-footer">
                    <div class="row m-0 d-flex btn-group">
                      <div class="col s12 m4 custom-submit">
                        <a href="#" id="close-btn" class="modal-close waves-effect waves-light btn-black display-block">Cancel</a>
                      </div>
                      <div class="col s12 m4" id="process-btn-div">
                          <a href="#" class="waves-effect waves-light btn-blue display-block" id="process-btn">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal ends -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function(){

    $("#modelClick").on('click', function(event){
        var input = $("input[name=account_status]:checked").val();
        $("#process-btn-div").show();
        if(input === 'deactive') {
            $("#process-text").text('Are you sure to deactivate your account?');
            $("#process-btn").text('Deactivate');
        }
        if(input === 'closed') {
            $("#process-text").text('Are you sure to close your account?');
            $("#process-btn").text('Close');
        }
        if(typeof input === "undefined") {
            $("#process-text").text('Please select any from the options');
            $("#process-btn-div").hide();
        }
    });

    $("#process-btn").on("click", function(event){
            $.ajax({
                    type:"POST",
                    data: {"_token": "{{ csrf_token()}}", 'account_status': $("input[name=account_status]:checked").val()},
                    dataType : "JSON",
                    url:"{{URL::to('user/deactivate')}}",
                    beforeSend: function(){
                        $(".modal-overlay").click();
                    },
                    success: function(response){
                        if(response.success == true){
                           window.location.href = "{{URL::to('user/deactivateresp')}}?status="+$("input[name=account_status]:checked").val();
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

