@extends('layouts.app')
@section('content')

<?php
if(isset($_GET['covernote'])) {
    $covernote = $_GET['covernote'];
} else {
    $covernote = '';
}
?>


	<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Send Resume</h1>
                    <a href="settings.php" class="waves-effect settings-menu-icon">
                        <i class="material-icons">settings</i>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <div class="section wrappit" ng-app="sandSaveFormApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row">
                        <div class="col s12">
                            <form action="{{URL::to('resume/send-save')}}" method="POST" id="sendSaveForm" name="sendSaveForm" novalidate>
                                <div>
                                    <ul class="collection left-align">
                                        <li class="collection-item avatar collection-item-hover-active">
                                        @if(Auth::user()->avatar != "")
                            		    	@if(strpos(Auth::user()->avatar,"ttp:"))
                            		    	    <img alt="" src="{{Auth::user()->avatar}}" alt="" class="circle">
                            		    	@else
                            		    	    <img alt="" src="/uploads/images/user/{{Auth::user()->avatar}}" alt="" class="circle">
                            		    	@endif
                            			@else
                            			    <img alt="" src="/uploads/images/user/user-img-white.jpg" alt="" class="circle">
                            			@endif
                                  		<div class="title">{{$profileData->first_name}} {{$profileData->last_name}}</div>
                                  		@if($currentWorkCount>0)
                                  			<div class="deg">{{$currentWorkInfo->company}}, {{$currentWorkInfo->designation}}</div>
                                  		@else
                                  		@endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="input-field">
                      			    <input id="subject" name="subject" type="text" class="validate" required="" value="" placeholder="Job request" ng-model="subject">
                      			    <span class="validationError" ng-show="sendSaveForm.subject.$dirty && sendSaveForm.subject.$invalid">
                      			    		<span ng-show="sendSaveForm.subject.$error.required">Required</span>
                      			    </span>
                      			    <label class="active" for="subject">Subject</label>
                      			</div>
                      			<div class="input-field">
                      			    <input id="email" name="email" type="email" class="validate emailvalidate" required="" value="" placeholder="example@company.com" ng-model="email">
                      			    <span class="validationError" ng-show="sendSaveForm.email.$dirty && sendSaveForm.email.$invalid">
                      			    		<span ng-show="sendSaveForm.email.$error.required">Required</span>
                      			    		<span ng-show="sendSaveForm.email.$error.email">invalid email address</span>
                      			    </span>
                      			    <label class="active" for="email">To</label>
                      			</div>

                                <?php if ($covernote == '1') { ?>
                                    <div class="display-inline left-align w100p">
                                        <input class="with-gap <?php if ($covernote === '1') {
                                    echo 'active';
                                } ?>"  name="Covernote" type="checkbox" id="covernote" checked="" />
                                        <label for="covernote">Cover note</label>
                                    </div>
                                    <div id="covernoteText" class="input-field mb20 core-deposit-hide">
                                        <p>I am writing to apply for the...<a href="covernote.php">View full</a>  </p>
                                    </div>

                                    <?php } else { ?>
                                    <div class="display-inline left-align w100p">
                                        <input class="with-gap" name="Covernote" type="checkbox" id="covernote" />
                                        <label for="covernote">Cover note</label>
                                    </div>

                                    <?php } ?>
                                <div class="row">
                                    <div class="col s6 pl0 custom-submit">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save" ng-disabled="sendSaveForm.$invalid" />
                                    </div>
                                    <div class="col s6 pr0">
                                        <a href="{{URL::to('update')}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
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


	<div id="success" class="overflow-message valign-wrapper">
		    <div class="messaage-center-box">
		        <div class="mc-icon">
		            <i class="large material-icons">check_circle</i>
		        </div>
		        <p class="success-message">Your resume has been successfully sent to <span ng-bind="email"></span></p>
		        <a href="{{URL::to('resume/view')}}" class="resumeLinkBtn waves-effect waves-light btn-white display-block">OK</a>
		    </div>
		</div>

		 <div id="fail" class="overflow-message valign-wrapper">
		     <div class="messaage-center-box">
		         <div class="mc-icon">
		             <i class="large material-icons">check_circle</i>
		         </div>
		         <p class="success-message">No user exist with this email, an invititation mail sent to <span ng-bind="email"></span></p>
		         <a href="{{URL::to('resume/view')}}" class="resumeLinkBtn waves-effect waves-light btn-white display-block">OK</a>
		     </div>
		 </div>
    </div>

<script>

	var app = angular.module('sandSaveFormApp', []);
   	app.controller('myCtrl', function($scope) {});

    $(document).ready(function(){

        $("#sendSaveForm").submit(function( event ) {
            event.preventDefault();
            $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:$(this).attr("action"),
                data:$(this).serialize(),
                success: function(response){
                    console.log(response.error);
                    if(response.error == 1){
                    	$('#fail').css({'visibility': 'visible'});
                      $('resumeLinkBtn').attr('href',)
                    } else {
                    	$('#success').css({'visibility': 'visible'});
                      $('.resumeLinkBtn').attr('href',"{{URL::to('resume')}}/"+response.resumeId);
                    }

                }
            });
        });







    });
</script>

<script>
    $(document).ready(function(){

        $('#covernote').on('click', function(){
           if($(this).prop('checked')){
               if(!$(this).hasClass('active')){
                   window.location.href = '/html/covernote.php';
               }else{
                    $('#covernoteText').show();
               }

           }else{
               $('#covernoteText').hide();
           }
       });
    });
</script>



@endsection
