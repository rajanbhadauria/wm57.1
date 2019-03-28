<!-- Inner page code -->
@extends('layouts.app')
@section('content')
<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12 pr">
					<h1>Resume access pending request</h1>
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

                                <?php foreach($activities as $activity) {
                                    $user1Obj = App\Helpers\Activity::getUserDetails($activity->byUser);
                                    $user2Obj = App\Helpers\Activity::getUserDetails($activity->forUser);
                                    $user3Obj = App\Helpers\Activity::getUserDetails($activity->toUser);

                                    $user1 = ($user1Obj) ? $user1Obj->first_name." ".$user1Obj->last_name : $activity->email;
                                    $user2 = ($user2Obj) ? $user2Obj->first_name." ".$user2Obj->last_name : $activity->email;
                                    $user3 = ($user3Obj) ? $user3Obj->first_name." ".$user3Obj->last_name : $activity->email;

                                    $activity_message = str_replace(["{%user1%}", "{%user2%}", "{%user3%}"], [$user1, $user2, $user3], $activity->activity_text);
                                    ?>
                                    @if($activity->is_visible == '1')
								<li class="container-card">
									<div class="resume-user__list-img center-align">
										<img src="{{get_user_image($user1Obj->avatar)}}" alt="{{$user1}}" class="circle small"/>
									</div>
									<div class="resume-user__list-content">
										<div class="resume-user__list-content-in">
                                        <p><!--{{$user1}}-->
                                            <span>
                                                <!--{{date('dS F Y', strtotime($activity->updated_at))}}-->
                                               {{Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}
                                            </span></p>

                                            <span class="resume-user__list-subtext">{{$activity_message}}</span>
                                            @if($activity->activity == 'resume_request' && $activity->request_status == 'pending' && $activity->forUser==Auth::id())
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="updateRequest('accepted', {{$activity->id}})" class="waves-button-input" value="Accept"></i>
												<i class="waves-effect waves-light btn-black input-btn waves-input-wrapper" style=""><input type="submit" onclick="updateRequest('rejected', {{$activity->id}})" class="waves-button-input" value="Decline"></i>
                                            </div>
                                            @endif
                                            @if($activity->activity == 'resume_request' && $activity->request_status == 'pending' && $activity->byUser==Auth::id())
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="updateRequest('cancel', {{$activity->id}})" class="waves-button-input" value="Cancel"></i>
                                            </div>
                                            @endif
                                            @if($activity->activity == 'resume_accepted' && $activity->request_status == 'accepted' && $activity->forUser==Auth::id())
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="viewResume({{$activity->id}})" class="waves-button-input" value="View"></i>
                                            </div>
                                            @endif
                                            @if($activity->activity == 'resume_forwarded' && ($activity->toUser==Auth::id() || $activity->email== Auth::user()->email))
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="viewResume({{$activity->id}})" class="waves-button-input" value="View"></i>
                                            </div>
                                            @endif
                                            @if($activity->activity == 'resume_sent' && ($activity->email==Auth::user()->email))
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="viewResume({{$activity->id}})" class="waves-button-input" value="View"></i>
                                            </div>
                                            @endif
										</div>
									</div>
                                </li>
                                @endif
                            <?php } ?>
                            @if(!count($activities))
                                <li class="alert alert-info">No access request pending.</li>
                            @endif
							</ul>
                        </div>
                        <div class="pagination">{{$activities->links()}}</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    <script>
    function updateRequest(status, req_id) {
        $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:"{{url('updateresumerequest')}}",
                data:{status: status, req_id: req_id, _token: "{{ csrf_token()}}"},
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                    	$('#success').css({'visibility': 'visible'});
                       window.location.reload();
                    }

                },
                error: function(response) {
                    $("#loading").hide();
                }
            });
    }

    function viewResume(req_id) {
        $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:"{{url('resume/activity/viewresume')}}",
                data:{req_id: req_id, _token: "{{ csrf_token()}}"},
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.errorMsg, timeout:3000});
                    } else {
                    	$('#success').css({'visibility': 'visible'});
                       window.location.href = "{{url('wm')}}/"+response.url;
                    }

                },
                error: function(response) {
                    $("#loading").hide();
                }
            });
    }
    </script>
    @endsection
