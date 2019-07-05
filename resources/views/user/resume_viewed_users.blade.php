@extends('layouts.app')
@section('content')
    <!-- Inner page code -->
	<section class="title-bar">
	  <div class="container">
		<div class="row mb0">
		  <div class="col s12 pr">
			<div class="top-panel">
			  <h1>Resume viewed members</h1>

			</div>
		  </div>
		</div>
	  </div>
	</section>

	<div class="section wrappit secondary-bg">
	  <div class="container">
		<div class="center-wrapper1" id="heightSet">
		  <div class="center-container ak-full-container">
			<div class="ak-full-center-box" id="loginDiv">
			<div class="">
			  <div class="widget-container">

				<ul class="collection-thumb ak-colcThumMem">
                    <?php if(count($users)>0) {
                        foreach($users as $user) {
                            $work = getWorkInfo($user->id);
                            $resume = app\Model\Resume::getResumeAccess(Auth::user()->email, $user->email);
                     ?>
					<li class="collection-item collection-item-hover-active">
                        <img src="{{get_user_image($user->avatar)}}" alt="{{$user->name}}"  class="circle"/>
						<div class="title">{{$user->first_name}} {{$user->last_name}}</div>
                        @if($work)
                        <div class="deg">{{$work->designation}}</div>
						<div class="company">{{$work->company}}</div>
                        <div class="date">{{$work->city}} &#183; {{$work->country}}</div>
                        @endif
                        <div class="date">{{Carbon\Carbon::parse($user->last_viewed_at)->diffForHumans()}}</div>
                    </li>
                <?php } ?>

                <?php }?>
				</ul>
                {{$users->links()}}
			  </div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
    @endsection
    <script>
        function updateAccess(obj) {
            $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:"{{url('resume-accessed-user')}}",
                data:$(obj).closest('form').serializeArray(),
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    }
                },
                error: function(response) {
                    $("#loading").hide();
                    $.notify({ content:"There is some server error.", timeout:3000});
                }
            });
        }
    </script>
