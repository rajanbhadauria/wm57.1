@extends('layouts.app')
@section('content')
<?php
function getSkillFromJson($skill) {
    $skill_list = json_decode($skill);
    $skill_array = [];
    if(count($skill_list)>0) {
         foreach($skill_list as $skills) {
            $skill_array[] = '<span>'.$skills->text.'</span>';;
         }
    }
    return implode(", ", $skill_array);
}
?>
<!-- Inner page code -->
<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12 pr">
					<div class="top-panel">
						<h1>Resumes - <span class="mail-count">{{count($resumes)}}</h1>
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
								<input placeholder="Search resume" type="text" required="" class="">
							</div>
							<div class="input-field-search-icon ak-cont-serbtn">
								<button type="submit" class=""><i class="material-icons">search</i></button>
								<a href="javascript:void(0);" class="ak-resume-moreFetu ak-cont-serFilter"><i class="material-icons">filter_list</i></a>
							</div>
							<div class="ak-resume-moreFetuList ak-cont-serMF">
								<ul>
									<li class="activemfl"><a href="javascript:void(0);">All</a></li>
									<li><a href="javascript:void(0);">Mark</a></li>
									<li><a href="javascript:void(0);">Notes</a></li>
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
	<section class="section wrappit">
		<div class="container">
			<div class="center-wrapper1" id="heightSet">
				<div class="center-container">
					<div class="center-box ak-resumebox-box" id="loginDiv" >
						<div class="">
							<div class="container-card">

								<ul class="user-list ak-resumebox">
                                    @foreach($resumes as $resume)
                                    <?php
                                    $workInfo = App\Model\Work::where("user_id","=", $resume->user_id)->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
                                    ?>
                                   	<li class="user-list-item">

										<p class="user-title">
                                            <span><?php echo $resume->first_name;?> <?php echo $resume->last_name;?></span>
                                            <span class="user-tile-sub">
                                                <?php  if(count($workInfo)) { ?>
                                                <span class="ak-rb-sdot">&#183;</span> {{$workInfo[0]->company}} <span class="ak-rb-sdot">&#183;</span> <?php echo $workInfo[0]->city;?>
                                                <?php }  ?>
                                            </span>
											<span class="ak-rb-date"><?php echo date('jS M Y',strtotime($resume->created_at))?></span>
										</p>
                                    <p class="ak-rb-exp">
                                            <span class="ak-year-set">{{App\Model\Work::getUserWorkExp($resume->user_id)}}</span> &#183;
                                            <span class="skill-set">
                                                @if(isset($resume->skill))
                                                        {!!getSkillFromJson($resume->skill)!!}
                                                @endif
                                            </span>
                                            </p>
                                        <p class="ak-rb-msg">
                                            @if(isset($resume->coverLetter))
                                                    {{$resume->coverLetter}}
                                            @endif
                                        </p>
										<ul class="user-list-actions">
                                        <li class="active-star"><a href="#!" onclick="markFav({{$resume->id}}, {{$resume->user_id}})"><i class="material-icons <?php echo (isset($resume->is_fav) && $resume->is_fav) == '0' ? 'grey-text' : '';?>" id="star{{$resume->id}}">star</i></a></li>
                                        <li><a href="{{url('resume/forwardresume/'.$resume->id)}}"><i class="material-icons icon-flipped">reply</i></a></li>
										</ul>
                                    </li>
                                    @endforeach

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
    <script>
            $('.ak-resume-moreFetu').click( function(e) {
                e.preventDefault(); // stops link from making page jump to the top
                e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
                $('.ak-resume-moreFetuList').toggle();
            });
            $('.ak-resume-moreFetuList').click( function(e) {
                e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
            });
            $('body').click( function() {
                $('.ak-resume-moreFetuList').hide();
            });
            function markFav(ResumeId, userId) {
                $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:"{{url('resume/save-fav')}}",
                data:{"resumeid": ResumeId, "_token": "{{csrf_token()}}"},
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    $("#loading").hide();
                    if(response.success == false){
                    	$.notify({ content:response.erroMsg, timeout:3000});
                    } else {
                        if($("#star"+ResumeId).hasClass('grey-text')) {
                            $("#star"+ResumeId).removeClass('grey-text');
                        } else {
                            $("#star"+ResumeId).addClass('grey-text');
                        }
                    }
                },
                error: function(response) {
                    $("#loading").hide();
                }
            });
            }
            </script>
    @endsection
