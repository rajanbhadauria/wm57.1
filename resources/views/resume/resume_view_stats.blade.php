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

                                <?php foreach($resumeViewed as $views) {
                                    $user = App\Helpers\Activity::getUserDetails($views->forUser);
                                    if(!$user) {
                                        $user = App\Helpers\Activity::getUserDetails($views->toUser);
                                    }
                                    if(!$user) {
                                        $user = App\Helpers\Activity::getUserDetails($views->email);
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
										<img src="{{get_user_image($views->avatar)}}" alt="{{$views->name}}" class="circle small"/>
									</div>
									<div class="resume-user__list-content">
										<div class="resume-user__list-content-in">
                                        <p>
                                            {{$views->name}}
                                            <span>
                                               {{Carbon\Carbon::parse($views->updated_at)->diffForHumans()}}
                                            </span></p>
                                            @if($views->activity == "resume_forwarded")
                                                <span>{{$name}} forwarded resume to you</span>
                                            @endif
                                            @if($views->activity == "resume_request")
                                                <span> I requested resume to {{$name}}</span>
                                            @endif
                                            @if($views->activity == "resume_sent")
                                                <span>{{$name}} sent resume to you</span>
                                            @endif
                                            <div class="right hide">
                                                    <i class="waves-effect waves-light btn-blue input-btn waves-input-wrapper" style=""><input type="submit" onclick="viewResume({{$views->resume_id}})" class="waves-button-input" value="View"></i>
                                            </div>
                                        </div>

                                    </div>

                                </li>

                            <?php } ?>
							</ul>
                        </div>
                        <div class="pagination">{{$resumeViewed}}</div>
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
