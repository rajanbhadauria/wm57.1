@extends('layouts.app')
@section('content')
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12">
                    <h1>{{$title}}</h1>
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
                   
                  <h2>{{$greeting}}</h2>
                  <p>{{$message}}</p>
                  @if($title != "Error")
                    <a href="{{URL::to('resume')}}">Click here to continue</a>
                  @endif

              </div>
            </div>  
          </div>
        </div>  
      </div>
    </div>
@endsection