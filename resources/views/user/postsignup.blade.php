@extends('layouts.app')
@section('content')
<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>Basic user information</h1>
            </div>
        </div>
    </div>
</section>
<section class="section wrappit">
	<div class="container">
		<div class="center-wrapper" id="heightSet">
			<div class="center-container">
				<div class="big-center-box">
					<div class="inner-half-container p-0" id="loginDiv">
						<div class="row form-wrapper">
							<div class="">
                            <form class="m-0" action="{{url('/postsignup/save')}}" id="basicInfoFrom" method="POST">
                                {{ csrf_field() }}
                                <ul class="reset-list-style">
										<li class="input-field custom-form">
                                        <input id="first-name" name="first_name" type="text" class=" " value="{{@$basic_info->first_name}}"  required>
		                                    <label for="first-name">First name <span>*</span> </label>
										</li>
										<li class="input-field custom-form">
		                                    <input id="middle-name" name="middle_name" type="text" class=" " value="{{@$basic_info->middle_name}}">
		                                    <label for="middle-name">Middle name</label>
										</li>
										<li class="input-field custom-form">
		                                    <input id="last-name" name="last_name" type="text" class=" " value="{{@$basic_info->last_name}}"  required>
		                                    <label for="last-name">Last name <span>*</span> </label>
										</li>

										<li class="input-field custom-form">
											<label class="active">Marital status</label>
	                                        <div class="input-field">
	                                            <select id="marital_status" name="marital_status" required>
	                                            	<option value="" selected>Marital status</option>
	                                                <option value="Single" {{@$basic_info->marital_status == 'Single' ? 'Selected' : ''}}> Single</option>
	                                                <option value="Married" {{@$basic_info->marital_status == 'Married' ? 'Selected' : ''}}>Married</option>
	                                                <option value="Widowed" {{@$basic_info->marital_status == 'Widowed' ? 'Selected' : ''}}>Widowed</option>
	                                                <option value="Divorced" {{@$basic_info->marital_status == 'Divorced' ? 'Selected' : ''}}>Divorced</option>
	                                                <option value="Other" {{@$basic_info->marital_status == 'Other' ? 'Selected' : ''}}>Other</option>
	                                            </select>
	                                        </div>
										</li>
										<li class="input-field custom-form row">
		                                    <div class="col s4 pl0 pr0">
		                                        <div class="input-field">
		                                            <select id="ddStart" name="ddStart" required>
                                                        <option value="" selected>DD</option>
                                                        @for($i = 1; $i<=31; $i++)
                                                    <option value="{{$i<10 ? '0'.$i : $i}}" {{@$basic_info->ddStart == $i ? 'Selected' : ''}}>{{$i<10 ? '0'.$i : $i}}</option>
                                                        @endfor
		                                              </select>
		                                              <label class="active dob">Date of birth</label>
		                                        </div>
		                                    </div>
		                                    <div class="col s4 pr0">
		                                        <div class="input-field">
		                                            <select id="mmStart" name="mmStart" required>
                                                        <option value="" selected>MM</option>
                                                        @for($i = 1; $i<=12; $i++)
		                                                <option value="{{$i<10 ? '0'.$i : $i}}" {{@$basic_info->mmStart == $i ? 'Selected' : ''}}>{{$i<10 ? '0'.$i : $i}}</option>
                                                        @endfor
		                                            </select>
		                                        </div>
		                                    </div>
		                                    <div class="col s4 pr0">
		                                        <div class="input-field">
		                                            <select id="yyyyStart" name="yyyyStart" required>
                                                        <option value="" selected>YYYY</option>
                                                        @for($i = date('Y')-20; $i>=date('Y')-60; $i--)
		                                                <option value="{{$i}}" {{@$basic_info->yyyyStart == $i ? 'Selected' : ''}}>{{$i}}</option>
		                                                @endfor
		                                            </select>
		                                        </div>
		                                    </div>
										</li>
										<li class="custom-form cf-hide gender-field mb25">
										<div class="input-field">
											<label for="gender" class="active block-label">Gender</label>
                                        </div>
		                                    <div class="display-inline">
		                                        <input class="with-gap" value="Male" name="gender" type="radio" id="gender-male" checked>
		                                        <label for="gender-male">Male</label>
		                                    </div>
		                                    <div class="display-inline">
		                                        <input class="with-gap" value="Female" name="gender" type="radio" id="gender-female" {{@$basic_info->gender == 'Female' ? 'checked' : ''}}>
		                                        <label for="gender-female">Female</label>
		                                    </div>
										</li>
									</ul>
									<div class="row">
										<div class="col s6 pl0" id="skip">
                                        <a href="{{$return_url}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    	</div>
										<div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{@$basic_info->id}}">
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
</section>
<script>
$(document).ready(function(){
    $( "#basicInfoFrom" ).validate({
            rules: {
                first_name: {required: true },
                last_name: {required:true },
                martial_status:{required: true},
                ddStart: {
                    required: function (element) {
                        console.log($("#ddStart").val());
                        return ($("#ddStart").val() == "");
                    },
                    //number:true
                },
                mmStart: {
                            required: function (element) {
                                return ($("#mmStart").val() == "");
                            },
                            number:true
                        },
                yyyyStart: {
                    required: function (element) {
                        return ($("#yyyyStart").val() == "");
                    },
                    number:true
                    },
                gender: {required: true }

            },
            messages: {
                first_name: {
                    required: "Required",
                },
                last_name: {
                    required: "Enter valid email"
                },
                martial_status: {
                    required: "Required"
                },
                ddStart: {
                    required: "Required",
                    number: "Enter valid number"
                },
                mmStart: {
                    required: "Required",
                    number: "Enter valid number"
                },
                yyyyStart: {
                    required: "Required",
                    number: "Enter valid number"
                },
                gender: {
                    required: "Required"
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
                var formData = $("#basicInfoFrom").serializeArray();
                $.ajax({
                    type:"POST",
                    url:$("#basicInfoFrom").attr("action"),
                    data:formData,
                    success: function(response){
                               window.location.href = "{{$return_url}}";

                    }
                });
            }
        });
});
</script>
@endsection

