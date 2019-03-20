@extends('layouts.app')
@section('content')
<style>
.ak-user-face{ display: inline-block !important;}
</style>
<section class="title-bar">
	  <div class="container">
		<div class="row mb0">
		  <div class="col s12 pr">
			<div class="top-panel">
			  <h1>Home</h1>
			  <ul class="panel-actions">
				<!-- <li>
				  <a class="waves-effect" href="{{ url('/memberlist') }}"><i class="material-icons">search</i> </a>
				</li> -->
				<li class="p-relative">
				  <a class="waves-effect" href="{{ url('/resumebox') }}" class="icon-overlap">
					<i class="material-icons">cloud</i>
					<i class="material-icons second-ico">brightness_1</i>
				  </a>
				</li>
				<li class="notification-blck">
				  <a class="waves-effect" href="{{ url('/notifications') }}">
					<i class="material-icons">notifications</i>
					<i class="material-icons dot">brightness_1</i>
				  </a>
				</li>
				<!-- <li>
				  <a class="waves-effect" href="{{ url('/settings') }}"><i class="material-icons">settings</i> </a>
				</li> -->
			  </ul>
			</div>
		  </div>
		</div>
	  </div>
	</section>
<div class="section wrappit secondary-bg">
	  <div class="container">
		<div class="center-wrapper" id="heightSet">
		  <div class="center-container ak-container">
			<div id="loginDiv">
			  <div class="row widget-container">
					<div class="col s6 m4">
					  <div class="widget-block ak-wblock">
						  <div class="ak-wblockflx">
                            <h5 class="mptext">Resume</h5>
							<p>{{(Auth::user()->resume_updated_at!='' && Auth::user()->resume_updated_at!='0000-00-00 00:00:00')  ? Carbon\Carbon::parse(Auth::user()->resume_updated_at)->diffForHumans(): "Resume not updated"}}</p>
						  </div>
						  <a href="{{URL::to('/update/options')}}" class="waves-effect waves-light btn-black ak-btn-half-first">Update</a>
						  <a href="{{URL::to('/resume/view')}}" class="waves-effect waves-light btn-black ak-btn-half-second">View</a>
					  </div>
					</div>

					<div class="col s6 m4">
					  <div class="widget-block ak-wblock">
						<div class="ak-wblockflx">
						    <h5 class="mptext mpstext">Social share</h5>
						    <p>Facebook<span class="ak-green-text"> (<i class="material-icons ak-grnchk">check</i>)</span> LinkedIn Google</p>
						    <a href="industry.html" class="waves-effect waves-light btn-black ak-btn-half-first">Share requirements</a>
						    <a href="invite.html" class="waves-effect waves-light btn-black ak-btn-half-second">Invite a connection</a>
						</div>
					  </div>
					</div>

					 <div class="col s6 m4">
					  <div class="widget-block ak-wblock">
						  <div class="ak-wblockflx">
							  <h5 class="mpitext">Members</h5>
							  <p>{{count($members)}}</p>
							  <ul class="ak-user-face">
                                <?php
                                $limit = count($members) > 5 ? $limit = 5 : count($members);
                                for($i=0; $i<$limit; $i++) { ?>
                                <li><img src="{{get_user_image($members[$i]->avatar)}}" /></li>
                               <?php } ?>
							  </ul>
							  <a href="{{URL::to('/contactlist')}}" class="waves-effect waves-light btn-black ak-btn-half-first">My network</a>
							  <a href="{{URL::to('/memberlist')}}" class="waves-effect waves-light btn-black ak-btn-half-second">Find WM members</a>
						  </div>
					  </div>
					</div>

					 <div class="col s6 m4">
					  <div class="widget-block ak-wblock">
						  <div class="ak-wblockflx">
							  <h5 class="mptext">Resume access</h5>
                          <p>{{$viewCount}}</p>
							  <a href="http://wm.dainidev.com/update" class="waves-effect waves-light btn-black ak-btn-half-first">Who viewed me ?</a>
							  <a href="http://wm.dainidev.com/update" class="waves-effect waves-light btn-black ak-btn-half-second">Access request</a>
						</div>
				      </div>
					</div>

					<div class="col s6 m4">
					  <div class="widget-block ak-wblock">
						  <div class="ak-wblockflx">
							  <h5 class="mptext">Resumebox</h5>
							  <p>334</p>
							  <a href="resumebox.html" class="waves-effect waves-light btn-black ak-btn-half-first">Resume received</a>
							  <a href="skill-form.html" class="waves-effect waves-light btn-black ak-btn-half-second">Looking for skills</a>
				          </div>
				      </div>
					</div>

					<div class="col s6 m4">
					  <div class="widget-block ak-wblock">
						  <div class="ak-wblockflx lastChild">
							  <h5 class="mptext mpactext">Activities</h5>
							  <p class="ak-active-color">{{$activityCount}} New</p>
							  <a href="resume/track" class="waves-effect waves-light btn-black ak-btn-full">View</a>
					      </div>
					  </div>
					</div>
				  </div>
			  <!--  <a href="{{ url('/resume') }}" class="waves-effect waves-light btn-blue display-block">Resume</a> -->
			</div>
		  </div>
		</div>
	  </div>
	</div>
    <!-- //Inner page code -->
@endsection
