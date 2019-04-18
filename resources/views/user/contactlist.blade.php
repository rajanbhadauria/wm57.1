@extends('layouts.app')
@section('content')
<script>
   function viewResume(owner_email, user_email) {
            $.ajax({
                    type:"POST",
                    url:'{{url("get-resume")}}',
                    data:{'owner_email':owner_email, 'user_email':user_email, '_token':'{{csrf_token()}}' },
                    success: function(response){
                        if(response.success) {
                            window.location.href = response.url;
                        }
                        else {
                            $.notify({ content:response.errorMsg, timeout:3000});
                        }
                    }

                });
        }
    </script>
    <!-- Inner page code -->
	<section class="title-bar">
	  <div class="container">
		<div class="row mb0">
		  <div class="col s12 pr">
			<div class="top-panel">
			  <h1>Members</h1>
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
	<section class="search-bar">
	  <div class="container">
		<div class="row mb0">
		  <div class="col s12 pr">
			<div class="search-input-container">
				<form>
					<div class="input-field-search">
						<div class="input-field-search-inputcontainer">
							<div class="input-field-search-input">
								<input placeholder="Search user" type="text" required="" class="">
							</div>
							<div class="input-field-search-icon ak-cont-serbtn">
								<button type="submit" class=""><i class="material-icons">search</i></button>
								<a href="javascript:void(0);" class="ak-resume-moreFetu ak-cont-serFilter"><i class="material-icons">filter_list</i></a>
							</div>
							<div class="ak-resume-moreFetuList ak-cont-serMF">
								<ul>
									<li class="activemfl"><a href="javascript:void(0);">All</a></li>
									<li><a href="javascript:void(0);">New joined</a></li>
									<li><a href="javascript:void(0);">Facebook contact</a></li>
									<li><a href="javascript:void(0);">Google contact</a></li>
									<li><a href="javascript:void(0);">Linked contact</a></li>
									<li><a href="javascript:void(0);">WM contact</a></li>
									<li><a href="javascript:void(0);">Invite</a></li>
								</ul>
							</div>
						</div>
					</div>
				</form>
			</div>
		  </div>
		</div>
	  </div>
	</section>
	<div class="section wrappit secondary-bg">
	  <div class="container">
		<div class="center-wrapper" id="heightSet">
		  <div class="center-container ak-full-container">
			<div class="ak-full-center-box" id="loginDiv">
			<div class="">
			  <div class="widget-container">
				<ul class="collection-thumb ak-collection-thumb">
                    <?php if(count($users)>0) {
                        foreach($users as $user) {
                    ?>
					<li class="collection-item collection-item-hover-active">
                        <a href="javascript:void(0);" onclick="viewResume('{{$user->email}}', '{{Auth::user()->email}}');">
                        <img src="{{get_user_image($user->avatar)}}" alt="{{$user->name}}"  class="circle ak-collection-img"/>
                        <div class="ak-collection-content">
                            <div class="title ak-cont-name">{{$user->first_name}} {{$user->last_name}}</div>
                            <div class="deg">{{$user->primaryEmail}}</div>
                            <div class="company ak-cont-phone">{{$user->primaryPhone}}</div>
                            <div class="date ak-cont-time">{{date('M d, Y', strtotime($user->created_at))}}</div>
                        </div>
                        </a>
                    </li>
                <?php } }?>
				</ul>

			  </div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
    </div>

	@endsection
