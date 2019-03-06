@extends('layouts.app')
@section('content')


<?php $resize = true; ?>

<?php
if(isset($sectionid)) {
    $sectionid = $sectionid;
} else {
    $sectionid = '';
}

function showWorkDetails($value){
    if($value!= ""){
        return $value." - ";
    } else {
        return "";
    }
}
function showWithReadMore($value){
    if($value !=""){
        if(strlen($value) > 50){
            echo substr($value,0,50); ?><span class="rm"><span>...</span>Read more</span><span class="rc"><?php echo substr($value,50,-1); ?> </span> <span class="rl">Read less</span> <?php
        } else {
            echo substr($value,0,50);
        }
    }
}

function getMonthName($month) {
    switch ($month) {
        case '01':
            return 'Jan';
            break;

        case '02':
            return 'Feb';
            break;
        case '03':
            return 'March';
            break;
        case '04':
            return 'April';
            break;
        case '05':
            return 'May';
            break;
        case '06':
            return 'Jun';
            break;
        case '07':
            return 'July';
            break;
            case '08':
            return 'Aug';
            break;
        case '09':
            return 'Spt';
            break;
        case '10':
            return 'Oct';
            break;
            case '11':
            return 'Nov';
            break;
        case '12':
            return 'Dec';
            break;
       default:
            # code...
            break;
    }
}

function showLanguages($language){
    if($language->read && $language->write && $language->speak){
        echo "Read, Write, Speak";
    } elseif($language->read && $language->write && !$language->speak) {
        echo "Read, Write";
    } elseif($language->read && !$language->write && $language->speak) {
         echo "Read, Speak";
    } elseif($language->read && !$language->write && !$language->speak) {
         echo "Read";
    } elseif(!$language->read && $language->write && $language->speak) {
         echo "Write, Speak";
    } elseif(!$language->read && $language->write && !$language->speak) {
         echo "Write";
    } elseif(!$language->read && !$language->write && $language->speak) {
         echo "Speak";
    } elseif(!$language->read && !$language->write && !$language->speak) {
         echo "";
    }
}
function getSkillFromJson($skill) {
    $skill_list = json_decode($skill);
    $skill_array = [];
    if(count($skill_list)>0) {
         foreach($skill_list as $skills) {
            $skill_array[] = $skills->text;
         }
    }
    return implode(" | ", $skill_array);
}
?>

