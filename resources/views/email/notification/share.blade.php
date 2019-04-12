@include("email.layout.header")

<div style="font-family:Arial, Helvetica, sans-serif; display:block; margin-top:20px; width:90%">
 <div style="width:100%; display:inline-block; text-align:left;">  <h5>{{$subject}}</h5></div>
    @if($content!="")
    <div style="width:100%; display:inline-block; text-align:left;">
            {!! $content !!}
    </div>
    @endif
</div>
@include("email.layout.footer")
