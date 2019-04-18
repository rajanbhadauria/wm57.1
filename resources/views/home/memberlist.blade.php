@extends('layouts.app')
@section('content')
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
				<form action="" method="GET" id="formFilter">
					<div class="input-field-search">
						<div class="input-field-search-inputcontainer">
							<div class="input-field-search-input">
                            <input placeholder="Search user" name="q" type="text" value="{{@$_GET['q']}}" required="" class="">
                            <input type="hidden" name="sort" id="sort">
							</div>
							<div class="input-field-search-icon ak-cont-serbtn">
								<button type="submit" class=""><i class="material-icons">search</i></button>
								<a href="javascript:void(0);" class="ak-resume-moreFetu sortList ak-cont-serFilter">
                                    <i class="material-icons">filter_list</i></a>
							</div>
							<div class="ak-resume-moreFetuList ak-cont-serMF" id="sortByList">
								<ul>
									<li class="activemfl"><a href="javascript:Sort('')" class="sortList">All</a></li>
									<li><a href="javascript:Sort('name')" class="sortList">By Name</a></li>
									<li><a href="javascript:Sort('company');" class="sortList">By Company</a></li>
									<li><a href="javascript:Sort('last_active');" class="sortList">Last active</a></li>

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

				<ul class="collection-thumb ak-colcThumMem">
                    <?php if(count($users)>0) {
                        foreach($users as $user) {

                        ?>
					<li class="collection-item collection-item-hover-active">
                        <a href="javascript:void(0);" onclick="viewResume('{{$user->email}}', '{{Auth::user()->email}}');">
                            <img src="{{get_user_image($user->avatar)}}" alt="{{$user->name}}"  class="circle"/>
                            <div class="title">{{$user->first_name}} {{$user->last_name}}</div>
                            <div class="deg">@if($user->company) {{$user->company}} @endif</div>
                            <div class="company">@if($user->role) {{$user->role}} @endif</div>
                            <div class="date">@if($user->city) {{$user->city}} &#183; @endif @if($user->country) {{$user->country}} @endif</div>
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
    <script>
        $(document).ready(function(){
            $(".sortList").click(function(){
                $("#sortByList").toggle();
            });
        });
        function Sort(key) {
            $("#sort").val(key);
            $("#formFilter").submit();
        }
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
	@endsection
