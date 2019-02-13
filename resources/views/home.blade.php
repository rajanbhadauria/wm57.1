@extends('layouts.app')
@section('content')
<section class="title-bar">
  <div class="container">
    <div class="row mb0">
      <div class="col s12 pr">
        <div class="top-panel">
          <h1>Home</h1>
          <ul class="panel-actions">
            <!-- <li>
              <a class="waves-effect" href="{{ url('/memberlist') }}"><i class="material-icons">search</i> </a>
            </li> -->
            <li class="p-relative">
              <a class="waves-effect" href="{{ url('/resumebox') }}" class="icon-overlap">
                <i class="material-icons">cloud</i>
                <i class="material-icons second-ico">brightness_1</i>
              </a>
            </li>
            <li class="notification-blck">
              <a class="waves-effect" href="{{ url('/notifications') }}">
                <i class="material-icons">notifications</i>
                <i class="material-icons dot">brightness_1</i>
              </a>
            </li>
            <!-- <li>
              <a class="waves-effect" href="{{ url('/settings') }}"><i class="material-icons">settings</i> </a>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="section wrappit secondary-bg">
  <div class="container">
    <div class="center-wrapper" id="heightSet">
      <div class="center-container">
        <div id="loginDiv">
          <div class="row widget-container">
            <div class="col s6 m6">
              <div class="widget-block">
                <div class="widget-block__title">
                  <i class="material-icons">update</i>
                  <h3>Update resume</h3>
                </div>
                <div class="widget-block__body">
                  <p>Keep real time <a class="text-primary" href="{{ url('/update') }}">update</a> of your
                    <a class="text-primary" href="{{ url('/resume') }}">resume</a></p>
                  <a href="{{ url('/update') }}" class="waves-effect waves-light btn-black display-block">Update</a>
                </div>
              </div>
            </div>

            <div class="col s6 m6">
              <div class="widget-block">
                <div class="widget-block__title">
                  <i class="material-icons">visibility</i>
                  <h3>View resume</h3>
                </div>
                <div class="widget-block__body">
                  <p>
                    <a class="text-primary" href="{{url('/resumesample')}}">View</a> your <a class="text-primary" href="{{ url('/resume') }}">resume</a> anywhere, <a class="text-primary" href="{{ url('/update') }}">update</a> and
                    <a class="text-primary" href="{{ url('/forwardresume') }}">send</a> it
                  </p>
                  <a href="{{url('/resumesample')}}" class="waves-effect waves-light btn-black display-block">View</a>
                </div>
              </div>
            </div>


            <div class="col s6 m6">
              <div class="widget-block">
                <div class="widget-block__title">
                  <i class="material-icons">cloud_download</i>
                  <h3>Resumebox</h3>
                </div>
                <div class="widget-block__body">
                  <p><a class="text-primary" href="{{ url('/requestresume') }}">Request</a> resume and
                    grow your <a class="text-primary" href="{{ url('/resumebox') }}">resumebox</a></p>
                  <a href="{{ url('/requestresume') }}" class="waves-effect waves-light btn-black display-block">Request</a>
                </div>
              </div>
            </div>

            <div class="col s6 m6">
              <div class="widget-block">
                <div class="widget-block__title">
                  <i class="material-icons icon-flipped">reply</i>
                  <h3>Power share</h3>
                </div>
                <div class="widget-block__body">
                  <p>Use your <a class="text-primary" href="{{ url('/socialmediaverification') }}">social network</a> and
                    <a class="text-primary" href="{{ url('/recommend') }}">share</a> requirements</p>
                  <a href="{{ url('/recommend') }}" class="waves-effect waves-light btn-black display-block">Share</a>
                </div>
              </div>
            </div>
          </div>
          <!--  <a href="{{ url('/resume') }}" class="waves-effect waves-light btn-blue display-block">Resume</a> -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
