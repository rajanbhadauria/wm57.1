@include("email.layout.header")
<div style="font-family:Verdana, Geneva, Tahoma, sans-serif; background-color:#f4f4f4; padding:5px 10px;">
<h2>{{$from}} wants to access your resume.</h2>
<p>Message : {!! $content !!}</p>
</div>
@include("email.layout.footer")
