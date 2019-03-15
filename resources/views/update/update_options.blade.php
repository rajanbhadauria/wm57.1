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
                    <div class="widget-block ak-wblock akftimelog">
                        <h5 class="ak-uploadText">Upload</h5>
                        <p class="ak-uploadLtext">(PDF / Doc)</p>
                        <input type="file" class="ak-custom-file-input">
                    </div>
                  </div>
                  <div class="col s12 hide">
                    <div class="widget-block ak-wblock akftimelog">
                        <h5 class="ak-uploadText">LinkedIn import</h5>
                        <p class="ak-uploadLtext">(PDF / Doc)</p>
                        <input type="file" class="ak-custom-file-input">
                    </div>
                  </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
