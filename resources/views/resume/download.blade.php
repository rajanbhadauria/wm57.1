<html lang="en">
<head>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0"/>
  <title>WorkMedian - Build and float your resume</title>

  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
<!-- CSS  -->
  <link href="{{ my_asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ my_asset('css/materialize.min.css') }}" rel="stylesheet">

  <link href="{{ my_asset('css/user-menu.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!--  <link href="css/chosen.css" rel="stylesheet" type="text/css"/>-->
  <link href="{{ my_asset('css/select3.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ my_asset('css/custom.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ my_asset('css/main.css') }}" type="text/css" rel="stylesheet"/>
  <link href="{{ my_asset('css/ak-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900|Open+Sans:400,600,700,800" rel="stylesheet">
  <link href="{{ my_asset('notify/notify.css') }}" rel="stylesheet">
  <!-- File Upload -->

</head>


<body id="app-layout">

<?php
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
<style>
@media print
{
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
<script>
    var height = $(document).height() - parseInt(($(document).height()*25)/100);
    var width = $(document).width() - parseInt(($(document).width()*25)/100);
</script>
<link href="{{my_asset('css/mainresume.css')}}" rel="stylesheet" media="all" />
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
                                        <h3 class="name">{{$basicInfo->first_name }} {{$basicInfo->middle_name}} {{$basicInfo->last_name}}</h3>
                                            @else
                                                <h3 class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
                                            @endif
                                            @if(isset($workInfo[0]) && $resumeAccess->workData)
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
                                            @if($educationCount  && $resumeAccess->educationData)
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
                                            <?php if($contactCount>0  && $resumeAccess->contactData){ ?>
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
                                                @if(isset($profileData->profilePrivate) && $resumeAccess->profileData)
                                                <img src="{{get_user_image(Auth::user()->avatar)}}" title='{{$basicInfoCount>0 ? $basicInfo->first_name . " " . $basicInfo->last_name : Auth::user()->first_name." ".Auth::user()->last_name}}' />
                                                @endif
											</div>
										</div>
									</div>
									<div class="block hightlightFeture">
                                    @if($coverNoteCount>0 && $resumeAccess->resumetitleData)
                                    <h2>{{$coverNote->resume_title}} <a href="{{url('update/resume-title-cover-note?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
                                    @endif
                                        @if($skillCount > 0  && $resumeAccess->skillData)
										<div class="exp-details hightlightFSkils">
											<p>{{getSkillFromJson($skillInfo->skill)}}</p>
                                        </div>
                                        @endif
                                        @if($objectiveCount && $resumeAccess->objectiveData)
										<div class="exp-details">
											<p><?php echo nl2br($objectiveInfo->objective);?></p>
                                        </div>
                                        @endif
                                    </div>
                                    <?php if($workCount > 0 && $resumeAccess->workData) {?>
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
													<span class="highlight1">{{$work->city}}</span>
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
                                @if($projectCount>0  && $resumeAccess->projectData)
                                <div class="block">
                                    <h2>Key assignments and projects
                                        <a href="{{url('update/project?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a>
                                    </h2>

                                    @foreach($projectInfo as $project)
                                    <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
                                            <div class="col1">
                                                <strong>{{$project->yyyy}}</strong>
                                            </div>
                                            <div class="col2">
                                                <strong>
                                                    <span class="highlight1">{{$project->project}}</span>
                                                    <span class="dot-separator"></span>{{$project->school}}

                                                    @if($project->url)
                                                    <span class="dot-separator"></span><a href="{{$project->url}}">{{$project->url}}</a>
                                                    @endif
                                                </strong>
                                                <a href="{{url('update/project/'.$project->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons medium">edit</i></a>
                                            </div>
                                        </div>
                                        @if($project->projectDesc != '')
                                        <div class="exp-details">
                                            <ul class="list">
                                                <li>
                                                    <?php echo nl2br($project->projectDesc); ?>

                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>

                                    @endforeach
                                </div>
                                @endif
                                @if($miscellaneousCount>0  && $resumeAccess->travelData)
									<div class="block">
										<h2>Publications
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Research
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Patent
											<span class="dot-separator" style="position:relative;top:-1px;"></span>etc
                                            <a href="{{url('update/miscellaneous?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>

                                        @foreach($miscellaneousInfo as $miscellaneous)
                                        <div class="ak-exp-details-editable ak-editcol">
                                            <div class="exp-details">
                                                <div class="col1">
                                                    <strong>{{$miscellaneous->yyyyEnd}}</strong>
                                                </div>
                                                <div class="col2">
                                                    <strong>
                                                        <span class="highlight1">{{$miscellaneous->project}}</span>
                                                        <span class="dot-separator"></span>
                                                        {{$miscellaneous->company}}
                                                        <span class="dot-separator"></span>{{$miscellaneous->title}}


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
                                    @if($softskillCount>0  && $resumeAccess->softskillData)
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
                                    @if($interestCount>0 && $resumeAccess->interestData)
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
                                    @if($awardCount > 0 && $resumeAccess->awardData)
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
                                    @if($trainingCount>0 && $resumeAccess->trainingData)
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
                                    @if($certificationCount>0 && $resumeAccess->certificationData)
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
                                    @if($educationCount>0 && $resumeAccess->educationData)
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
										<h2>Subjects, Courses <a href="{{url('update/course?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($courseInfo as $course)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<p>{{$course->course}}
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

                                    @if($referenceCount > 0 && $resumeAccess->referenceData)
									<div class="block">
										<h2>References <a href="{{url('update/reference?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
                                        @foreach($referenceInfo as $reference1)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
                                              <strong>
                                                <span class="highlight1">
                                                        {{{$reference1->reference}}}
                                                </span>
                                                <span class="dot-separator"> {{{$reference1->email}}}</span>
                                                <span class="dot-separator"> {{$reference1->school}}</span>

                                               <a href="{{url('update/reference/'.$reference1->id.'?url=resume/view')}}" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
                                            </strong>
                                        </div>

                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

									<div class="block">
                                        @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                            <h2>Additional information / Contact details <a href="{{url('postsignup?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
                                        @endif
										<div class="exp-details">
											<ul class="list-table">
												<li class="col1">
													<ul>
														<li> @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                                        	 	@if($basicInfo->dob != '//')Date of birth @endif
                                                             @endif
                                                        </li>
														<li> @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                                        		@if($basicInfo->marital_status)Marital status @endif
                                                              @endif
                                                        </li>
														<li> @if($contactCount && $resumeAccess->contactData)Contact number @endif</li>
														<li> @if($contactCount && $resumeAccess->contactData && $contactInfo->altPhone!='')Alternat number @endif</li>
														<li> @if($contactCount && $resumeAccess->contactData)Email @endif</li>
														<li> @if($currentAddressCount > 0 || $permanentAddressCount>0)Current location @endif</li>
													</ul>
												</li>
												<li class="col2">
													<ul>
														<li>
                                                            @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                                            @if($basicInfo->dob != '//')<span class="highlight1">{{$basicInfo->dob}}</span>@endif
                                                            @endif
														</li>
														<li>
                                                            @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                                            @if($basicInfo->marital_status)<span class="highlight1">{{$basicInfo->marital_status}}</span>@endif
                                                            @endif
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
															<span class="highlight1">
                                                                @if($currentAddressCount)
                                                                    {{$currentAddressInfo->city}}, {{$currentAddressInfo->country}}
                                                                @endif
                                                                @if($currentAddressCount == 0 && $permanentAddressCount>0)
                                                                {{$permanentAddressInfo->city}}, {{$permanentAddressInfo->country}}
                                                            @endif
                                                            </span>
                                                        </li>

													</ul>
												</li>
											</ul>
                                        </div>
                                        @if($print_hide)
                <div class="text-center no-print"><button class="btn btn-primary" onClick="window.print();">Print</button></div>
                @endif
                                    </div>


								</div>
							</div>
						</div>

					</div>
                </div>

			</div>
		</div>
    </section>



</body>
</html>