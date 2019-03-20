@include("email.layout.header")
<div style="font-family:Verdana, Geneva, Tahoma, sans-serif; background-color:#f4f4f4; padding:5px 10px;">
<h2>{{$subject}}</h2>
<p>{!! $content !!}</p>
</div>
@include("email.layout.footer")
