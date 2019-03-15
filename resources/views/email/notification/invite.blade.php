@include("email.layout.header")
<h3>Sign up request for WorkMedian </h3>
<h3>{{$from}} share his resume with you on Work median.</h3>
<p><a href="{{URL::to('register')}}">click here</a> for sign up</p>
<p>Message : {!! $content !!}</p>
@include("email.layout.footer")
