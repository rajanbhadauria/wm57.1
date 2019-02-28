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
							<li><a href="javascript:void(0);"  class="text-primary"><i class="material-icons">edit</i></a></li>
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
											<div class="display-flex align-items-center sm-display-block">
												<strong>Senior Vice President</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">Business Excellence</em>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong>Cognizant</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">Noida<span class="dot-separator"></span>India</em>
											</div>
											<span class="hr"></span>
											<div class="display-flex align-items-center sm-display-block">
												<strong>MBA</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">Marketing<span class="dot-separator"></span>2003</em>
											</div>
											<div class="display-flex align-items-center sm-display-block">
												<strong>Chicago Booth School</strong>
												<span class="dot-separator"></span>
												<em class="highlight1">New York<span class="dot-separator"></span>US</em>
											</div>
											<span class="hr"></span>
											<ul class="user-contact-info sm-content-center">
												<li class="phone">
													<img src="assets/images/baseline-phone-24px.svg" />
													<a href="tel:+1 6565576788">+1 6565576788</a>
												</li>
												<li class="email">
													<img src="assets/images/baseline-email-24px.svg" />
													<a href="mailto:Hkumar@gmail.com">Hkumar@gmail.com</a>
												</li>
												<li class="web">
													<img src="assets/images/web.svg" />
													<a href="http://www.Hkumar.com">www.Hkumar.com</a>
												</li>
											</ul>
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

										<div class="exp-details hightlightFSkils">
											<p>{{$coverNote->resume_brand}}</p>
										</div>
										<div class="exp-details">
											<p>{{$coverNote->resume_message}}</p>
                                        </div>
                                        @endif
									</div>
									<div class="block">
										<h2>Work experience
											<span class="dot-separator" style="position:relative;top:-1px;"></span>
											<span class="highlight1">8 years 7 months</span>
											 <a href="#" class="ak-resumeEdit-icon ak-resumeAddicon"><i class="material-icons" style="font-size:18px;">add</i></a>
										</h2>

										<div class="ak-exp-details-editable">
										<div class="exp-details">
											<div class="col1">
												<strong>2018</strong>
											</div>
											<div class="col2">
												<strong>Senior Vice President<span class="dot-separator"></span><span class="highlight1">Sales
														and solutions</span>
														<a href="#" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
												</strong>
												<p>
													<strong>Cognizant</strong>
													<span class="dot-separator"></span>
													<span class="highlight1">Noida
														<span class="dot-separator"></span>India</span>
												</p>
												<p>Mar 2016 – Present
													<span class="dot-separator"></span>
													<span class="highlight1">2 years 2 months</span>
												</p>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Leading Team of Process Excellence experts ( Black Belts / Master Black
													Belts ) associated with different verticals
													of the Organization</li>
												<li>Driving Six Sigma, Lean, ITIL, ISO, Transition</li>
											</ul>
										</div>
										</div>

										<div class="ak-exp-details-editable">
										<div class="exp-details">
											<div class="col1">
												<strong>2017</strong>
											</div>
											<div class="col2">
												<strong>Assistant Vice President
													<span class="dot-separator"></span>
													<span class="highlight1">Operational performance improvement </span>
													<a href="#" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
												</strong>
												<p>HSBC
													<span class="dot-separator"></span>
													<span class="highlight1">Noida
														<span class="dot-separator"></span>India</span>
												</p>
												<p>Mar 2018 – Present
													<span class="dot-separator"></span>
													<span class="highlight1">2 years 2 months</span>
												</p>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Leading Team of Process Excellence experts ( Black Belts / Master Black
													Belts ) associated with different verticals
													of the Organization</li>
												<li>Driving Six Sigma, Lean, ITIL, ISO, Transition</li>
											</ul>
										</div>
										</div>

										<div class="ak-exp-details-editable">
										<div class="exp-details">
											<div class="col1">
												<strong>2016</strong>
											</div>
											<div class="col2">
												<strong>Assistant Vice President .
													<span class="highlight1">Operational performance improvement </span>
													<a href="#" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
												</strong>
												<p>HSBC
													<span class="dot-separator"></span>
													<span class="highlight1">Noida
														<span class="dot-separator"></span>India</span>
												</p>
												<p>Mar 2018 – Present
													<span class="dot-separator"></span>
													<span class="highlight1">2 years 2 months</span>
												</p>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Leading Team of Process Excellence experts ( Black Belts / Master Black
													Belts ) associated with different verticals
													of the Organization</li>
												<li>Driving Six Sigma, Lean, ITIL, ISO, Transition</li>
											</ul>
										</div>
										</div>

										<div class="ak-exp-details-editable">
										<div class="exp-details">
											<div class="col1">
												<strong>-</strong>
											</div>
											<div class="col2">
												<strong>Assistant Vice President .
													<span class="highlight1">Operational performance improvement </span>
													<a href="#" class="ak-resumeEdit-icon ak-resumeEditSub-icon"><i class="material-icons">edit</i></a>
												</strong>
												<p>HSBC
													<span class="dot-separator"></span>
													<span class="highlight1">Noida
														<span class="dot-separator"></span>India</span>
												</p>
												<p>Mar 2018 – Present
													<span class="dot-separator"></span>
													<span class="highlight1">2 years 2 months</span>
												</p>
											</div>
										</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Leading Team of Process Excellence experts ( Black Belts / Master Black
													Belts ) associated with different verticals
													of the Organization</li>
												<li>Driving Six Sigma, Lean, ITIL, ISO, Transition</li>
											</ul>
										</div>
									</div>
									<div class="block">
										<h2>Work
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Projects
											<span class="dot-separator" style="position:relative;top:-1px;"></span>Achievements
											<span class="dot-separator" style="position:relative;top:-1px;"></span>highlights
											<a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<div class="col1">
												<strong>2018</strong>
											</div>
											<div class="col2">
												<strong>HSBC
													<span class="dot-separator"></span>Project
													<span class="dot-separator"></span>
													<span class="highlight1">Lean Modem dispatch reduction</span>
												</strong>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>
													<p>Work on improving FCR from 56% to 88% with a stability leading to
														34Mn
														savings.
														<a href="http://wm.dainidev.com/">http://wm.dainidev.com/</a>
													</p>
												</li>
											</ul>
										</div>

										<div class="exp-details">
											<div class="col1">
												<strong>2017</strong>
											</div>
											<div class="col2">
												<strong>Wipro
													<span class="dot-separator"></span>Publication
													<span class="dot-separator"></span>
													<span class="highlight1">Six Sigma CSAT improvement</span>
												</strong>
											</div>
										</div>


										<div class="exp-details">
											<ul class="list">
												<li>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc congue
														efficitur ipsum, ut condimentum dui. Quisque vel
														libero faucibus, sollicitudin quam ut, commodo ligula. Etiam
														sagittis
														scelerisque erat, nec suscipit ligula cursus
														ac. Vestibulum et nunc fringilla, euismod dolor et, pulvinar velit.
														Integer finibus elit leo, in venenatis purus sodales
														id. Fusce a risus non diam tristique scelerisque ac et nunc. Donec
														ut
														libero nulla. Donec rhoncus felis ac elit tincidunt
														lobortis nec id arcu.</p>
												</li>
											</ul>
										</div>

										<div class="exp-details">
											<div class="col1">
												<strong>2017</strong>
											</div>
											<div class="col2">
												<strong>HSBC
													<span class="dot-separator"></span>
													<span class="highlight1">Lean Modem dispatch reduction</span>
												</strong>
												<p>Work on improving FCR from 56% to 88% with a stability leading to 34Mn
													savings.
													<a href="http://wm.dainidev.com/">http://wm.dainidev.com/</a>
												</p>
											</div>
										</div>
										<div class="exp-details">
											<div class="col1">
												<strong>-</strong>
											</div>
											<div class="col2">
												<strong>HSBC
													<span class="dot-separator"></span>
													<span class="highlight1">Lean Modem dispatch reduction</span>
												</strong>
												<p>This tool helps on identifying the method of automation the entire
													process</p>
											</div>
										</div>
										<div class="exp-details">
											<div class="col1">
												<strong>2015</strong>
											</div>
											<div class="col2">
												<strong>Cognizant
													<span class="dot-separator"></span>
													<span class="highlight1">Six sigma vendor rejects reduction</span>
												</strong>
												<p>This tool helps on identifying the method of automation the entire
													process</p>
											</div>
										</div>
									</div>
									<div class="block">
										<h2>Extracurricular activities <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<div class="col1">
												<strong>2013</strong>
											</div>
											<div class="col2">
												<strong>Amity university
													<span class="dot-separator"></span>
													<span class="highlight1">President organizer</span>
												</strong>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Set up to manage students listing down requirements and interests</li>
											</ul>
										</div>
									</div>
									<div class="block">
										<h2>Soft skills <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<p>Conflict management, Influencing ability, Change management, Effective
												presentation
											</p>
										</div>
									</div>
									<div class="block">
										<h2>Interests <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<p>Sky diving, Entrepreneurship funnel, Social events, Driving </p>
										</div>
									</div>
									<div class="block">
										<h2>Awards <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<div class="col1">
												<strong>2013</strong>
											</div>
											<div class="col2">
												<strong>CEO award of quarter
													<span class="dot-separator"></span>
													<span class="highlight1">Cognizant</span>
												</strong>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Set up to manage students listing down requirements and interests</li>
											</ul>
										</div>
									</div>
									<div class="block">
										<h2>Trained on <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<div class="col1">
												<strong>2013</strong>
											</div>
											<div class="col2">
												<strong>Design thinking
													<span class="dot-separator"></span>
													<span class="highlight1">Accenture</span>
												</strong>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Set up to manage students listing down requirements and interests</li>
											</ul>
										</div>
									</div>
									<div class="block">
										<h2>Certifications <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<div class="col1">
												<strong>2013</strong>
											</div>
											<div class="col2">
												<strong>Six Sigma Black Belt
													<span class="dot-separator"></span>
													<span class="highlight1">Indian statistical institute</span>
												</strong>
											</div>
										</div>

										<div class="exp-details">
											<ul class="list">
												<li>Set up to manage students listing down requirements and interests</li>
											</ul>
										</div>
									</div>
									<div class="block">
										<h2>Education <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<div class="col1">
												<strong>2013</strong>
											</div>
											<div class="col2">
												<strong>MBA
													<span class="dot-separator"></span>Marketing
													<span class="dot-separator"></span>
													<span class="highlight1">London school of Business
														<span class="dot-separator"></span>67%</span>
												</strong>
											</div>
										</div>
										<div class="exp-details">
											<div class="col1">
												<strong>2010</strong>
											</div>
											<div class="col2">
												<strong>BE
													<span class="dot-separator"></span>Electrical and electronics
													<span class="dot-separator"></span>
													<span class="highlight1">Thapar University
														<span class="dot-separator"></span>7.86 GPA</span>
												</strong>
											</div>
										</div>
									</div>
									<div class="block">
										<h2>Subjects, Courses <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<p>Antenna
												<span class="highlight1">(A+ grade)</span> , Modular design
												<span class="highlight1">(92%)</span>, Analog</p>
										</div>
									</div>
									<div class="block">
										<h2>Language <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<p>Hindi
												<span class="highlight1">(Speak. Read. Write)</span>, English
												<span class="highlight1">(Speak. Read)</span>, German
												<span class="highlight1">(Speak)</span>
											</p>
										</div>
									</div>
									<div class="block">
										<h2>Additional information / Contact details <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<ul class="list-table">
												<li class="col1">
													<ul>
														<li>Date of birth</li>
														<li>Marital status</li>
														<li>Contact number</li>
														<li>Alternat number</li>
														<li>Email</li>
														<li>Valid passport</li>
														<li>Current location</li>
														<li>References</li>
													</ul>
												</li>
												<li class="col2">
													<ul>
														<li>
															<span class="highlight1">10-Jan-71 (47 years)</span>
														</li>
														<li>
															<span class="highlight1">Married</span>
														</li>
														<li>
															<a href="tel:+98 989987789">+98 989987789</a>
														</li>
														<li>
															<a href="tel:+98 989987789">+98 989987789</a>
														</li>
														<li>
															<a href="emailto:gsdhh@gmail.com">gsdhh@gmail.com</a>
														</li>
														<li>
															<span class="highlight1">Yes</span>
														</li>
														<li>
															<span class="highlight1">Bhopal, India</span>
														</li>
														<li>
															<a href="tel:+98 989987789">+98 989987789</a>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
									<div class="block">
										<h2>Cover Note <a href="#" class="ak-resumeEdit-icon"><i class="material-icons">edit</i></a></h2>
										<div class="exp-details">
											<p>Donec posuere luctus lectus, sit amet scelerisque risus accumsan nec.
												Quisque
												urna
												erat, semper quis eros nec, tempor
												scelerisque nulla. Maecenas gravida tellus dapibus eros imperdiet eleifend.
												Ut
												malesuada dolor ac augue dignissim bibendum.
												Suspendisse iaculis arcu quis feugiat rhoncus. Vestibulum iaculis erat vel
												eros
												placerat, tempus accumsan dui efficitur.
												Nunc eleifend vehicula nisi vel mollis.</p>
										</div>
									</div>
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
