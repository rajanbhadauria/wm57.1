@extends('layouts.app')
@section('content')
  <section class="title-bar">
      <div class="container">
          <div class="row mb0">
              <div class="col s12 pr">
                  <h1>Settings</h1>
              </div>
          </div>
      </div>
  </section>
  <div class="section wrappit">
    <div class="container">
      <div class="center-wrapper" id="heightSet" >
        <div class="center-container">
          <div class="medium-center-box full-width-xs">
            <div class="form-wrapper">
              <div class="container-card">
                <ul class="reset-list-style settings-menu">
                  <li class="settings-title">
                   <label for="">User account ({{Auth::user()->wmid}})</label>
                  </li>
                  <li>
                      <a class="waves-effect waves-light-grey" href="{{ url('/postsignup') }}"><span>Basic user information</span><span class="warn-ico rotate180"><i class="material-icons">info</i></span>  <i class="material-icons">chevron_right</i></a>
                  </li>
                  <li>
                    <a class="waves-effect waves-light-grey" href="{{URL::to('/change-password')}}"><span>Change password</span><i class="material-icons">chevron_right</i></a>
                  </li>
                  <li>
                    <a class="waves-effect waves-light-grey" href="{{URL::to('user/profile-image')}}"><span>Change profile image</span><i class="material-icons">chevron_right</i></a>
                  </li>
                  <li class="no-border">
                    <a class="waves-effect waves-light-grey" href="{{ url('/deactivate') }}">Deactivate / Delete account<i class="material-icons">chevron_right</i></a>
                  </li>
                  <li class="settings-title">
                    <label for="">Job seeker</label>
                  </li>
                  <li>
                    <a class="waves-effect waves-light-grey" href="{{ url('/jobseekingstatus') }}">Job seeking status <i class="material-icons">chevron_right</i></a>
                  </li>
                  <li>
                    <a class="waves-effect waves-light-grey" href="{{ url('resume/styles') }}">Resume Style <i class="material-icons">chevron_right</i></a>
                  </li>
                  <li class="switch-item">
                    <span>Make resume public</span>
                    <div class="switch">
                          <label>
                              <input type="checkbox">
                              <span class = "lever"></span>
                          </label>
                      </div>
                  </li>
                  <li class="switch-item">
                    <span>Display email</span>
                    <div class="switch">
                      <label>
                          <input type="checkbox">
                          <span class = "lever"></span>
                      </label>
                    </div>
                  </li>
                  <li class="switch-item">
                    <span>Display mobile</span>
                    <div class="switch">
                      <label>
                          <input type="checkbox">
                          <span class = "lever"></span>
                      </label>
                    </div>
                  </li>
                  <li class="switch-item no-border">
                    <span>Allow to view my resume</span>
                    <span class="warn-ico rotate180"><i class="material-icons">info</i></span>
                    <div class="switch">
                      <label>
                          <input type="checkbox">
                          <span class = "lever"></span>
                      </label>
                    </div>
                  </li>
                  <li class="settings-title">
                    <label for="">Account verification</label>
                  </li>
                  <li>
                    <a class="waves-effect waves-light-grey" href="{{ url('/emailverification') }}">Email<span class="warn-ico rotate180"><i class="material-icons">info</i></span> <i class="material-icons">chevron_right</i></a>
                  </li>
                  <li>
                    <a  class="waves-effect waves-light-grey" href="{{ url('/phoneverification') }}">Mobile<span class="warn-ico rotate180"><i class="material-icons">info</i></span> <i class="material-icons">chevron_right</i></a>
                  </li>
                  <li class="no-border">
                    <a class="waves-effect waves-light-grey" href="{{ url('/socialmediaverification') }}">Social<i class="material-icons">chevron_right</i></a>
                  </li>
                  <li class="settings-title">
                    <label for="">Social media sharing</label>
                  </li>
                  <li class="switch-item">
                    <span>Google</span>
                    <div class="switch">
                          <label>
                              <input type="checkbox">
                              <span class = "lever"></span>
                          </label>
                      </div>
                  </li>
                  <li class="switch-item">
                    <span>Linkedin</span>
                    <div class="switch">
                      <label>
                          <input type="checkbox">
                          <span class = "lever"></span>
                      </label>
                    </div>
                  </li>
                  <li class="switch-item no-border">
                    <span>Facebook</span>
                    <div class="switch">
                      <label>
                          <input type="checkbox">
                          <span class = "lever"></span>
                      </label>
                    </div>
                  </li>
                  <li class="settings-title">
                    <label for="">Payment</label>
                  </li>
                  <li>
                    <a href="">Account balance <i class="material-icons">chevron_right</i></a>
                  </li>
                  <li>
                    <a href="">Add credits <i class="material-icons">chevron_right</i></a>
                  </li>
                  <li>
                    <a href="">Payment terms<i class="material-icons">chevron_right</i></a>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

