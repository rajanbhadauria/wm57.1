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

    <!-- new view -->


<link href="{{my_asset('css/mainresume.css')}}" rel="stylesheet" media="all" />
<style>
body { padding-top: 0px;}
.wrapper { padding: 25px;}
</style>
<?php if($style) { ?>
    <style>
        body {
            font-family: <?php echo $style->font_family?>;
        }
         h3.name { color: <?php echo $style->font_heading_color?> !important;}
        .block h2 { color: <?php echo $style->font_heading_color?>;}
    </style>
<?php } ?>

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
												<strong><b>{{$workInfo[0]->designation }}</b></strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$workInfo[0]->department }}</em>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong><b>{{$workInfo[0]->company}}</b></strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$workInfo[0]->city}}<span class="dot-separator"></span>{{$workInfo[0]->country}}</em>
                                            </div>
                                            @endif
                                            @if($educationCount  && $resumeAccess->educationData)
											<span class="hr"></span>
											<div class="display-flex align-items-center sm-display-block">
												<strong><b>{{$educationInfo[0]->educationName}}</b></strong>
												<span class="dot-separator"></span>
												<em class="highlight1">{{$educationInfo[0]->branch}}<span class="dot-separator"></span>{{$educationInfo[0]->yyyy}}</em>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong><b>{{$educationInfo[0]->school}}</b></strong>
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
                                                            <?php echo $contactInfo->altEmail!="" ? $contactInfo->altEmail: Auth::user()->email; ?>
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
                                                @if($profileData)
                                                <img src="{{get_user_image(Auth::user()->avatar)}}" title='{{$basicInfoCount>0 ? $basicInfo->first_name . " " . $basicInfo->last_name : Auth::user()->first_name." ".Auth::user()->last_name}}' />
                                                @endif
											</div>
										</div>
									</div>
									<div class="block">
                                    @if($coverNoteCount>0 && $resumeAccess->resumetitleData)
                                    <h2>{{$coverNote->resume_title}}</h2>
                                    @endif
                                        @if($skillCount > 0  && $resumeAccess->skillData)
										<div class="exp-details-sub1 hightlightFSkils">
											<p>{{getSkillFromJson($skillInfo->skill)}}</p>
                                        </div>
                                        @endif
                                        @if($softskillCount>0  && $resumeAccess->softskillData)
                                        <div class="exp-details-sub1 hightlightFSkils">
											<p>{{getSkillFromJson($softskillInfo->soft_skill)}}</p>
                                        </div>
                                        @endif
                                        @if($objectiveCount && $resumeAccess->objectiveData)
										<div class="exp-details">
											<p><?php echo str_replace("<br><br>", '<br>', nl2br($objectiveInfo->objective));?></p>
                                        </div>
                                        @endif
                                    </div>
                                    <?php if($workCount > 0 && $resumeAccess->workData) {?>
									<div class="block">
										<h2>Work experience
											<span class="dot-separator" style="position:relative;top:-1px;"></span>
                                            <span class="highlight1">{{$totalWorkDuration}}</span>
                                        </h2>

                                        <?php foreach($workInfo as $work) {?>
										<div class="ak-exp-details-editable ak-editcol">
										<div class="exp-details">
											<div class="col1 black-text text-lighten-3">
												<strong>{{$work->yyyyStart}}</strong>
											</div>
											<div class="col2">
                                                <strong class="black-text text-lighten-3">{{$work->designation}}<span class="dot-separator"></span>
                                                <span class="highlight1">{{$work->department}}</span>
                                                </strong>

												<p>
													<strong class="black-text text-lighten-3">{{$work->company}}</strong>
													<span class="dot-separator"></span>
													<span class="highlight1">{{$work->city}}</span>
                                                    <span class="dot-separator"></span>{{$work->country}}
												</p>
                                                <p>
                                                    <strong class="black-text text-lighten-3">{{getMonthName($work->mmStart)}} {{$work->yyyyStart}} – {{($work->yyyyEnd) ? getMonthName($work->mmEnd)." ".$work->yyyyEnd: "Present"}}</strong>
												    <span class="dot-separator"></span>
                                                    @if(isset($work->duration))
                                                    <span class="highlight1">{{$work->duration}}</span>
                                                    @endif
                                                </p>

                                            </div>
                                            @if($work->roleDesc)
                                                <div class="exp-details-sub">
                                                    <ul class='list'>
                                                    <li><?php echo str_replace("<br />", '</li><li>', nl2br(str_replace('•	', " ", $work->roleDesc))); ?></li>
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
                                    <h2>Key assignments and projects</h2>

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
										<h2>Publications
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Research
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Patent
											<span class="dot-separator" style="position:relative;top:-1px;"></span>etc
                                        </h2>

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
										<h2>Awards</h2>
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
                                                    </strong>

                                                </div>

                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($trainingCount>0 && $resumeAccess->trainingData)
									<div class="block">
										<h2>Trained on</h2>
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

                                            </div>
                                        </div>
										</div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($certificationCount>0 && $resumeAccess->certificationData)
									<div class="block">
										<h2>Certifications</h2>
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
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($educationCount>0 && $resumeAccess->educationData)
									<div class="block">
										<h2>Education</h2>
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

											</div>
                                        </div>

                                    </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($courseCount > 0 && $resumeAccess->courseData)
									<div class="block">
										<h2>Subjects, Courses</h2>
                                        @foreach($courseInfo as $course)
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
											<p><strong  class="black-text text-lighten-3">{{$course->course}}</strong>
												<span class="highlight1">({{str_replace('%', '',$course->gradeValue)}}{{$course->grade == 'percentage' ? '%' : ($course->grade == ' GPA' ? 'GPA' : ' grade') }})</span>
                                            </p>
                                        </div>

                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if($languageCount>0 && $resumeAccess->languageData)
									<div class="block">
										<h2>Languages</h2>
                                        <div class="ak-exp-details-editable ak-editcol">
                                        <div class="exp-details">
                                            @foreach($languageInfo as $language1)
                                            <p>
                                                <strong  class="black-text text-lighten-3">{{$language1->language}}</strong>
                                                <span class="highlight1">({{showLanguages($language1)}})</span>

                                            </p>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($interestCount>0 && $resumeAccess->interestData)
									<div class="block">
                                    <h2>Interests</h2>
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
										<h2>References</h2>
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
                                        </div>

                                        </div>
                                        @endforeach
                                    </div>
                                    @endif

									<div class="block">
                                        @if($basicInfoCount >0  && $resumeAccess->basicInfoData)
                                            <h2>Additional details</h2>
                                        @endif
										<div class="exp-details">
                                                <div class="col s12 m12">
                                                        @if($basicInfo && $basicInfo->dob != '//')
                                                            <span class="highlight1">{{$basicInfo->dob}} (DOB)</span>
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
                                                </div>
                                                <div class="col s12 m12">
                                                @if($currentAddressCount)
                                                    <span class="highlight1">{{$currentAddressInfo->area}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$currentAddressInfo->city}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$currentAddressInfo->country}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$currentAddressInfo->pincode}}(Current address)</span>
                                                @elseif($currentAddressCount == 0 && $permanentAddressCount>0)
                                                    <span class="highlight1">{{$permanentAddressInfo->area}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$permanentAddressInfo->city}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$permanentAddressInfo->country}}</span><span class="dot-separator"></span>
                                                    <span class="highlight1">{{$permanentAddressInfo->pincode}}(Permanent address)</span>
                                                @endif
                                                </div>
										</div>
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
	</section>




    <!-- end new view -->


</body>
</html>
