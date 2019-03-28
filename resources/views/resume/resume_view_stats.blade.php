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

                                <?php foreach($resumeViewed as $views) { ?>
								<li class="container-card">
									<div class="resume-user__list-img center-align">
										<img src="{{get_user_image($views->avatar)}}" alt="{{$views->name}}" class="circle small"/>
									</div>
									<div class="resume-user__list-content">
										<div class="resume-user__list-content-in">
                                        <p>
                                            {{$views->name}}
                                            <span>
                                               {{Carbon\Carbon::parse($views->last_viewed_at)->diffForHumans()}}
                                            </span></p>
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

    @endsection
