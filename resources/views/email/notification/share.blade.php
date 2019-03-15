@include("email.layout.header")


<h2>{{$from}} share his resume with you.</h2>


<p>Subject : {{$subject}}</p>

<p>Message : {!! $content !!}</p>




@include("email.layout.footer")
