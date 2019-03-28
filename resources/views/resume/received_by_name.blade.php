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

                                <?php foreach($resumeReceived as $received) {
                                    $user = App\Helpers\Activity::getUserDetails($received->forUser);
                                    if(!$user) {
                                        $user = App\Helpers\Activity::getUserDetails($received->toUser);
                                    }
                                    if(!$user) {
                                        $name = $received->email;
                                    }
                                    if($user) {
                                        $name = $user->name;
                                    }
                                    ?>

								<li class="container-card">
									<div class="resume-user__list-img center-align">
                                        @if($user)
                                            <img src="{{get_user_image($user->avatar)}}" alt="{{$user->name}}" class="circle small"/>
                                        @else
                                            <img src="{{get_user_image($name)}}" alt="{{$name}}" class="circle small"/>
                                        @endif
									</div>
									<div class="resume-user__list-content">
										<div class="resume-user__list-content-in">
                                        <p>{{$name}}
                                            <span>
                                               {{Carbon\Carbon::parse($received->updated_at)->diffForHumans()}}
                                            </span>
                                        </p>
										</div>
                                    </div>
                                    @if($received->activity == 'resume_request' && $received->request_status == 'pending' && $received->forUser==Auth::id())
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="updateRequest('accepted', {{$received->id}})" class="waves-button-input" value="Accept"></i>
												<i class="waves-effect waves-light btn-black input-btn waves-input-wrapper" style=""><input type="submit" onclick="updateRequest('rejected', {{$received->id}})" class="waves-button-input" value="Decline"></i>
                                            </div>
                                            @endif
                                            @if($received->activity == 'resume_request' && $received->request_status == 'pending' && $received->byUser==Auth::id())
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="updateRequest('cancel', {{$received->id}})" class="waves-button-input" value="Cancel"></i>
                                            </div>
                                            @endif
                                            @if($received->activity == 'resume_accepted' && $received->request_status == 'accepted' && $received->forUser==Auth::id())
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="viewResume({{$received->id}})" class="waves-button-input" value="View"></i>
                                            </div>
                                            @endif
                                            @if($received->activity == 'resume_forwarded' && ($received->toUser==Auth::id() || $received->email== Auth::user()->email))
                                            <div class="resume-user__list-action">
												<i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="viewResume({{$received->id}})" class="waves-button-input" value="View"></i>
                                            </div>
                                            @endif
                                            @if($received->activity == 'resume_sent' && ($received->email==Auth::user()->email))
                                            <div class="resume-user__list-action">
received                                            </div>
                                            @endif
                                </li>

                            <?php } ?>
							</ul>
                        </div>
                        <div class="pagination">{{$resumeReceived}}</div>
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
