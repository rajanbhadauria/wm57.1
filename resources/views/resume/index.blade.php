@extends('layouts.app')
@section('content')
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Resume</h1>
                    <a href="{{ url('/settings') }}" class="waves-effect settings-menu-icon">
                        <i class="material-icons">settings</i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box" id="loginDiv"  >
                <div class="inner-container">
                    <div class="row mb0 action-buttons">
                        <div class="col s3 center-align">
                            <a href="{{ url('/requestresume') }}" class="waves-effect waves-light btn-red-transparent">
                                <i class="material-icons">system_update_alt</i>
                            </a>
                            <p>Receive</p>
                        </div> 
                        <div class="col s3 center-align">
                            <a href="{{ url('/sendresume') }}" class="waves-effect waves-light btn-red-transparent">
                                <i class="material-icons">send</i>
                            </a>
                            <p>Send</p>
                        </div> 
                        <div class="col s3 center-align">
                            <a href="{{URL::to('resume/view') }}" class="waves-effect waves-light btn-red-transparent">
                                <i class="material-icons">visibility</i>
                            </a>
                            <p>View</p>
                        </div> 
                        <div class="col s3 center-align">
                            <a href="{{ URL::to('update') }}" class="waves-effect waves-light btn-red-transparent">
                                <i class="material-icons">edit</i>
                            </a>
                            <p>Update</p>
                        </div> 
                    </div>
                </div>
                <div class="row mb0">
                    <div class="col s12 center-align">
                        <div class="hr mt0"></div>
                        <h5>My resume</h5>
                    </div>
                </div> 
                <div class="row mb0">
                    <div class="col s6 right-align mb15">
                        <a href="{{ url('/myresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                            Sent
                        </a>
                    </div>
                    <div class="col s6 left-align mb15">
                        <span class="btn-aler-holder">
                            <span class="btn-alert-count"> 5 </span>
                            <a href="{{ url('/myresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                                Requested by
                            </a>
                        </span>    
                    </div>
                    <div class="col s6 right-align">
                        <a href="{{ url('/myresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                            Got forwarded
                        </a>
                    </div>
                    <div class="col s6 left-align">
                        <span class="btn-aler-holder">
                            <span class="btn-alert-count"> 5 </span>
                            <a href="{{ url('/myresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                            Access to  
                        </a>
                        </span>
                        
                    </div>
                </div>
                <div class="row mb0">
                    <div class="col s12 center-align">
                        <div class="hr"></div>
                        <h5>Other's resume</h5>
                    </div>
                </div> 
                <div class="row mb0">
                    <div class="col s6 right-align mb15">
                        <span class="btn-aler-holder">
                            <span class="btn-alert-left-count"> 5 </span>
                            <a href="{{ url('/othersresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                                Received
                            </a>
                        </span>    
                    </div>
                    <div class="col s6 left-align mb15">
                        <a href="{{ url('/othersresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                            Forwarded
                        </a>
                    </div>
                    <div class="col s6 right-align mb15">
                        <a href="{{ url('/othersresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                            I requested
                        </a>
                    </div>
                    <div class="col s6 left-align mb15">
                        <a href="{{ url('/othersresume') }}" class="waves-effect waves-light btn-blue res-button-width">
                            Access
                        </a>
                    </div>
                </div>
            </div>  
          </div>
        </div>  
      </div>
    </div>
@endsection