@extends('layouts.app')
@section('content')
<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <div class="top-panel">
                        <h1 class="resume-header">View resume</h1>
                        <div class="header-name-panel">
                            <div class="chip viewresume-clip">
                                @if($profileData->profilePrivate == '0' && $profileData->avatar != "" && $resumeAccess->profileData != "0")
                                        <img alt="{{$profileData->first_name}} {{$profileData->last_name}}" src="{{get_user_image($profileData->avatar)}}">
                                @endif
                                {{$profileData->first_name}} {{$profileData->last_name}}
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
        <li><a href="{{url('resume/forwardresume/'.$resumeAccess->id)}}" class="btn-floating red"><i class="material-icons">forward</i></a></li>
          <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
          <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
          <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
        </ul>
      </div>
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
                                        <h3 class="name">{{$basicInfo->first_name }} {{$basicInfo->middle_name}} {{$basicInfo->last_name}}</h3>
                                    @else
                                        <h3 class="name">{{$profileData->first_name}} {{$profileData->last_name}}</h3>
                                    @endif
                                    @if(isset($workInfo[0]) && $resumeAccess->workData)
                                        <div class="display-flex align-items-center sm-display-block">
                                            <strong class="black-text"><b>{{$workInfo[0]->designation }}</b></strong>
                                            <span class="dot-separator"></span>
                                            <em class="highlight1">{{$workInfo[0]->department }}</em>
                                        </div>
                                        <div class="display-flex align-items-center sm-display-block">
                                            <strong class="black-text"><b>{{$workInfo[0]->company}}</b></strong>
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
                                        <ul class="user-contact-info sm-content-center showedit">
                                            <li class="phone">
                                                <img src="{{my_asset('images/baseline-phone-24px.svg')}}" />
                                                <a href="tel:{{$contactInfo->primaryPhoneCode}} {{$contactInfo->primaryPhone}}">+{{$contactInfo->primaryPhoneCode}}-{{$contactInfo->primaryPhone}}</a>
                                            </li>
                                            <li class="email">
                                                <img src="{{my_asset('images/baseline-email-24px.svg')}}" />
                                                <a href="mailto:<?php echo $contactInfo->altEmail!="" ? $contactInfo->altEmail: $profileData->email; ?>">
                                                        <?php echo $contactInfo->altEmail!="" ? $contactInfo->altEmail: $profileData->email; ?>
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
                                            <img src="{{get_user_image($profileData->avatar)}}" title='{{$basicInfoCount>0 ? $basicInfo->first_name . " " . $basicInfo->last_name : $profileData->first_name." ".$profileData->last_name}}' />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="block">
                                @if($coverNoteCount>0 && $resumeAccess->resumetitleData)
                                <h2 class="showedit">{{$coverNote->resume_title}}</h2>
                                @endif
                                    @if($skillCount > 0  && $resumeAccess->skillData)
                                    <div class="exp-details-sub1 hightlightFSkils black-text showedit">
                                        <p>{{getSkillFromJson($skillInfo->skill)}}

                                    </p>

                                    </div>
                                    @endif
                                    @if($softskillCount>0  && $resumeAccess->softskillData)
                                    <div class="exp-details-sub1 hightlightFSkils black-text showedit">
                                        <p>{{getSkillFromJson($softskillInfo->soft_skill)}}

                                    </p>
                                    </div>
                                    @endif
                                    @if($objectiveCount && $resumeAccess->objectiveData)
                                    <div class="exp-details showedit">
                                        <p>
                                            <?php echo str_replace("<br><br>", '<br>', nl2br($objectiveInfo->objective));?>
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                <?php if($workCount > 0 && $resumeAccess->workData) {?>
                                <div class="block">
                                    <h2 class="showedit">Work experience
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
                                <h2 class="showedit">Key assignments and projects
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
                                    <h2 class="showedit">Awards</h2>
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
                                    <h2 class="showedit">Trained on</h2>
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
                                    <h2 class="showedit">Certifications</h2>
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
                                    <h2 class="showedit">Education</h2>
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
                                    <h2 class="showedit">Subjects, Courses <a href="{{url('update/course?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
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
                                    <h2 class="showedit">Languages <a href="{{url('update/language?url=resume/view')}}" class="ak-resumeEdit-icon"><i class="material-icons">add</i></a></h2>
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
                                <h2 class="showedit">Interests</h2>
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
                                    <h2 class="showedit">References</h2>
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

       // $('.resume-ex').on('click', function(event){
       //     event.preventDefault();
       //     var id = $(this).attr('id');
       //     $('.'+id+'-container').toggle();
       //     $(this).toggleClass('active');

       //     if($(this).hasClass('active')){
       //         $(this).children().html('expand_less');
       //     }else{
       //         $(this).children().html('expand_more');
       //     }
       // });


    });
    </script>

@endsection
