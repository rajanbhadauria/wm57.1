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
?>


<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1 class="resume-header">Preview</h1>
                    <div class="header-name-panel">
                        <div class="chip viewresume-clip">
                           <img alt="" src="{{get_user_image(Auth::user()->avatar)}}">
                           {{$profileData->first_name}} {{$profileData->last_name}}
                         </div>
                    </div>
                    <a href="#" class="panel-menu-icon">
                        <i class="material-icons">call</i>
                    </a>
                    <a href="#" class="panel-menu-icon">
                        <i class="material-icons">message</i>
                    </a>
                    <a href="#" class="panel-menu-icon">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="{{URL::to('resume/send')}}" class="panel-menu-icon">
                        <i class="material-icons">near_me</i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit gray-background">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box mb55" id="loginDiv"  >
                <div class="inner-half-container">
                    <div class="row mb0">
                        <div class="col s12">
                            <div class="r-box-img">
                                <div class="r-box-img-left">
                                    <div class="auth-mobile-img">
                                        <img alt="" src="{{get_user_image(Auth::user()->avatar)}}">
                                    </div>
                                    <h1 class="mb5 text-white">{{$profileData->first_name}} {{$profileData->last_name}}</h1>
                                     @if($workCount>0)
                                        @foreach($workInfo as $work)
                                            @if($work->designation!='' && $work->yyyyEnd=="")
                                                <p>{{$work->designation}}</p>
                                                <p>{{$work->company}}{{$work->city!=''?", ".$work->city:""}}{{$work->country!=''?", ".$work->country:""}}</p>
                                            @endif
                                        @endforeach
                                    @else

                                    @endif
                                    @if($educationCount>0)
                                        <?php $education = $educationInfo[0] ?>
                                        <p class="c666 pb0 ceee">{{$education->educationName}} from {{$education->school}}</p>
                                    @else

                                    @endif
                                    </p>

                                </div>
                                <div class="r-box-img-right">
                                    <div class="auth-img-container">
                                        <img alt="" src="{{get_user_image(Auth::user()->avatar)}}">
                                    </div>
                                </div>

                            </div>
                            <div class="r-box" id="objectiveInfo">
                                <div class="resume-edit"><a href="{{URL::to('update/objective')}}?redirectBack=view"><i class="material-icons">create</i></a></div>
                                <h2><span class="tlicon"> @if($objectiveCount > 0 && $objectiveInfo->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Objective @if($resumeAccess->objectiveData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif</h2>
                                <p class="c666">
                                        @if($objectiveCount > 0)
                                            {{$objectiveInfo->objective}}
                                        @else
                                            <a href="{{URL::to('update/objective')}}?redirectBack=view">Click to add objective</a>
                                        @endif
                                </p>
                            </div>
                            <div class="r-box" id="skillInfo">
                                <div class="resume-edit"><a href="{{URL::to('update/skill')}}?redirectBack=view"><i class="material-icons">create</i></a></div>
                                <h2><span class="tlicon"> @if($skillCount > 0 && $skillInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif</span> Skills @if($resumeAccess->skillData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                <div class="pt10">
                                    @if($skillCount > 0)
                                            <?php $skills = json_decode($skillInfo[0]->skill); ?>
                                            @foreach($skills as $skill)
                                            <div class="chip">
                                                {{$skill->id}}
                                            </div>
                                            @endforeach
                                    @else
                                            <a href="{{URL::to('update/skill')}}?redirectBack=view">Click to add skills</a>
                                    @endif
                                </div>
                            </div>
                              <div class="r-box" id="workInfo">
                                <h2><span class="tlicon"> @if($workCount > 0 && $workInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif</span> Work experience - {{isset($totalWorkDuration)?$totalWorkDuration:""}} @if($resumeAccess->workData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($workCount > 0)
                                    @foreach($workInfo as $work)
                                        @if($work->designation!='')
                                            <h4>{{$work->designation}} &#183; {{$work->duration}} <a href="{{URL::to('update/work')}}/{{$work->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                            <p class="c666">
                                                {{$work->department}}<br/>
                                                @if($work->company)
                                                {{$work->company}}{{isset($work->city) && $work->city!=''?", ".$work->city:""}}
                                                    <br/>
                                                @endif
                                                @if($work->yyyyStart != "")
                                                    {{ date("M",strtotime($work->workStartDate)) }} {{ $work->yyyyStart}} -
                                                    @if($work->yyyyEnd!='')
                                                    {{ date("M",strtotime($work->workEndDate)) }} {{ $work->yyyyEnd }}
                                                    @else
                                                    Present
                                                    @endif
                                                @endif
                                            </p>
                                            @if(isset($work->roleDesc) && $work->roleDesc!='')
                                            <p class="mb5 c666"><b>{{showWorkDetails($work->role)}}</b>
                                                <?php showWithReadMore($work->roleDesc) ?>
                                            </p>
                                            @endif

                                        @endif
                                        @endforeach
                                    @else
                                            <a href="{{URL::to('update/work')}}?redirectBack=view">Click to add work experience</a>
                                    @endif
                            </div>
                            <div class="r-box" id="educationInfo">

                                <h2> <span class="tlicon"> @if($educationCount > 0 && $educationInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Education @if($resumeAccess->educationData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($educationCount > 0)
                                    @foreach($educationInfo as $education)
                                        <h4>{{$education->educationName}}
                                        @if($education->gradeValue!="")
                                            @if($education->grade=="percentage")
                                                ({{$education->gradeValue}} %)
                                            @elseif($education->grade=="gpa")
                                                ({{$education->gradeValue}} GPA)
                                            @else
                                                ({{$education->gradeValue}} Grade)
                                            @endif
                                        @endif ,
                                        {{$education->branch}} <a href="{{URL::to('update/education')}}/{{$education->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="mb5 c666">
                                            {{$education->school}}<br/>
                                            {{$education->city}}, {{$education->country}}<br/>
                                            @if($education->dd != "")
                                                {{date("M",strtotime($education->educationDate))}} {{$education->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/education?redirectBack=view')}}">Click to update education</a>
                                @endif

                            </div>

                            <div class="r-box" id="projectInfo">
                                <h2> <span class="tlicon"> @if($projectCount > 0 && $projectInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Key projects @if($resumeAccess->projectData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($projectCount > 0)
                                    @foreach($projectInfo as $project)
                                        <h4>{{$project->name}} <a href="{{URL::to('update/project')}}/{{$project->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="c666">
                                            {{$project->school}}{{$project->city!=""?", ".$project->city:""}}{{$project->country!=""?", ".$project->country:""}}<br/>
                                            @if($project->dd != "")
                                                {{date("M",strtotime($project->projectDate))}} {{$project->yyyy}}
                                            @endif
                                        </p>
                                        <p class="mb5 c666">{{$project->projectDesc}}</p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/project?redirectBack=view')}}">Click to update key project</a>
                                @endif
                            </div>

                            <div class="r-box" id="certificationInfo">
                                <h2> <span class="tlicon"> @if($certificationCount > 0 && $certificationInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Certification @if($resumeAccess->certificationData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($certificationCount > 0)
                                    @foreach($certificationInfo as $certification)
                                        <h4>{{$certification->certification}} <a href="{{URL::to('update/certification')}}/{{$certification->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="mb5 c666">

                                            {{$certification->school}}{{$certification->city!=""?", ".$certification->city:""}}{{$certification->country!=""?", ".$certification->country:""}}<br/>
                                            @if($certification->dd != "")
                                                {{date("M",strtotime($certification->certificationDate))}} {{$certification->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/certification?redirectBack=view')}}">Click to update certification</a>
                                @endif
                            </div>
                            <div class="r-box" id="trainingInfo">
                                <h2> <span class="tlicon"> @if($trainingCount > 0 && $trainingInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Trainings attended @if($resumeAccess->trainingData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($trainingCount > 0)
                                    @foreach($trainingInfo as $training)
                                        <h4>{{$training->training}} <a href="{{URL::to('update/training')}}/{{$training->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="mb5 c666">
                                            {{$training->school}}{{$training->city!=""?", ".$training->city:""}}{{$training->country!=""?", ".$training->country:""}}<br/>
                                            @if($training->dd != "")
                                                {{date("M",strtotime($training->trainingDate))}} {{$training->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/training?redirectBack=view')}}">Click to update training attended</a>
                                @endif
                            </div>
                            <div class="r-box" id="courseInfo">
                                <h2> <span class="tlicon"> @if($courseCount > 0 && $courseInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Subjects, Courses @if($resumeAccess->courseData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($courseCount > 0)
                                    @foreach($courseInfo as $course)
                                        <h4>{{$course->course}} <a href="{{URL::to('update/course')}}/{{$course->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="mb5 c666">
                                            {{$course->school}}{{$course->city!=""?", ".$course->city:""}}{{$course->country!=""?", ".$course->country:""}}<br/>
                                            @if($course->dd != "")
                                                {{date("M",strtotime($course->courseDate))}} {{$course->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/course?redirectBack=view')}}">Click to update subjects, courses</a>
                                @endif
                            </div>
                            <div class="r-box" id="travelInfo">
                                <h2> <span class="tlicon"> @if($travelCount > 0 && $travelInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Work related travel @if($resumeAccess->travelData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>

                                @if($travelCount > 0)
                                    @foreach($travelInfo as $travel)
                                        <h4>{{$travel->project}} <a href="{{URL::to('update/travel')}}/{{$travel->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="c666">
                                            {{$travel->company}}{{$travel->city!=''?", ".$travel->city:""}}, {{$travel->country!=''?", ".$travel->country:""}}<br/>
                                            @if($travel->ddStart != "")
                                                {{ date("M",strtotime($travel->projectStartDate)) }} {{ $travel->yyyyStart}} - {{ date("M",strtotime($travel->projectEndDate)) }} {{ $travel->yyyyEnd }}
                                            @endif
                                        </p>
                                        <p class="mb5 c666">
                                            <?php showWithReadMore($travel->projectDesc); ?>
                                        </p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/travel?redirectBack=view')}}">Click to update Work related travel</a>
                                @endif

                            </div>
                            <div class="r-box" id="awardInfo">
                                <h2> <span class="tlicon"> @if($awardCount > 0 && $awardInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span> Awards, Recognitions @if($resumeAccess->awardData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($awardCount > 0)
                                    @foreach($awardInfo as $award)
                                        <h4>{{$award->award}} <a href="{{URL::to('update/award')}}/{{$award->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="mb5 c666">
                                            {{$award->school}}{{$award->city!=''?", ".$award->city:""}}{{$award->country!=''?", ".$award->country:""}}<br/>
                                            @if($award->dd != "")
                                                {{date("M",strtotime($award->awardDate))}} {{$award->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/award?redirectBack=view')}}">Click to update awards, recognitions</a>
                                @endif
                            </div>
                            <div class="r-box" id="patentInfo">
                                <h2><span class="tlicon">@if($patentCount > 0 && $patentInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif</span>  Patents @if($resumeAccess->patentData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($patentCount > 0)
                                    @foreach($patentInfo as $patent)
                                        <h4>{{$patent->patent}} <a href="{{URL::to('update/patent')}}/{{$patent->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="c666">{{$patent->status}}</p>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/patent?redirectBack=view')}}">Click to update patent</a>
                                @endif
                            </div>
                            <div class="r-box pb5" id="languageInfo">

                                <h2><span class="tlicon">@if($languageCount > 0 && $languageInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif</span>  Language @if($resumeAccess->languageData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($languageCount > 0)
                                    @foreach($languageInfo as $language)
                                        <h4><a href="{{URL::to('update/language')}}/{{$language->id}}?redirectBack=view"><i class="material-icons">create</i></a><span class="subtl">{{$language->language}}</span>
                                            <span class="stlfs">
                                                <?php showLanguages($language) ?>
                                            </span>
                                        </h4>
                                    @endforeach
                                @else
                                    <a href="{{URL::to('update/language?redirectBack=view')}}">Click to update language</a>
                                @endif
                            </div>

                            <div class="r-box" id="current-address">
                                <div class="resume-edit"><a href="{{URL::to('update/current-address?redirectBack=view')}}"><i class="material-icons">create</i></a></div>
                                <h2><span class="tlicon">@if($currentAddressCount && $currentAddressInfo->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif</span>  Current address @if($resumeAccess->currentAddressData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                <p class="c666">
                                @if($currentAddressCount>0)
                                    {{$currentAddressInfo->houseNumber}}{{$currentAddressInfo->blockSector!=''?", ".$currentAddressInfo->blockSector:""}}<br/>
                                    {{$currentAddressInfo->societyName}}<br/>
                                    {{$currentAddressInfo->landmark}}{{$currentAddressInfo->area!=""?", ".$currentAddressInfo->area:""}}<br/>
                                    {{$currentAddressInfo->city}}{{($currentAddressInfo->pincode!=''?" - ".$currentAddressInfo->pincode:"")}}<br/>
                                    {{$currentAddressInfo->country}}
                                @else
                                        <a href="{{URL::to('update/current-address?redirectBack=view')}}">Click to update current address</a>
                                @endif
                                </p>
                            </div>
                            <div class="r-box" id="permanent-address">
                                <div class="resume-edit"><a href="{{URL::to('update/permanent-address')}}?redirectBack=view"><i class="material-icons">create</i></a></div>
                                <h2><span class="tlicon">@if($permanentAddressCount && $permanentAddressInfo->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif</span>  Permanent address @if($resumeAccess->permanentAddressData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                <p class="c666">
                                @if($permanentAddressCount>0)
                                    {{$permanentAddressInfo->houseNumber}}{{$permanentAddressInfo->blockSector!=""?", ".$permanentAddressInfo->blockSector:""}}<br/>
                                    {{$permanentAddressInfo->societyName}}<br/>
                                    {{$permanentAddressInfo->landmark}}{{($permanentAddressInfo->area!=''?", ".$permanentAddressInfo->area:"")}}<br/>
                                    {{$permanentAddressInfo->city}}{{($permanentAddressInfo->pincode!=''?" - ".$permanentAddressInfo->pincode:"")}}<br/>
                                    {{$permanentAddressInfo->country}}
                                @else
                                        <a href="{{URL::to('update/permanent-address')}}?redirectBack=view">Click to update permanent address</a>
                                @endif
                                </p>
                            </div>
                            <div class="r-box" id="referenceInfo">
                                <h2><span class="tlicon"> @if($referenceCount > 0 && $referenceInfo[0]->private=='0')<i class="material-icons iunlock">lock_open</i>@else <i class="material-icons ilock">lock_outline</i> @endif </span>  References @if($resumeAccess->referenceData=='1') <span class="tlicon"><i class="material-icons grn">check</i></span> @endif </h2>
                                @if($referenceCount>0)
                                    @foreach($referenceInfo as $reference)
                                        <h4>{{$reference->reference}} <a href="{{URL::to('update/reference')}}/{{$reference->id}}?redirectBack=view"><i class="material-icons">create</i></a></h4>
                                        <p class="c666">
                                            {{$reference->role}}
                                            @if($reference->school != "")
                                                at {{$reference->school}}
                                            @endif
                                            <br/>
                                        {{$reference->email}}, {{$reference->phone}}</p>
                                        <p class="mb5 c666">{{$reference->remarks}}</p>
                                    @endforeach
                                @else
                                        <a href="{{URL::to('update/reference?redirectBack=view')}}">Click to update reference</a>
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
