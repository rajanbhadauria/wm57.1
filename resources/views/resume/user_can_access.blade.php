<!-- Inner page code -->
@extends('layouts.app')
@section('content')
<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12 pr">
                <h1>{{$page_title}}</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="section wrappit">
		<div class="container">
			<div class="center-wrapper" id="heightSet">
				<div class="center-container ak-full-container">
					<div class="ak-full-center-box">
						<div class="">

							<ul class="resume-user__list">
                                <?php foreach($users as $user) {
                                    $fwdUserName = "";
                                    $result = App\Helpers\Activity::getUserDetails($user->userEmail);
                                    if($user->activity == 'resume_forwarded') {
                                        $fwdUser = App\Helpers\Activity::getUserDetails($user->byUser);
                                        $fwdUserName = $fwdUser->name;
                                    }
                                     if($result) {
                                         $name = $result->name;
                                     } else {
                                         $name = $user->userEmail;
                                     }
                                    ?>
                                    <li class="container-card">
                                        <div class="resume-user__list-img center-align">
                                            @if($result)
                                            <img src="{{get_user_image($result->avatar)}}" alt="{{$result->name}}" class="circle small"/>
                                            @else
                                            <img src="{{get_user_image("")}}" alt="{{$name}}" class="circle small"/>
                                            @endif
                                        </div>
                                        <div class="resume-user__list-content">
                                            <div class="resume-user__list-content-in">
                                            <p>{{$name}}
                                                <span>
                                                   {{Carbon\Carbon::parse($user->updated_at)->diffForHumans()}}
                                                </span>
                                                <div class="switch right col s2">
                                                        <label>
                                                            <form autocomplete="off" action="{{url('update-resume-access')}}" method="post">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="user" value="{{base64_encode($user->userEmail)}}">
                                                                @if($user->is_visible == "1")
                                                                <input type="checkbox" value="1" name="is_visible" onchange="updateAccess(this)" checked>
                                                                @else
                                                                <input type="checkbox" value="0" name="is_visible" onchange="updateAccess(this)">
                                                                @endif
                                                                <span class="lever"></span>
                                                            </form>
                                                        </label>
                                                    </div>
                                            </p>
                                            @if($user->activity == 'resume_sent')
                                                <span class="resume-user__list-subtext">sent by you</span>
                                            @endif
                                            @if($user->activity == 'resume_request')
                                                <span class="resume-user__list-subtext">can access with your acceptance</span>
                                            @endif
                                            @if($user->activity == 'resume_forwarded')
                                        <span class="resume-user__list-subtext">forwarded by {{$fwdUserName}}</span>
                                            @endif


                                        </div>
                                        </div>
                                    </li>

                          <?php } ?>
							</ul>
                        </div>
                        <div class="pagination">{{$users}}</div>
					</div>
				</div>
			</div>
        </div>
    </section>
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
    @endsection
