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
$print_url = url("resume/print");
?>
<script>
    var height = $(document).height() - parseInt(($(document).height()*10)/100);
    var width = $(document).width() - parseInt(($(document).width()*25)/100);
    function printPreview() {
        window.open('{{$print_url}}', 'none', 'width='+width+', height='+height);
    }
</script>
<link href="{{my_asset('css/mainresume.css')}}" rel="stylesheet" media="all" />
<?php if($style) { ?>
    <style>
        .resumeCustomCss {
            font-family: <?php echo $style->font_family?>;
        }
         h3.name { color: <?php echo $style->font_heading_color?> !important;}
        .block h2 { color: <?php echo $style->font_heading_color?>;}
    </style>
<?php } ?>

	<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12 pr">
					<div class="top-panel">
						<a href="javascript:void(0);" class="text-primary ak-resuemtit-top"><i class="material-icons">insert_drive_file</i><span class="ak-resuemtit-topbadg">35</span></a>
						<!--<span class="ak-resume-panelceter">Last updated 12th Dec</span>-->
						<ul class="panel-actions resumebox-actions">
                            <li><a href="javascript:void(0);"  class="text-primary"><i class="material-icons">lock_outline</i></a></li>
                            <li><a href="{{url('update/passkey')}}"  class="text-primary"><i class="material-icons">vpn_key</i></a></li>
							<li><a href="{{url('update')}}"  class="text-primary"><i class="material-icons">edit</i></a></li>
							<li><a href="javascript:void(0);"  class="text-primary ak-resume-moreFetu"><i class="material-icons">more_horiz</i></a></li>
						</ul>
						<div class="ak-resume-moreFetuList" style="display: none;">
							<ul>
								<li><a href="{{url('resume/send')}}"><i class="material-icons tiny">send</i> Send</a></li>
								<li><a href="javascript:void(0);"><i class="material-icons tiny">share</i> Shared</a></li>
								<li><a href="{{url('resume/download')}}"><i class="material-icons tiny">picture_as_pdf</i> PDF</a></li>
								<li><a href="javascript:void(0);" onclick="printPreview()"><i class="material-icons tiny">print</i> Print</a></li>
								<li><a href="{{url('resume/download-doc')}}"><i class="material-icons tiny">file_download</i> Download</a></li>
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
    <div class="resumeCustomCss">
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
                                        @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                            <h3 class="name showedit">{{$basicInfo->first_name }} {{$basicInfo->middle_name}} {{$basicInfo->last_name}} <a href="{{url('postsignup?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h3>
                                        @else
                                            <h3 class="name showedit">{{Auth::user()->first_name}} {{Auth::user()->last_name}} <a href="{{url('postsignup?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h3>
                                        @endif
                                        @if(isset($workInfo[0]) && $resumeAccess->workData)
											<div class="display-flex align-items-center sm-display-block showedit">
												<strong class="black-text"><b>{{$workInfo[0]->designation }}</b></strong>
												<span class="dot-separator"></span>
                                                <em class="highlight1">{{$workInfo[0]->department }}</em>
                                                <a href="{{url('update/work/'.$workInfo[0]->id.'?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong class="black-text"><b>{{$workInfo[0]->company}}</b></strong>
												<span class="dot-separator"></span>
                                                <em class="highlight1">{{$workInfo[0]->city}}<span class="dot-separator"></span>{{$workInfo[0]->country}}</em>

                                            </div>
                                            @endif
                                            @if($educationCount  && $resumeAccess->educationData)
											<span class="hr"></span>
											<div class="display-flex align-items-center sm-display-block showedit">
												<strong>{{$educationInfo[0]->educationName}}</strong>
												<span class="dot-separator"></span>
                                                <em class="highlight1">{{$educationInfo[0]->branch}}<span class="dot-separator"></span>{{$educationInfo[0]->yyyy}}</em>
                                                <a href="{{url('update/education/'.$educationInfo[0]->id.'?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong>{{$educationInfo[0]->school}}</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$educationInfo[0]->city}}<span class="dot-separator"></span>{{$educationInfo[0]->country}}</em>
                                            </div>
                                            @endif
                                            <?php if($contactCount>0  && $resumeAccess->contactData){ ?>
                                            <span class="hr"></span>
											<ul class="user-contact-info sm-content-center showedit">
												<li class="phone">
													<img src="{{my_asset('images/baseline-phone-24px.svg')}}" />
                                                    <a href="tel:{{$contactInfo->primaryPhoneCode}} {{$contactInfo->primaryPhone}}">+{{$contactInfo->primaryPhoneCode}}-{{$contactInfo->primaryPhone}}</a>
												</li>
												<li class="email">
													<img src="{{my_asset('images/baseline-email-24px.svg')}}" />
													<a href="mailto:<?php echo $contactInfo->altEmail!="" ? $contactInfo->altEmail: Auth::user()->email; ?>">
                                                            <?php echo $contactInfo->altEmail!="" ? $contactInfo->altEmail: Auth::user()->email; ?>
                                                    </a>
                                                </li>
                                                <?php if($contactInfo->url) { ?>
												<li class="web">
													<img src="{{my_asset('images/web.svg')}}" />
                                                    <a href="{{$contactInfo->url}}">{{$contactInfo->url}}</a>

                                                </li>
                                            <?php } ?>
                                            <li>
                                                <a href="{{url('update/contact?url=resume/view')}}" class="right ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
                                            </li>
                                            </ul>
                                        <?php } ?>
                                        </div>

										<div class="col2 profile-pic showedit">

											<div class="pic">
                                                @if($profileData)
                                                <img src="{{get_user_image(Auth::user()->avatar)}}" title='{{$basicInfoCount>0 ? $basicInfo->first_name . " " . $basicInfo->last_name : Auth::user()->first_name." ".Auth::user()->last_name}}' />
                                                @endif
                                            </div>
                                            <a href="{{url('user/profile-image?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
										</div>
									</div>
									<div class="block">
                                    @if($coverNoteCount>0 && $resumeAccess->resumetitleData)
                                    <h2 class="showedit">{{$coverNote->resume_title}} <a href="{{url('update/resume-title-cover-note?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
                                    @endif
                                        @if($skillCount > 0  && $resumeAccess->skillData)
										<div class="exp-details-sub1 hightlightFSkils black-text showedit">
                                            <p>{{getSkillFromJson($skillInfo->skill)}}
                                            <a href="{{url('update/skill?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
                                        </p>

                                        </div>
                                        @endif
                                        @if($softskillCount>0  && $resumeAccess->softskillData)
                                        <div class="exp-details-sub1 hightlightFSkils black-text showedit">
                                            <p>{{getSkillFromJson($softskillInfo->soft_skill)}}
                                            <a href="{{url('update/soft-skill?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
                                        </p>
                                        </div>
                                        @endif
                                        @if($objectiveCount && $resumeAccess->objectiveData)
										<div class="exp-details showedit">
                                            <p>
                                                <?php echo str_replace("<br><br>", '<br>', nl2br($objectiveInfo->objective));?>
                                                <a href="{{url('update/resume-title-cover-note?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                    <?php if($workCount > 0 && $resumeAccess->workData) {?>
									<div class="block">
										<h2 class="showedit">Work experience
											<span class="dot-separator" style="position:relative;top:-1px;"></span>
                                            <span class="highlight1">{{$totalWorkDuration}}</span>
                                            <a href="{{url('update/work?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeAddicon"><i class="material-icons medium">add</i></a>
                                        </h2>

                                        <?php foreach($workInfo as $workW) {?>
										<div class="ak-exp-details-editable ak-editcol">
										<div class="exp-details">
											<div class="col1 black-text text-lighten-3">
												<strong>{{$workW->yyyyStart}}</strong>
											</div>
											<div class="col2">
												<strong>{{$workW->yyyyStart}}</strong>
                                                <strong class="black-text text-lighten-3">{{$workW->designation}}<span class="dot-separator"></span>
                                                <span class="highlight1">{{$workW->department}}</span>
                                                </strong>
                                                <a href="{{url('update/work/'.$workW->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
												<p>
													<strong class="black-text text-lighten-3">{{$workW->company}}</strong>
													<span class="dot-separator"></span>
													<span class="highlight1">{{$workW->city}}</span>
                                                    <span class="dot-separator"></span>{{$workW->country}}
												</p>
                                                <p>
                                                    <strong class="black-text text-lighten-3">{{getMonthName($workW->mmStart)}} {{$workW->yyyyStart}} – {{($workW->yyyyEnd) ? getMonthName($workW->mmEnd)." ".$workW->yyyyEnd: "Present"}}</strong>
												    <span class="dot-separator"></span>
                                                    @if(isset($workW->duration))
                                                    <span class="highlight1">{{$workW->duration}}</span>
                                                    @endif
                                                </p>

                                            </div>
                                            @if($workW->roleDesc)
                                                <div class="exp-details-sub">
                                                    <ul class='list'>
                                                    <li><?php echo str_replace("<br />", '</li><li>', nl2br(str_replace('•	', " ", $workW->roleDesc))); ?></li>
                                                    </ul>
                                                </div>
                                            @endif
										</div>
                                    </div>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                                @if($projectCount>0  && $resumeAccess->projectData)
                                <div class="block">
                                    <h2 class="showedit">Key assignments and projects
                                        <a href="{{url('update/project?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a>
                                    </h2>

                                    @foreach($projectInfo as $project)
                                    <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details black-text text-lighten-3">
                                            <div class="col1">
                                                <strong>{{$project->yyyy}}</strong>
                                            </div>
                                            <div class="col2">
                                                <strong class="black-text text-lighten-3">
                                                    {{$project->school}}<span class="dot-separator"></span>
                                                    <span class="highlight1">{{$project->project}}</span>
                                                </strong>

                                                    @if($project->url!="")
                                                    <span class="dot-separator"></span>
                                                    <span class="highlight1"><a href="{{$project->url}}">{{$project->url}}</a></span>
                                                    @endif

                                                <a href="{{url('update/project/'.$project->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
                                            </div>
                                            @if($project->projectDesc != '')
                                            <div class="exp-details-sub">
                                                <ul class="list">
                                                    <li>
                                                        <?php echo str_replace("<br><br>", '<br>', nl2br($project->projectDesc)); ?>

                                                    </li>
                                                </ul>
                                            </div>
                                            @endif
                                        </div>

                                    </div>

                                    @endforeach
                                </div>
                                @endif
                                @if($miscellaneousCount>0  && $resumeAccess->travelData)
									<div class="block">
										<h2 class="showedit">Publications
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Research
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Patent
											<span class="dot-separator" style="position:relative;top:-1px;"></span>etc
                                            <a href="{{url('update/miscellaneous?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>

                                        @foreach($miscellaneousInfo as $miscellaneous)
                                        <div class="ak-exp-details-editable ak-editcol">
                                            <div class="exp-details">
                                                <div class="col1">
                                                    <strong class="black-text text-lighten-3">{{$miscellaneous->yyyyEnd}}</strong>
                                                </div>
                                                <div class="col2">
                                                    <strong class="black-text text-lighten-3">
                                                        {{$miscellaneous->company}}
                                                        <span class="dot-separator"></span>{{$miscellaneous->title}}
                                                        <span class="dot-separator"></span>
                                                        <span class="highlight1">{{$miscellaneous->project}}</span>


                                                    </strong>
                                                    <a href="{{url('update/miscellaneous/'.$miscellaneous->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
                                                </div>
                                                <div class="exp-details-sub">
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

                                        </div>

                                        @endforeach
                                    </div>
                                    @endif

                                    @if($awardCount > 0 && $resumeAccess->awardData)
									<div class="block">
										<h2 class="showedit">Awards <a href="{{url('update/award?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($awardInfo as $award)
                                        <div class="ak-exp-details-editable ak-editcol">
                                            <div class="exp-details">
                                                <div class="col1">
                                                <strong class="black-text text-lighten-3">{{$award->yyyy}}</strong>
                                                </div>
                                                <div class="col2">
                                                    <strong  class="black-text text-lighten-3">{{$award->award}}
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
                                    @if($trainingCount>0 && $resumeAccess->trainingData)
									<div class="block">
										<h2 class="showedit">Trained on <a href="{{url('update/training?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($trainingInfo as $traning)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<div class="col1">
												<strong class="black-text text-lighten-3">{{$traning->yyyy}}</strong>
											</div>
											<div class="col2">
												<strong class="black-text text-lighten-3">{{$traning->training}}
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
                                    @if($certificationCount>0 && $resumeAccess->certificationData)
									<div class="block">
										<h2 class="showedit">Certifications <a href="{{url('update/certification?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach ($certificationInfo as $certification)
                                        <div class="ak-exp-details-editable ak-editcol">
                                            <div class="exp-details">
                                                <div class="col1">
                                                <strong class="black-text text-lighten-3">{{$certification->yyyy}}</strong>
                                                </div>
                                                <div class="col2">
                                                    <strong  class="black-text text-lighten-3">{{$certification->certification}}
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
                                    @if($educationCount>0 && $resumeAccess->educationData)
									<div class="block">
										<h2 class="showedit">Education <a href="{{url('update/education?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($educationInfo as $education)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<div class="col1">
                                            <strong  class="black-text text-lighten-3">{{$education->yyyy}}</strong>
											</div>
											<div class="col2">
												<strong  class="black-text text-lighten-3">{{$education->educationName}}
													<span class="dot-separator"></span>{{$education->branch}}
													<span class="dot-separator"></span>
													<span class="highlight1">{{$education->school}}
													<span class="dot-separator"></span>{{str_replace('%', '',$education->gradeValue)}}{{$education->grade == 'percentage' ? '%' : ($education->grade == ' GPA' ? 'GPA' : ' Grade') }}</span>
                                                </strong>
                                                <a href="{{url('update/education/'.$education->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
											</div>
                                        </div>

                                    </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($courseCount > 0 && $resumeAccess->courseData)
									<div class="block">
										<h2 class="showedit">Subjects, Courses <a href="{{url('update/course?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($courseInfo as $course)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<p><strong  class="black-text text-lighten-3">{{$course->course}}</strong>
												<span class="highlight1">({{str_replace('%', '',$course->gradeValue)}}{{$course->grade == 'percentage' ? '%' : ($course->grade == ' GPA' ? 'GPA' : ' grade') }})</span>
                                               <a href="{{url('update/course/'.$course->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
                                            </p>
                                        </div>

                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($languageCount>0 && $resumeAccess->languageData)
									<div class="block">
										<h2 class="showedit">Languages <a href="{{url('update/language?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
                                            @foreach($languageInfo as $language1)
                                            <p>
                                                <strong  class="black-text text-lighten-3">{{$language1->language}}</strong>
                                                <span class="highlight1">({{showLanguages($language1)}})</span>
                                                <a href="{{url('update/language/'.$language1->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
                                            </p>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($interestCount>0 && $resumeAccess->interestData)
									<div class="block">
                                    <h2 class="showedit">Interests <a href="{{url('update/interests?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
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
                                    @if($referenceCount > 0 && $resumeAccess->referenceData)
									<div class="block">
										<h2 class="showedit">References <a href="{{url('update/reference?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($referenceInfo as $reference1)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">


                                                <div class="col2">
                                                <strong><span class="black-text">{{$reference1->reference}}</span>
                                                    <span class="dot-separator"></span>
                                                    <span class="highlight1">{{$reference1->email}}</span>
                                                    <span class="dot-separator"></span>
                                                    <span class="highlight1">{{$reference1->school}}</span>
                                                    @if($reference1->phone !='')
                                                    <span class="dot-separator"></span>
                                                    <span class="highlight1">+{{$reference1->phoneCode}}{{$reference1->phone}}</span>
                                                    @endif
                                                </strong>
                                                </div>
                                                <div class="col1">
                                                        <a href="{{url('update/reference/'.$reference1->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
                                                </div>
                                        </div>

                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

									<div class="block">
                                        @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                            <h2 class="showedit">Additional details</h2>
                                        @endif
										<div class="exp-details">
                                                <div class="col s12 m12 showedit">
                                                        @if($basicInfo && $basicInfo->dob != '//')
                                                            <span class="highlight1">{{date('d-M-y',strtotime($basicInfo->dob))}} (DOB)</span>
                                                            <span class="dot-separator"></span>
                                                        @endif
                                                        @if($contactCount && $contactInfo->altPhone!='')
                                                        <span class="highlight1">  <a href="tel:+{{$contactInfo->altPhoneCode }} {{$contactInfo->altPhone}}">
                                                                +{{$contactInfo->altPhoneCode }} {{$contactInfo->altPhone}}</a>
                                                                 (Alternate mobile)
                                                        </span>
                                                        <span class="dot-separator"></span>
                                                        @endif
                                                        @if($contactCount && $contactInfo->altEmail!='')
                                                        <span class="highlight1">  <a href="mailto{{$contactInfo->altEmail }} {{$contactInfo->altEmail}}">
                                                                {{$contactInfo->altEmail }}</a> (Alternate email)
                                                        </span>
                                                        @endif
                                                        <a href="{{url('postsignup?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
                                                </div>
                                                <div class="col s12 m12 showedit">
                                                @if($currentAddressCount)
                                                    <span class="highlight1">{{$currentAddressInfo->area}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$currentAddressInfo->city}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$currentAddressInfo->country}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$currentAddressInfo->pincode}} (Current address)</span>
                                                @elseif($currentAddressCount == 0 && $permanentAddressCount>0)
                                                    <span class="highlight1">{{$permanentAddressInfo->area}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$permanentAddressInfo->city}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$permanentAddressInfo->country}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$permanentAddressInfo->pincode}} (Permanent address)</span>
                                                @endif
                                                <a href="{{url('update/current-address?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a>
                                                </div>
										</div>
                                    </div>


								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
    </section>
    <div class="fixed-action-btn vertical click-to-toggle">
        <a class="btn-floating btn-small red">
          <i class="large material-icons">menu</i>
        </a>
        <ul>
        <li><a href="{{url('resume/send')}}" class="btn-floating red"><i class="material-icons tiny">send</i></a></li>
          <li><a class="btn-floating yellow darken-1"><i class="material-icons">share</i></a></li>
          <li><a href="{{url('resume/download')}}" class="btn-floating green"><i class="material-icons">picture_as_pdf</i></a></li>
          <li><a class="btn-floating blue" onclick="printPreview()"><i class="material-icons tiny">print</i></a></li>
          <li><a class="btn-floating pink" href="{{url('download-doc')}}"><i class="material-icons tiny">file_download</i></a></li>
          <li><a class="btn-floating purple" href="{{url('update/options')}}"><i class="material-icons tiny">file_upload</i></a></li>
          <li><a class="btn-floating indigo" href="{{url('resume-accessed-user')}}"><i class="material-icons tiny">visibility</i></a></li>
        </ul>
      </div>
</div>
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

	$(".ak-exp-details-editable").hover(function() {
	  $(this).addClass('ak-editcol')
    });

    $(".showedit").mouseover(function() {
        $(".ak-resumeEdit-icon").hide();
	    $(this).find(".ak-resumeEdit-icon").show();
    });
    $(".showedit").mouseout(function() {
	    $(this).find(".ak-resumeEdit-icon").hide();
    });

    $(document).ready(function(){
    	$(window).keydown(function(event) {
    		  if(event.ctrlKey && event.keyCode == 80) {
    		    event.preventDefault();
    		    printPreview();
    		  }
        });
    });


	</script>
@endsection