<link href="{{my_asset('css/mainresume.css')}}" rel="stylesheet" media="all" />
	<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12 pr">
					<div class="top-panel">
						<a href="javascript:void(0);" class="text-primary ak-resuemtit-top"><i class="material-icons">insert_drive_file</i><span class="ak-resuemtit-topbadg">35</span></a>
						<!--<span class="ak-resume-panelceter">Last updated 12th Dec</span>-->
						<ul class="panel-actions resumebox-actions">
							<li><a href="javascript:void(0);"  class="text-primary"><i class="material-icons">lock_outline</i></a></li>
							<li><a href="{{url('update')}}"  class="text-primary"><i class="material-icons">edit</i></a></li>
							<li><a href="javascript:void(0);"  class="text-primary ak-resume-moreFetu"><i class="material-icons">more_horiz</i></a></li>
						</ul>
						<div class="ak-resume-moreFetuList">
							<ul>
								<li><a href="sendresume.html"><i class="material-icons tiny">send</i> Send</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">share</i> Shared</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">picture_as_pdf</i> PDF</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">print</i> Print</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">file_download</i> Download</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">file_upload</i> Upload resume(Doc/PDF)</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">visibility</i> Viewed me</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">access_time</i> Last updated 12th Dec</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section wrappit ak-resume-sample resume-color-blue resume-fontsize-medium resume-fontfamily-roboto">
		<div class="container">
			<div class="center-wrapper" id="heightSet">
				<div class="center-container">
					<div class="big-center-box" id="loginDiv">
						<div class="inner-half-container">
							<div class="wrapper resume-wrapper">
								<div class="inner-wrapper resume-inner-wrapper">
									<div class="user-profile">
										<div class="col1 details">
                                            @if($basicInfoCount >0 )
                                        <h3 class="name">{{$basicInfo->first_name }} {{$basicInfo->middle_name}} {{$basicInfo->last_name}}</h3>
                                            @else
                                                <h3 class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
                                            @endif
                                            @if(isset($workInfo[0]))
											<div class="display-flex align-items-center sm-display-block">
												<strong>{{$workInfo[0]->designation }}</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$workInfo[0]->department }}</em>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong>{{$workInfo[0]->company}}</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$workInfo[0]->city}}<span class="dot-separator"></span>{{$workInfo[0]->country}}</em>
                                            </div>
                                            @endif
                                            @if($educationCount)
											<span class="hr"></span>
											<div class="display-flex align-items-center sm-display-block">
												<strong>{{$educationInfo[0]->educationName}}</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$educationInfo[0]->branch}}<span class="dot-separator"></span>{{$educationInfo[0]->yyyy}}</em>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong>{{$educationInfo[0]->school}}</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$educationInfo[0]->city}}<span class="dot-separator"></span>{{$educationInfo[0]->country}}</em>
                                            </div>
                                            @endif
                                            <?php if($contactCount>0){ ?>
                                            <span class="hr"></span>
											<ul class="user-contact-info sm-content-center">
												<li class="phone">
													<img src="{{my_asset('images/baseline-phone-24px.svg')}}" />
                                                <a href="tel:{{$contactInfo->primaryPhoneCode}} {{$contactInfo->primaryPhone}}">+{{$contactInfo->primaryPhoneCode}}-{{$contactInfo->primaryPhone}}</a>
												</li>
												<li class="email">
													<img src="{{my_asset('images/baseline-email-24px.svg')}}" />
													<a href="mailto:<?php echo $contactInfo->altEmail!="" ? $contactInfo->altEmail: Auth::user()->email; ?>">
                                                            <?php echo $contactInfo->altEmail!="" ? $contactInfo->altEmail: Auth::user()->email; ?></span>

                                                    </a>
                                                </li>
                                                <?php if($contactInfo->url) { ?>
												<li class="web">
													<img src="{{my_asset('images/web.svg')}}" />
                                                <a href="{{$contactInfo->url}}">{{$contactInfo->url}}</a>
                                                </li>
                                            <?php } ?>
                                            </ul>
                                        <?php } ?>
										</div>
										<div class="col2 profile-pic">
											<div class="pic">
												<img src="{{get_user_image(Auth::user()->avatar)}}" title='{{$basicInfoCount>0 ? $basicInfo->first_name . " " . $basicInfo->last_name : Auth::user()->first_name." ".Auth::user()->last_name}}' />
											</div>
										</div>
									</div>
									<div class="block hightlightFeture">
                                    @if($coverNoteCount>0)
                                    <h2>{{$coverNote->resume_title}} <a href="{{url('update/resume-title-cover-note?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
                                    @endif
                                        @if($skillCount > 0)
										<div class="exp-details hightlightFSkils">
											<p>{{getSkillFromJson($skillInfo->skill)}}</p>
                                        </div>
                                        @endif
                                        @if($objectiveCount)
										<div class="exp-details">
											<p>{{$objectiveInfo->objective}}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <?php if($workCount > 0) {?>
									<div class="block">
										<h2>Work experience
											<span class="dot-separator" style="position:relative;top:-1px;"></span>
                                            <span class="highlight1">{{$totalWorkDuration}}</span>
                                            <a href="{{url('update/work?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeAddicon"><i class="material-icons medium">add</i></a>
                                        </h2>

                                        <?php foreach($workInfo as $work) {?>
										<div class="ak-exp-details-editable ak-editcol">
										<div class="exp-details">
											<div class="col1">
												<strong>{{$work->yyyyStart}}</strong>
											</div>
											<div class="col2">
                                                <strong>{{$work->designation}}<span class="dot-separator"></span>
                                                <span class="highlight1">{{$work->department}}</span>
                                                </strong>
                                                <a href="{{url('update/work/'.$work->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
												<p>
													<strong>{{$work->company}}</strong>
													<span class="dot-separator"></span>
													<span class="highlight1">{{$work->city}}
                                                    <span class="dot-separator"></span>{{$work->country}}</span>
												</p>
                                                <p>{{getMonthName($work->mmStart)}} {{$work->yyyyStart}} – {{($work->yyyyEnd) ? getMonthName($work->mmEnd)." ".$work->yyyyEnd: "Present"}}
												<span class="dot-separator"></span>
													@if(isset($work->duration))<span class="highlight1">{{$work->duration}}</span>@endif
                                                </p>
											</div>
										</div>
                                        @if($work->roleDesc)
										<div class="exp-details">
											<ul class='list'>
                                            <li style="list-style-type: none !important"><?php echo nl2br(str_replace('•	', '<br/>', $work->roleDesc)); ?></li>
											</ul>
                                        </div>
                                        @endif
                                    </div>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                                @if($miscellaneousCount>0)
									<div class="block">
										<h2>Work
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Projects
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Achievements
											<span class="dot-separator" style="position:relative;top:-1px;"></span>highlights
                                            <a href="{{url('update/miscellaneous?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>

                                        @foreach($miscellaneousInfo as $miscellaneous)
                                        <div class="ak-exp-details-editable ak-editcol">
                                            <div class="exp-details">
                                                <div class="col1">
                                                    <strong>{{$miscellaneous->yyyyStart}}</strong>
                                                </div>
                                                <div class="col2">
                                                    <strong>{{$miscellaneous->company}}
                                                        <span class="dot-separator"></span>{{$miscellaneous->title}}
                                                        <span class="dot-separator"></span>
                                                        <span class="highlight1"></span>
                                                    </strong>
                                                    <a href="{{url('update/miscellaneous/'.$miscellaneous->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
                                                </div>
                                            </div>
                                            <div class="exp-details">
                                                <ul class="list">
                                                    <li>
                                                        <p>{{$miscellaneous->projectDesc}}
                                                            @if($miscellaneous->url)
                                                        <a href="{{$miscellaneous->url}}">{{$miscellaneous->url}}</a>
                                                                @endif
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                    @endif
                                    @if($softskillCount>0)
									<div class="block">
                                    <h2>Soft skills <a href="{{url('update/soft-skill?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">

											<p>
                                                    <?php
                                                        $softSkill = json_decode($softskillInfo->soft_skill);
                                                        $skillsArray = []; $i = 0;
                                                        foreach($softSkill as $skills) {
                                                             $skillsArray[$i] =  $skills->text;
                                                             $i++;
                                                         }
                                                         echo implode(", ", $skillsArray);
                                                    ?>
											</p>
										</div>
                                    </div>
                                    @endif
                                    @if($interestCount>0)
									<div class="block">
                                    <h2>Interests <a href="{{url('update/interests?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<p>
                                                    <?php
                                                    $interest = json_decode($interestInfo->interest);
                                                    $interestArray = []; $i = 0;
                                                    foreach($interest as $ints) {
                                                         $interestArray[$i] =  $ints->text;
                                                         $i++;
                                                     }
                                                     echo implode(", ", $interestArray);
                                                ?>
                                            </p>
										</div>
                                    </div>
                                    @endif
                                    @if($awardCount > 0)
									<div class="block">
										<h2>Awards <a href="{{url('update/award?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($awardInfo as $award)
                                        <div class="ak-exp-details-editable ak-editcol">
                                            <div class="exp-details">
                                                <div class="col1">
                                                <strong>{{$award->yyyy}}</strong>
                                                </div>
                                                <div class="col2">
                                                    <strong>{{$award->award}}
                                                    <span class="dot-separator"></span>
                                                    <span class="highlight1">{{$award->school}}</span>
                                                    <a href="{{url('update/award/'.$award->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
                                                    </strong>

                                                </div>

                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($trainingCount>0)
									<div class="block">
										<h2>Trained on <a href="{{url('update/training?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($trainingInfo as $traning)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<div class="col1">
												<strong>{{$traning->yyyy}}</strong>
											</div>
											<div class="col2">
												<strong>{{$traning->training}}
													<span class="dot-separator"></span>
													<span class="highlight1">{{$traning->school}}</span>
                                                </strong>
                                                <a href="{{url('update/training/'.$traning->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
                                            </div>
                                        </div>
										</div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($certificationCount>0)
									<div class="block">
										<h2>Certifications <a href="{{url('update/certification?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach ($certificationInfo as $certification)
                                        <div class="ak-exp-details-editable ak-editcol">
                                            <div class="exp-details">
                                                <div class="col1">
                                                <strong>{{$certification->yyyy}}</strong>
                                                </div>
                                                <div class="col2">
                                                    <strong>{{$certification->certification}}
                                                        <span class="dot-separator"></span>
                                                        <span class="highlight1">{{$certification->school}} {{$certification->city}} {{$certification->country}}</span>
                                                    </strong>
                                                    <a href="{{url('update/certification/'.$certification->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($educationCount>0)
									<div class="block">
										<h2>Education <a href="{{url('update/education?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($educationInfo as $education)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<div class="col1">
                                            <strong>{{$education->yyyy}}</strong>
											</div>
											<div class="col2">
												<strong>{{$education->educationName}}
													<span class="dot-separator"></span>{{$education->branch}}
													<span class="dot-separator"></span>
													<span class="highlight1">{{$education->school}}
													<span class="dot-separator"></span>{{$education->gradeValue}}{{$education->grade == 'percentage' ? '%' : ($education->grade == ' GPA' ? 'GPA' : ' Grade') }}</span>
                                                </strong>
                                                <a href="{{url('update/education/'.$education->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
											</div>
                                        </div>

                                    </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($courseCount > 0)
									<div class="block">
										<h2>Subjects, Courses <a href="{{url('update/course?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($courseInfo as $course)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<p>{{$course->course}}
												<span class="highlight1">({{$course->gradeValue}}{{$course->grade == 'percentage' ? '%' : ($course->grade == ' GPA' ? 'GPA' : ' grade') }})</span>
                                               <a href="{{url('update/course/'.$course->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
                                            </p>
                                        </div>

                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($languageCount>0)
									<div class="block">
										<h2>Language <a href="{{url('update/language?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
                                            @foreach($languageInfo as $language1)
                                            <p>
                                                {{$language1->language}}
                                                <span class="highlight1">({{showLanguages($language1)}})</span>
                                                <a href="{{url('update/language/'.$language1->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
                                            </p>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($basicInfoCount >0 )
									<div class="block">
										<h2>Additional information / Contact details <a href="{{url('postsignup?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<ul class="list-table">
												<li class="col1">
													<ul>
														<li>@if($basicInfo->dob != '//')Date of birth @endif</li>
														<li>@if($basicInfo->marital_status)Marital status @endif</li>
														<li> @if($contactCount)Contact number @endif</li>
														<li> @if($contactCount && $contactInfo->altPhone!='')Alternat number @endif</li>
														<li> @if($contactCount)Email @endif</li>
														<li>Valid passport</li>
														<li>@if($currentAddressCount > 0 || $permanentAddressCount>0)Current location @endif</li>
														<li> @if($referenceCount) References @endif</li>
													</ul>
												</li>
												<li class="col2">
													<ul>
														<li>
                                                            @if($basicInfo->dob != '//')<span class="highlight1">{{$basicInfo->dob}}</span>@endif
														</li>
														<li>
															@if($basicInfo->marital_status)<span class="highlight1">{{$basicInfo->marital_status}}</span>@endif
														</li>

														<li>
                                                            @if($contactCount)<a href="tel:+{{$contactInfo->primaryPhoneCode }} {{$contactInfo->primaryPhone}}">+{{$contactInfo->primaryPhoneCode}} {{$contactInfo->primaryPhone}}</a>@endif
                                                        </li>
                                                        <li>
                                                            @if($contactCount && $contactInfo->altPhone!='')<a href="+tel:{{$contactInfo->altPhoneCode }} {{$contactInfo->altPhone}}">+{{$contactInfo->altPhoneCode }} {{$contactInfo->altPhone}}</a>@endif
                                                        </li>
														<li>
                                                            @if($contactCount)<a href="emailto: {{Auth::user()->email}}">{{Auth::user()->email}}</a>@endif
														</li>

                                                        <li>
															<span class="highlight1">Yes</span>
                                                        </li>
                                                        <li>
															<span class="highlight1">
                                                                @if($currentAddressCount)
                                                                    {{$currentAddressInfo->city}}, {{$currentAddressInfo->country}}
                                                                @endif
                                                                @if($currentAddressCount == 0 && $permanentAddressCount>0)
                                                                {{$permanentAddressInfo->city}}, {{$permanentAddressInfo->country}}
                                                            @endif
                                                            </span>
                                                        </li>
														<li>
                                                            <span class="highlight1">
                                                                @if($referenceCount)   {{$referenceInfo[0]->email!="" ? $referenceInfo[0]->email: ''}} @endif
                                                            </span>
														</li>
													</ul>
												</li>
											</ul>
										</div>
                                    </div>
                                    @endif
                                    @if($objectiveCount>0)
									<div class="block">
										<h2>Cover Note <a href="{{url('update/objective?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
                                        <p>{{$objectiveInfo->objective }}</p>
										</div>
                                    </div>
                                    @endif
								</div>
							</div>
						</div>

						<div class="inner-half-container">
							<div class="wrapper resume-wrapper">
								<div class="inner-wrapper resume-inner-wrapper resume-control-blck">

									<div class="resume-download-row resume-control-row row center-align">
										<h5 class="ak-upreumedon">Upload resume(Doc/PDF)</h5>
										<form>
											<div class="dwnld-blck">
												<a href="javscript:void(0)" download class="atchmnt-rsume">
													<div class="icon-attch">
														<i class="material-icons">attach_file</i>
													</div>

													<div class="file-name">
														Anand-Srivastava.doc
													</div>

													<div class="btn-attchmnt">
														<i class="material-icons">file_download</i>
													</div>
												</a>
											</div>
										</form>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script>
    $("document").ready(function($){
        var nav = $('.title-bar');
        var header = $('.header');

        $(window).scroll(function () {
            if ($(this).scrollTop() > 62) {
                nav.addClass("f-nav");
                header.css({'marginBottom':48+'px'});
                $('.header-name-panel').show();
                $('.resume-header').hide();
            } else {
                nav.removeClass("f-nav");
                header.css({'marginBottom':0+'px'});
                $('.header-name-panel').hide();
                $('.resume-header').show();
            }
        });
    });
  </script>

<script>
    $(document).ready(function(){
       $('.rm').on('click', function(){
           $(this).hide();
           $(this).next().show();
           $(this).next().next().show();
       });
       $('.rl').on('click', function(){
           $(this).hide();
           $(this).prev().hide();
           $(this).prev().prev().show();
       });


        var sectionid = '<?php echo $sectionid; ?>';
        setTimeout(function(){
            if(sectionid){
                $('html, body').animate({
                    scrollTop: $("#"+sectionid).offset().top - 50
                }, 2000);
                $("#"+sectionid).trigger('click');
            }
        }, 1000);
    });
</script>
@endsection
