@extends('layouts.app')
@section('content')
    <!-- Inner page code -->
	<section class="title-bar">
	  <div class="container">
		<div class="row mb0">
		  <div class="col s12 pr">
			<div class="top-panel">
			  <h1>Resume accessed members</h1>

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

				<ul class="collection-thumb ak-collection-thumb">
                    <?php if(count($users)>0) {
                        foreach($users as $user) {
                            $work = getWorkInfo($user->id);
                            $resume = App\Model\Resume::getResumeAccess(Auth::user()->email, $user->email);
                            $user1Obj = App\Helpers\Activity::getUserDetails($user->byUser);
                            $user2Obj = App\Helpers\Activity::getUserDetails($user->forUser);
                            $user3Obj = App\Helpers\Activity::getUserDetails($user->toUser);

                            $user1 = ($user1Obj) ? $user1Obj->first_name." ".$user1Obj->last_name : $user->email;
                            $user2 = ($user2Obj) ? $user2Obj->first_name." ".$user2Obj->last_name : $user->email;
                            $user3 = ($user3Obj) ? $user3Obj->first_name." ".$user3Obj->last_name : $user->email;

                            $activity_message = str_replace(["{%user1%}", "{%user2%}", "{%user3%}"], [$user1, $user2, $user3], $user->activity_text);
                            if($resume) {
                                $url = explode("/",$resume->resume_url);
                            } else {
                                $url = [];
                            }
                            if(count($url)>1) {
                                $activity_message = str_replace(["has sent", "forwarded123"], ["has sent with passcode", "forwarded with passcode"], $activity_message);
                            } else {
                                $activity_message = str_replace(["has sent", "forwarded12321"], ["has sent without passcode", "forwarded without passcode"], $activity_message);
                            }
                     ?>
					<li class="collection-item collection-item-hover-active">
                        <img src="{{get_user_image($user->avatar)}}" alt="{{$user->name}}"  class="circle ak-collection-img"/>
                        <div class="ak-collection-content">
						<div class="title">{{$user->first_name}} {{$user->last_name}}</div>
                        @if($work)
                        <div class="deg">{{$work->designation}}</div>
						<div class="company">{{$work->company}}</div>
                        <div class="date">{{$work->city}} &#183; {{$work->country}}</div>
                        @endif
                        <div class="deg">{{$activity_message}}</div>
                        <div class="collection-item-btn right">
                                <div class="switch">
                                    <label>
                                     <form autocomplete="off" action="{{url('update-resume-access')}}" method="post">
                                            {{ csrf_field() }}
                                     <input type="hidden" name="user" value="{{base64_encode($user->email)}}">
                                        @if($resume  && $resume->is_visible == "1")
                                        <input type="checkbox" value="1" name="is_visible" onchange="updateAccess(this)" checked>
                                        @else
                                        <input type="checkbox" value="0" name="is_visible" onchange="updateAccess(this)">
                                        @endif
                                        <span class="lever"></span>
                                    </form>
                                    </label>
                                </div>
                        </div>
                    </div>

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
