@extends('layouts.app')
@section('content')
<section class="title-bar">
    <div class="container">
      <div class="row mb0">
        <div class="col s12 pr">
          <div class="top-panel">
            <h1>Resume update option</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="section wrappit secondary-bg">
    <div class="container">
      <div class="center-wrapper" id="heightSet">
        <div class="center-container ak-container">
        <div class="center-box">
          <div id="loginDiv">
            <div class="row widget-container">
              <div class="col s12 ak-heading">You can update / directly upload your resume</div>
                  <div class="col s12">
                    <div class="widget-block ak-wblock akftimelog">
                        <h5 class="ak-uploadText">Update</h5>
                        <p class="ak-uploadLtext">On website</p>
                        <a href="{{url('update')}}" class="ak-custom-update-btn">Update Now</a>
                    </div>
                  </div>
                  <div class="col s12">
                    <form action="{{url('resume/upload')}}" id="resumeUploadForm" enctype="multipart/form-data">
                        <div class="widget-block ak-wblock akftimelog">
                            @if(Auth::user()->resume_file == "")
                            <h5 class="ak-uploadText">Upload</h5>
                            <p class="ak-uploadLtext center">(PDF / Doc)</p>
                            <input type="file" name="resumeFile" id="resumeFile" class="ak-custom-file-input">
                            @else

                            <p class="ak-uploadLtext center">
                            <a href="{{url('resume/my_download')}}" class="btn blue darken-2 white-text"><i class="left white-text material-icons">file_download</i> Download</a>
                            <a href="{{url('resume/my_delete_resume')}}" class="btn orange darken-4 white-text"><i class="left white-text material-icons">delete_forever</i> Delete</a>
                            </p>
                            @endif
                        </div>
                    </form>
                  </div>
                  <div class="col s12 hide">
                    <div class="widget-block ak-wblock akftimelog">
                        <h5 class="ak-uploadText">LinkedIn import</h5>
                        <p class="ak-uploadLtext">(PDF / Doc)</p>
                        <p class="ak-uploadLtext">
                            <input type="file" class="ak-custom-file-input">
                        </p>
                    </div>
                  </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(()=>{
    $("#resumeFile").on('change', ()=>{
        var formData = new FormData();
        var prop = document.getElementById('resumeFile').files[0];
        formData.append('resume', prop);
        formData.append('_token', "{{csrf_token()}}")

        $.ajax({
                type:"POST",
                dataType: "JSON",
                data:  formData, contentType: false, cache: false, processData:false,
                url:$("#resumeUploadForm").attr("action"),
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                    	$('#success').css({'visibility': 'visible'});
                        window.location.href = "{{url('update/options')}}";
                    }
                },
                error: function(response) {
                    $("#loading").hide();
                }
            });
    });
  });
  </script>
  @endsection
