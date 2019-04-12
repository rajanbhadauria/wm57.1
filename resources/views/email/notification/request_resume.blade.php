@include("email.layout.header")


<div style="font-family:Verdana, Geneva, Tahoma, sans-serif; padding:25px 0px; width:100%; display:block; margin-top:20px; width:100%">
    <h5>{{$from_name}} wants to access your resume.</h5>
    @if($content!="")
    <div style="border:1px solid #000; padding: 15px 5px; width:100%; display:block; font-size:80%;">
            {!! $content !!}
    </div>
    @endif
@include("email.layout.footer")

