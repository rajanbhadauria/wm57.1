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
							<ul class="collection-thumb ak-colcThumMem">

                                <?php foreach($users as $user) {
                                    $result = App\Helpers\Activity::getUserDetails($user->userEmail);
                                     if($result) {
                                         $name = $result->name;
                                     } else {
                                         $name = $user->userEmail;
                                     }
                                    ?>

								<li class="collection-item collection-item-hover-active">
									<div class="row">
									<div class="title">
										{{$name}}
									</div>
                                    <div class="date">{{Carbon\Carbon::parse($user->updated_at)->diffForHumans()}}</div>
                                    </div>
                                    <div class="row">
                                    <div class="container">
                                        
                                   
                                            <div class="collection-item-btn right">
                                            <div class="switch">
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
                                        </div>
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
