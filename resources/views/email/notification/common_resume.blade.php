@include("email.layout.header")
<div style="font-family:Arial, Helvetica, sans-serif; display:block; margin-top:20px; width:90%">
    <h5>{{$subject}}</h5>
    @if($content!="")
    <div style="border:1px solid #000; padding: 15px 5px; width:100%; display:block; font-size:100%;">
            {!! $content !!}
    </div>
    @endif
@include("email.layout.footer")
