@extends('layouts.app')
@section('content')


<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1 class="resume-header">View resume</h1>
                    <div class="header-name-panel">
                        <div class="chip viewresume-clip">
                            @if($profileData->avatar != "")
                                @if(strpos($profileData->avatar,"ttp:"))
                                    <img alt="" src="{{$profileData->avatar}}">
                                @else
                                    <img alt="" src="/uploads/images/user/{{$profileData->avatar}}">
                                @endif
                            @else
                                <img alt="" src="/uploads/images/user/user-img-white.jpg">
                            @endif
                            {{$profileData->first_name}} {{$profileData->last_name}}
                          </div>
                    </div>
                    <a href="#" class="panel-menu-icon">
                        <i class="material-icons">call</i>
                    </a>
                    <a href="#" class="panel-menu-icon pi-btn1">
                        <i class="material-icons">message</i>
                    </a>
                    <a href="{{URL::to('resume/send')}}" class="panel-menu-icon pi-btn2">
                        <i class="material-icons">near_me</i>
                    </a>
                    
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit gray-background">
      <div class="container" id="publishedResume">
        <div class="center-wrapper" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container">
                    <div class="row mb0">
                        <div class="col s12">
                            <div class="r-box-img">
                                <div class="r-box-img-left">
                                    <div class="auth-mobile-img">
                                        @if($profileData->avatar != "")
                                            @if(strpos($profileData->avatar,"ttp:"))
                                                <img alt="" src="{{$profileData->avatar}}">
                                            @else
                                                <img alt="" src="/uploads/images/user/{{$profileData->avatar}}">
                                            @endif
                                        @else
                                            <img alt="" src="/uploads/images/user/user-img-white.jpg">
                                        @endif
                                    </div>
                                    <h1 class="mb5">{{$profileData->first_name}} {{$profileData->last_name}}</h1>
                                     @if($currentWorkCount>0)
                                        <p>{{$currentWorkInfo->designation}}</p>
                                        <p>{{$currentWorkInfo->company}}, {{$currentWorkInfo->city}}, {{$currentWorkInfo->country}}</p>
                                    @else

                                    @endif
                                    @if($educationCount>0)
                                        <?php $education = $educationInfo[0] ?>
                                        <p class="c666"><i>{{$education->educationName}} &#183; {{$education->school}} &#183; {{$education->city}}</i></p>
                                    @else

                                    @endif
                                </div>
                               <div class="r-box-img-right">
                                    <div class="auth-img-container">
                                        @if($profileData->avatar != "")
                                            @if(strpos($profileData->avatar,"ttp:"))
                                                <img alt="" src="{{$profileData->avatar}}">
                                            @else
                                                <img alt="" src="/uploads/images/user/{{$profileData->avatar}}">
                                            @endif
                                        @else
                                            <img alt="" src="/uploads/images/user/user-img-white.jpg">
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                            @if($objectiveCount > 0 && $objectiveInfo['private'] == "0")
                                <div class="r-box"> 
                                    <!--<div class="resume-edit"> <a href="#" class="resume-ex"><i class="material-icons">expand_more</i></a></div>-->                        
                                        <h2>Objective </h2>
                                        <p class="c666">{{$objectiveInfo->objective}}</p>
                                </div>
                            @endif
                            @if($skillCount > 0 && $skillInfo[0]->private == "0")
                            <div class="r-box">
                                <!--<div class="resume-edit"> <a href="#" class="resume-ex"><i class="material-icons">expand_more</i></a></div>-->
                                <h2>Skills </h2>
                                <div class="pt10">
                                    <?php $skills = json_decode($skillInfo[0]->skill); ?>
                                        @foreach($skills as $skill)
                                            <div class="chip">
                                                {{$skill->id}}
                                            </div>
                                        @endforeach
                                </div>  
                            </div>
                            @endif
                              
                            @if($workCount > 0 && $workInfo[0]->private == "0")  
                                <div class="r-box">
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div03"><i class="material-icons">expand_more</i></a></div>
                                    <h2>Work experience &#183; {{isset($totalWorkDuration)?$totalWorkDuration:""}} </h2>
                                    @foreach($workInfo as $work)
                                        
                                        <h4>2012 &#183; {{$work->company}} &#183; {{$work->designation}} <span class="achievement tooltipped"  data-position="top" data-delay="50" data-tooltip="Achievement"><i class="material-icons">lens</i></span></h4>
                                        <div class="resume-container div03-container">
                                            <p class="c666">
                                                {{$work->department}}<br/>
                                                {{$work->company}}, {{$work->city}}<br/>
                                                @if($work->ddStart != "")
                                                    {{ date("M",strtotime($work->workStartDate)) }} {{ $work->yyyyStart}} - {{ date("M",strtotime($work->workEndDate)) }} {{ $work->yyyyEnd }}
                                                @endif
                                            </p>
                                            <p class="mb5 c666"><b>{{$work->role}} - </b> <?php echo substr($work->roleDesc,0,50); ?>, <span class="rm"><span>...</span> Read more</span><span class="rc"><?php echo substr($work->roleDesc,50,-1); ?></span><span class="rl">Read less</span>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if($educationCount > 0 && $educationInfo[0]->private == "0")
                            <div class="r-box">
                                
                                <h2>Education </h2>
                                <div class="resume-edit"><a href="#" class="resume-ex" id="div04"><i class="material-icons">expand_more</i></a></div>
                                @foreach($educationInfo as $education)
                                    <h4>{{$education->yyyy}} &#183; {{$education->gradeValue}} &#183; {{$education->branch}} </h4>
                                    <p class="mb5 c666 resume-container div04-container">
                                        {{$education->school}}<br/>
                                        {{$education->city}}, {{$education->country}}<br/>
                                        @if($education->dd != "")
                                                {{date("M",strtotime($education->educationDate))}} {{$education->yyyy}}
                                        @endif
                                    </p>                                
                                @endforeach
                            </div>   
                            @endif
                            @if($projectCount > 0 && $projectInfo[0]->private == "0")
                                <div class="r-box">
                                    <h2>Key projects </h2>
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div05"><i class="material-icons">expand_more</i></a></div>
                                    @foreach($projectInfo as $project)
                                        <h4>{{$project->project}}</h4>
                                        <p class="c666 resume-container div05-container">
                                            {{$project->school}}, {{$project->city}}, {{$project->country}}<br/>
                                            @if($project->dd != "")
                                                {{date("M",strtotime($project->projectDate))}} {{$project->yyyy}}
                                            @endif
                                        </p>
                                        <p class="mb5 c666 resume-container div05-container">{{$project->projectDesc}}</p>
                                    @endforeach
                                </div>
                            @endif
                            
                            @if($certificationCount > 0 && $certificationInfo[0]->private == "0")
                                <div class="r-box">
                                    <h2>Certification </h2>
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div06"><i class="material-icons">expand_more</i></a></div>
                                    @foreach($certificationInfo as $certification)
                                        <h4>{{$certification->certification}}</h4>
                                        <p class="mb5 c666 resume-container div06-container">
                                            {{$certification->school}}, {{$certification->city}}, {{$certification->country}}<br/>
                                            @if($certification->dd != "")
                                                {{date("M",strtotime($certification->certificationDate))}} {{$certification->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                </div>

                            @endif
                            @if($trainingCount > 0 && $trainingInfo[0]->private == "0")
                            <div class="r-box">
                                <h2>Trainings attended </h2>
                                <div class="resume-edit"><a href="#" class="resume-ex" id="div07"><i class="material-icons">expand_more</i></a></div>
                                @foreach($trainingInfo as $training)
                                    <h4>{{$training->training}} </h4>
                                    <p class="mb5 c666 resume-container div07-container">
                                        {{$training->school}}, {{$training->city}}, {{$training->country}}<br/>
                                        @if($training->dd != "")
                                            {{date("M",strtotime($training->trainingDate))}} {{$training->yyyy}}
                                        @endif
                                    </p>
                                @endforeach
                            </div>
                            @endif
                            @if($courseCount > 0 && $courseInfo[0]->private == "0")
                                <div class="r-box">
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div08"><i class="material-icons">expand_more</i></a></div>
                                    <h2>Subjects, Courses </h2>
                                    @foreach($courseInfo as $course)
                                        <h4>{{$course->course}}</h4>
                                        <p class="mb5 c666 resume-container div08-container">
                                            {{$course->school}}<br/>
                                            @if($course->dd != "")
                                                {{date("M",strtotime($course->courseDate))}} {{$course->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                            @if($travelCount > 0 && $travelInfo[0]->private == "0")
                                <div class="r-box">
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div09"><i class="material-icons">expand_more</i></a></div>
                                    <h2>Work related travel </h2>
                                    @foreach($travelInfo as $travel)
                                        <h4>{{$travel->project}}</h4>
                                        <p class="c666 resume-container div09-container">
                                            {{$travel->company}}, {{$travel->city}}, {{$travel->country}}<br/>
                                            @if($travel->ddStart != "")
                                                {{ date("M",strtotime($travel->projectStartDate)) }} {{ $travel->yyyyStart}} - {{ date("M",strtotime($travel->projectEndDate)) }} {{ $travel->yyyyEnd }}
                                            @endif
                                        </p>
                                        <p class="mb5 c666 resume-container div09-container"><?php echo substr($travel->projectDesc,0,50); ?><span class="rm"><span>...</span> Read more</span>
                                            <span class="rc">
                                            <?php echo substr($travel->projectDesc,50,-1); ?>
                                            </span><span class="rl">Read less</span>
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                            @if($awardCount > 0 && $awardInfo[0]->private == "0")
                                <div class="r-box">
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div010"><i class="material-icons">expand_more</i></a></div>
                                    <h2>Awards, Recognitions </h2>
                                    @foreach($awardInfo as $award)
                                        <h4>{{$award->award}}</h4>
                                        <p class="mb5 c666 resume-container div010-container">
                                            {{$award->school}}, {{$award->city}}, {{$award->country}}<br/>
                                            @if($award->dd != "")
                                                {{date("M",strtotime($award->awardDate))}} {{$award->yyyy}}
                                            @endif
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                            @if($patentCount > 0 && $patentInfo[0]->private == "0")
                                <div class="r-box">
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div011"><i class="material-icons">expand_more</i></a></div>
                                    <h2> Patents </h2>
                                    @foreach($patentInfo as $patent)
                                        <h4>{{$patent->patent}} @if($patent->reference != "") - ({{$patent->reference}}) @endif</h4>
                                        <p class="c666 resume-container div011-container">{{$patent->status}}</p>
                                    @endforeach
                                </div>
                            @endif
                            @if($languageCount > 0 && $languageInfo[0]->private == "0")
                            <div class="r-box pb5">
                                <div class="resume-edit"><a href="#" class="resume-ex" id="div0111"><i class="material-icons">expand_more</i></a></div>
                                <h2> Language</h2>
                                <div class="resume-container div0111-container">
                                    @foreach($languageInfo as $language)
                                    <h4><span class="subtl fwn c666">{{$language->language}}</span>  <span class="stlfs fwn c666">{{$language->read?"Read,":""}} {{$language->write?"Write, ":""}}{{$language->speak?"Speak":""}}</span></h4>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if($currentAddressCount>0 && $currentAddressInfo->private == "0")
                                <div class="r-box">
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div012"><i class="material-icons">expand_more</i></a></div>
                                    <h2> Current address </h2>
                                    <p class="c666 resume-container div012-container">
                                    {{$currentAddressInfo->houseNumber}}, {{$currentAddressInfo->blockSector}} ,<br/>
                                    {{$currentAddressInfo->societyName}}<br/>
                                    {{$currentAddressInfo->landmark}}, {{$currentAddressInfo->area}}<br/>
                                    {{$currentAddressInfo->city}} - {{$currentAddressInfo->pincode}}<br/>
                                    {{$currentAddressInfo->country}} 
                                    </p>
                                </div>
                            @endif
                            @if($permanentAddressCount>0 && $permanentAddressInfo->private == "0")
                            <div class="r-box">
                                <div class="resume-edit"><a href="#" class="resume-ex" id="div013"><i class="material-icons">expand_more</i></a></div>
                                <h2> Permanent address </h2>
                                <p class="c666 resume-container div013-container">
                                {{$permanentAddressInfo->houseNumber}}, {{$permanentAddressInfo->blockSector}} ,<br/>
                                {{$permanentAddressInfo->societyName}}<br/>
                                {{$permanentAddressInfo->landmark}}, {{$permanentAddressInfo->area}}<br/>
                                {{$permanentAddressInfo->city}} - {{$permanentAddressInfo->pincode}}<br/>
                                {{$permanentAddressInfo->country}} 
                                </p>
                            </div>
                            @endif
                            @if($referenceCount>0 && $referenceInfo[0]->private == "0")
                                <div class="r-box">
                                    <div class="resume-edit"><a href="#" class="resume-ex" id="div014"><i class="material-icons">expand_more</i></a></div>
                                    <h2> References </h2>
                                    @foreach($referenceInfo as $reference)
                                        <h4 class="">{{$reference->reference}}</h4>
                                        <p class="c666 resume-container div014-container">{{$reference->role}}
                                        @if($reference->school != "") 
                                                at {{$reference->school}}
                                        @endif
                                        {{$reference->email}}, {{$reference->phone}}</p>
                                        <p class="mb5 c666 resume-container div014-container">{{$reference->remarks}}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="r-box mb0">
                                <div class="resume-edit"><a href="#" class="resume-ex" id="div015"><i class="material-icons">expand_more</i></a></div>
                                <h2> Cover note </h2>
                                <p class="c666 resume-container div015-container">
                                    I am writing to apply for the programmer position advertised in the Times Union. As requested, I am enclosing a completed job application, my certification, my resume, and three references.
                                    <br/><br/>
                                    The opportunity presented in this listing is very interesting, and I believe that my strong technical experience and education will make me a very competitive candidate for this position. The key strengths that I possess for success in this position include:
                                    <br/><br/>
                                    I have successfully designed, developed, and supported live use applications
                                    <br/><br/>
                                    I strive for continued excellence<br/>
                                    I provide exceptional contributions to customer service for all customers<br/>
                                    With a BS degree in Computer Programming, I have a full understanding of the full lifecycle of a software development project. I also have experience in learning and excelling at new technologies as needed.
                                    <br/><br/>
                                    Please see my resume for additional information on my experience.
                                    <br/><br/>
                                    I can be reached anytime via email at john.donaldson@emailexample.com or my cell phone, 909-555-5555.
                                    <br/><br/>
                                    Thank you for your time and consideration. I look forward to speaking with you about this employment opportunity.
                                </p>
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