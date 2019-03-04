@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
	if($redirectBack == "view"){
		$redirectBack = URL::to('resume/view?sectionid=travelInfo');
	}
} else {
	$redirectBack = URL::to('update?sectionid=travelInfo');
}
?>

<section class="title-bar">
		<div class="container">
			<div class="row mb0">
				<div class="col s12 pr">
					<h1>{{isset($travel['id'])?'Update':'Add'}} Publications / Research / Patent etc</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="section wrappit" ng-app="TravelFromApp" ng-controller="myCtrl">
	  <div class="container">
		<div class="center-wrapper" id="heightSet" >
		  <div class="center-container">
			<div class="big-center-box">
				<div class="inner-half-container" id="loginDiv"  >
					<div class="row">
						<div class="">
							<form action="{{URL::to('update/travel-save')}}" method="POST" id="travelForm" name="travelForm" >
                                <div class="clearfix">&nbsp;</div>
                                <div class="input-field custom-form">
                                    <select id="work_category" name="work_category" required data-msg="Required">
                                        <option value="">Select</option>
                                        @if($work_categories > 0)
                                            @foreach($work_categories as $work_category)
                                    <option value="{{$work_category['id']}}"{{isset($travel['work_category']) && $travel['work_category'] == $work_category['id']?'selected':''}} >
                                        {{$work_category['title']}}
                                    </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="work_category" class="active">Other activities <span>*</span></label>
                                </div>
								<div class="input-field custom-form">
									<input id="project" name="project" type="text" class="validate" value="{{isset($travel['project'])?$travel['project']:''}}" required
									>
									<label for="project" id="project_label" ng-class="{ active:  project }">Publications / Research / Patent etc name <span>*</span></label>
                                </div>

                                <div class="input-field custom-form">
                                        <input id="url" name="url" type="text" class="fourlength validate" value="{{isset($travel['url'])?$travel['url']:''}}">
                                        <label for="url" id="url" ng-class="{ active:  url }">Url</label>
                                </div>

								<div class="input-field custom-form">
									<textarea id="projectDesc" name="projectDesc" class="mb25"
										ng-model="projectDesc"
									>{{isset($travel['projectDesc'])?$travel['projectDesc']:''}}</textarea>
									<label for="projectDesc" ng-class="{ active:  projectDesc }">Details</label>
								</div>
								<div class="input-field custom-form">
									<input id="company" name="company" type="text" class="validate" value="{{isset($travel['company'])?$travel['company']:''}}"

										ng-model="company"
									>
									<label for="company" ng-class="{ active:  company }">College / Insititute /
                                        Company name</label>
								</div>

								<div class="input-field custom-form">
									<span class="form-label custm-lbl">Start date </span>
								</div>

								<ul class="d-flex mb0">
									<li class="custom-form dt-drpdwn mr10">
										<div class="input-field">
											<select id="ddStart" name="ddStart"
												ng-model="ddStart"
											>
												<option value="" selected>DD</option>
												@foreach($dd as $d)
													<option value="{{$d}}" {{(isset($travel['ddStart']) && $travel['ddStart']==$d)?'selected=selected':''}}>{{$d}}</option>
												@endforeach
											  </select>
											<label class="active" for="ddStart">DD</label>
										</div>
									</li>
									<li class="custom-form dt-drpdwn mr10">
										<div class="input-field">
											<select id="mmStart" name="mmStart"
												ng-model="mmStart"
											>
												<option value="" selected>MM</option>
												@foreach($mm as $m)
													<option value="{{$m}}" {{(isset($travel['mmStart']) && $travel['mmStart']==$m)?'selected=selected':''}}>{{$m}}</option>
												@endforeach
											</select>
											<label class="active" for="mmStart">MM</label>
										</div>
									</li>
									<li class="custom-form dt-drpdwn">
										<div class="input-field">
											<select id="yyyyStart" name="yyyyStart">
												<option value="" selected>YYYY</option>
												<?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
													<option value="{{$i}}" {{(isset($travel['yyyyStart']) && $travel['yyyyStart']==$i)?'selected=selected':''}}>{{$i}}</option>
												<?php } ?>
											</select>
											<label class="active" for="yyyyStart">YYYY</label>
										</div>
									</li>
								</ul>

								<div class="input-field custom-form">
									<span class="form-label custm-lbl">End date </span>
								</div>

								<ul class="d-flex mb0">
									<li class="custom-form dt-drpdwn mr10">
										<div class="input-field">
											<select id="ddEnd" name="ddEnd"
												ng-model="ddEnd"
											>
												<option value="" selected>DD</option>
												@foreach($dd as $d)
													<option value="{{$d}}" {{(isset($travel['ddEnd']) && $travel['ddEnd']==$d)?'selected=selected':''}}>{{$d}}</option>
												@endforeach
											  </select>
											<label class="active" for="ddEnd">DD</label>
										</div>
									</li>
									<li class="custom-form dt-drpdwn mr10">
										<div class="input-field">
											<select id="mmEnd" name="mmEnd"

											>
												<option value="" selected>MM</option>
												@foreach($mm as $m)
													<option value="{{$m}}" {{(isset($travel['mmEnd']) && $travel['mmEnd']==$m)?'selected=selected':''}}>{{$m}}</option>
												@endforeach
											</select>
											<label class="active" for="mmEnd">MM</label>
										</div>
									</li>
									<li class="custom-form dt-drpdwn">
										<div class="input-field">
											<select id="yyyyEnd" name="yyyyEnd" required data-msg="Required">
												<option value="" selected>YYYY</option>
												<?php for($i=$maxYYYY; $i>= $minYYYY;$i--) { ?>
													<option value="{{$i}}" {{(isset($travel['yyyyEnd']) && $travel['yyyyEnd']==$i)?'selected=selected':''}}>{{$i}}</option>
												<?php } ?>
											</select>
											<label class="active" for="yyyyEnd">YYYY <span>*</span></label>
										</div>
									</li>
								</ul>



								<div class="input-field custom-form">
									<input id="city" name="city" type="text" class="alpha fourlength" value="{{isset($travel['city'])?$travel['city']:''}}"
										ng-model="city"
									>
									<label for="city" ng-class="{ active:  city }">City</label>
								</div>

								<div class="input-field custom-form">
									<input id="country" name="country" type="text" class="alpha fourlength" value="{{isset($travel['country'])?$travel['country']:''}}"
										ng-model="country"
									>
									<label for="country" ng-class="{ active:  country }">Country </label>
								</div>
                                <div class=" custom-form mb20 custm-lbl">
                                        <div class="display-inline">
                                            <input class="with-gap" name="best" type="checkbox" id="best" value="1"
                                                {{(isset($travel['best']) && $travel['best']=='1')?'checked=checked':''}} />
                                            <label for="best">Highlight above as Key achievement</label>
                                        </div>
                                    </div>
								<div class="row">
                                    @if(isset($travel['id']) && $travel['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif
									<div class="col s6 pr0 custom-submit">
										<input type="hidden" name="id" id="id" value="{{isset($travel['id'])?$travel['id']:'0'}}">
										<input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save" />
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
<script>

updateLabel = function(){
    var label = $.trim($('#work_category option:selected').text());
    if(label != "" && label != "Select") {
      $("#project_label").html(label+" name");
    } else {
        $("#project_label").html('Publications / Research / Patent etc');
    }
}
$(document).ready(function() {
    updateLabel();
    $('#work_category').on('change' ,function(){
        updateLabel();
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
    }, "Please enter alpha numeric value only.");
    $.validator.setDefaults({
        ignore: [],
        onfocusout: function () { return true; }
    });

    $( "#travelForm" ).validate({
        rules: {
            project: {required: true},
            company: {required:true}
        },
        messages: {
            project: {
                required: "Required"
            },
            company: {
                required: "Required"
            },
            url: {
                url: "Enter vaild url"
            }
        },
        errorClass: 'validationError',
        errorElement : 'span',
        //errorLabelContainer: '.validationError',
        errorPlacement: function( error, element ) {
            error.insertAfter( element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents("span").addClass(errorClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents("span").removeClass(errorClass);
        },
        submitHandler: function(form) {
            var formData = $("#travelForm").serializeArray();
            formData.push({ name: "_token", value: "{{ csrf_token()}}" });
            $.ajax({
                type:"POST",
                url:$("#travelForm").attr("action"),
                data:formData,
                success: function(response){
                    window.location.href = "{{url($returnUrl)}}";
                }
            });
        }
    });



        @if(isset($travel['id']) && $travel['id']!='')

		$("#remove").on("click", function(event){
			var r = confirm("Are you sure you want to delete!");
			if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
				$.ajax({
					type:"POST",
					dataType : "JSON",
					url:"{{URL::to('update/travel/remove')}}/"+$("#id").val(),
					data:formData,
					success: function(response){
						if(response.error == 0){
							window.location.href = "{{url($returnUrl)}}";
						}
					}
				});

			}
		});
		@endif
		$("#best").on("click", function(){
			if($(this).is(":checked")){
				$(this).val("1");
			} else {
				$(this).val("0");
			}
		});

        $('#ddEnd').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#mmEnd').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#yyyyEnd').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

        $('#ddStart').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#mmStart').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });
        $('#yyyyStart').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

	});
</script>

<script>
var app = angular.module('TravelFromApp', []);

function getTravelDetails(){
	app.controller('myCtrl', function($scope, $http) {
		$http.post("{{URL::to('update/get-travel-details')}}",{'id':'{{$id}}' })
		.then(function(response) {
			if(response.data.error == false){
				$('#id').val(response.data.travel.id);
				$scope.project = response.data.travel.project;

				$scope.projectDesc = response.data.travel.projectDesc;
				$scope.company = response.data.travel.company;



				$scope.city = response.data.travel.city;
				$scope.country = response.data.travel.country;



				$('#ddStart').find('option[value="'+response.data.travel.ddStart+'"]').prop('selected', true);
				$("#ddStart").material_select();
				$scope.ddStart = response.data.travel.ddStart;

				$('#mmStart').find('option[value="'+response.data.travel.mmStart+'"]').prop('selected', true);
				$("#mmStart").material_select();
				$scope.mmStart = response.data.travel.mmStart;

				$('#yyyyStart').find('option[value="'+response.data.travel.yyyyStart+'"]').prop('selected', true);
				$("#yyyyStart").material_select();
				$scope.yyyyStart = response.data.travel.yyyyStart;

				$('#ddEnd').find('option[value="'+response.data.travel.ddEnd+'"]').prop('selected', true);
				$("#ddEnd").material_select();
				$scope.ddEnd = response.data.travel.ddEnd;

				$('#mmEnd').find('option[value="'+response.data.travel.mmEnd+'"]').prop('selected', true);
				$("#mmEnd").material_select();
				$scope.mmEnd = response.data.travel.mmEnd;

				$('#yyyyEnd').find('option[value="'+response.data.travel.yyyyEnd+'"]').prop('selected', true);
				$("#yyyyEnd").material_select();
				$scope.yyyyEnd = response.data.travel.yyyyEnd;

				if(response.data.travel.best == "1"){
					$("#best").val("1");
					$("#best").prop('checked', true);
				}

				$("#cancel").hide();
				$("#remove").show();

			}
			//console.log(response)
		});
	});
}

getTravelDetails();
</script>


@endsection
