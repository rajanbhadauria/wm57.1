@extends('layouts.app')
@section('content')
<?php $footerNotFixed = 'set'; ?>

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=contactInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=contactInfo');
}
?>
    <section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>{{isset($contact['id'])?'Update':'Add'}} contact details</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"   >
                    <div class="row mb0">
                        <div class="">

<!--<label for="ctrl.foo" ng-class="{ active: ctrl.foo }">Foo title</label>
<input type="text" ng-model="ctrl.foo" class="form-control" id="foo" />-->

                            <form action="{{URL::to('update/contact-save')}}" method="POST" id="contactForm" name="contactForm" >
                            {{ csrf_field() }}
                                <div class="input-field custom-form">
                                    <input id="primaryEmailTxt"
                                           name="primaryEmailTxt"
                                           type="email"
                                           class="validate emailvalidate"
                                           required
                                           disabled="disabled"
                                           style="color: #000;"
                                           value="{{$primaryEmail}}"
                                           >
                                    <input type="hidden" id="primaryEmail" name="primaryEmail" ng-model="primaryEmail" value="{{$primaryEmail}}">
                                    <label  ng-class="{ active: primaryEmailTxt }" for="primaryEmailTxt">Registered Email </label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="altEmail" name="altEmail" type="email" class="validate emailvalidate regemail" ng-model="altEmail" ng-model-options="{ updateOn: 'blur' }" value="{{isset($contact['altEmail'])?$contact['altEmail']:''}}">

                                    <label ng-class="{ active: altEmail }" for="altEmail">Alternate Email</label>
                                </div>
                                <ul class="d-flex mb0 mobile-number-field">
                                        <li class="input-field custom-form country-code">
                                            <select  ng-required='primaryPhone' id="primaryPhoneCode" name="primaryPhoneCode" ng-model="primaryPhoneCode" >
                                                <option value=""  selected>Select</option>
                                                @foreach($countryCodeList as $key =>$countryCode)
                                                    <option value="{{$countryCode}}" {{(isset($contact['primaryPhoneCode']) && $contact['primaryPhoneCode']==$countryCode)?'selected=selected':''}}>{{$countryNameList[$key]}} (+{{$countryCode}})</option>
                                                @endforeach
                                            </select>
                                            <label class="active countrycode" for="primaryPhoneCode">Country code <span>*</span></label>
                                        </li>
                                    <li class="custom-form pr0">
                                        <div class="input-field">
                                            <input id="primaryPhone" name="primaryPhone" value="{{isset($contact['primaryPhone'])?$contact['primaryPhone']:''}}" type="text" class="validate numeric" required
                                                    ng-model="primaryPhone"
                                                    ng-model-options="{ updateOn: 'blur' }"
                                                    ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/"
                                                    maxlength="10"
                                                    >
                                            <label ng-class="{ active: primaryPhone }" for="primaryPhone">Mobile number <span>*</span></label>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="d-flex mb0 mobile-number-field">
                                    <li class="pl0 custom-form country-code">
                                        <div class="input-field">
                                            <select ng-required='altPhone' id="altPhoneCode" name="altPhoneCode" ng-model="altPhoneCode">
                                                <option value="" selected>Select</option>
                                                @foreach($countryCodeList as $key =>$countryCode)
	                                                <option value="{{$countryCode}}" {{(isset($contact['altPhoneCode']) && $contact['altPhoneCode']==$countryCode)?'selected=selected':''}}>{{$countryNameList[$key]}} (+{{$countryCode}})</option>
                                                @endforeach
                                              </select>
                                            <label class="active countrycode" for="altPhoneCode">Country code </label>
                                        </div>
                                    </li>
                                    <li class="pr0 custom-form">
                                        <div class="input-field">
                                            <input id="altPhone" name="altPhone" type="text" value="{{isset($contact['altPhone'])?$contact['altPhone']:''}}" class="validate numeric" ng-model="altPhone" ng-pattern="/^(?:\d{10}|\w+@\w+\.\w{2,3})$/" maxlength="10">
                                            <label ng-class="{ active: altPhone }"  for="altPhone">Alternate number</label>
                                        </div>
                                    </li>
                                </ul>
                                <div class="input-field custom-form mb10">
                                    <select ng-required='altPhone' id="altRelation" name="altRelation" >
                                      <option value="">Choose relation</option>
                                      	@foreach($relationList as $relation)
                                      		<option value="{{$relation}}" {{(isset($contact['altRelation']) && $contact['altRelation']==$relation)?'selected=selected':''}}>{{$relation}}</option>
                                      	@endforeach
                                    </select>
                                    <label class="active">Alternate number belongs to</label>
                                </div>
                                <div class="row">
                                    @if(isset($contact['id']) && $contact['id']!='')
                                    <div class="col s6 pr0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif

                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{isset($contact['id'])?$contact['id']:''}}">
                                        <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save"
                                        />
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


    $(document).ready(function() {
        $('.less-form').on('click',function(){
            $('.cf-hide').hide();
            $(this).hide();
            $('.more-form').show();
        });
        $('.more-form').on('click',function(){
            $('.cf-hide').show();
            $(this).hide();
            $('.less-form').show();
        });

        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Please enter alpha numeric value only.");
        $.validator.setDefaults({
            ignore: [],
            onfocusout: function () { return true; }
        });

        $( "#contactForm" ).validate({
            rules: {
                primaryEmailTxt: {required: true, email:true },
                altEmail: {email:true },
                primaryPhoneCode:{required: true},
                primaryPhone: {required: true, number:true },
                altPhoneCode: {
                    required: function(element){
                        return ($("#altPhone").val()!="" || $("#altRelation").val()!="");
                    }
                },
                altPhone: {
                    required: function(element){
                        return ($("#altPhoneCode").val()!="" || $("#altRelation").val()!="");
                    }
                },
                altRelation: {
                    required: function(element){
                        return ($("#altPhoneCode").val()!="" || $("#altPhone").val()!="");
                    }
                }

            },
            messages: {
                primaryEmailTxt: {
                    required: "Required",
                    email: "Enter valid email"
                },
                altEmail: {
                    email: "Enter valid email"
                },
                primaryPhoneCode: {
                    required: "Required"
                },
                primaryPhone: {
                    required: "Required",
                    number: "Enter valid number."
                },
                altPhoneCode: {
                    required: "Required"
                },
                altPhone: {
                    required: "Required"
                },
                altRelation: {
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
                var formData = $("#contactForm").serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    url:$("#contactForm").attr("action"),
                    data:formData,
                    success: function(response){
                        window.location.href = "{{URL::to('update?sectionid=contactInfo')}}";
                    }
                });
            }
        });



        //$("#remove").hide();
        @if(isset($contact['id']) && $contact['id']!='')
        $("#remove").on("click", function(event){
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/contact/remove')}}/"+$("#id").val(),
                    data:formData,
                    success: function(response){
                        if(response.error == 0){
                            window.location.href = "{{URL::to('update?sectionid=contactInfo')}}";
                        }
                    }
                });

            }
        });
        @endif


        $('#altRelation').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

        $('#altPhoneCode').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

        $('#primaryPhoneCode').on('change', function (e) {
            if(e.target.value.trim()=='' || e.target.value==0){}else{
                if($(this).parents().children('.validationError')){
                    $($(this).parents().children('.validationError')).hide();
                }
            }
        });

    });
</script>


@endsection

