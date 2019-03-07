@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back
//print_r($countryCodeList);
if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=referenceInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=referenceInfo');
}
?>

    <section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>{{isset($reference['id'])?'Update':'Add'}} reference</h1>
                    <ul class="panel-actions resumebox-actions pull-right">
                        <li>
                            <a href="{{url('/update')}}" class="text-primary"><i class="tiny material-icons">edit</i></a>
                        </li>
                        <li><a href="{{url('resume/view')}}" class="text-primary"><i class="small-text material-icons">picture_in_picture</i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row">
                        <div class="">
                            <form action="{{URL::to('update/reference-save')}}" method="POST" id="referenceForm" name="referenceForm" >

                                <div class="input-field custom-form">
                                    <input id="reference" name="reference" type="text" class="alphanumeric fourlength validate" value="{{isset($reference['reference'])?$reference['reference']:''}}"
                                        required
                                    >

                                    <label for="reference" ng-class="{ active:  reference }">Name <span>*</span></label>
                                </div>
                                <div class="input-field custom-form">
                                    <input id="school" name="school" type="text" class="alphanumeric tenlength" value="{{isset($reference['school'])?$reference['school']:''}}" ng-model="school">
                                    <label for="school" ng-class="{ active:  school }" >College / University / Company  <span>*</span></label>
                                </div>


                                <div class="input-field custom-form">
                                    <input id="role" name="role" type="text" class="alphanumeric sixlength" value="{{isset($reference['role'])?$reference['role']:''}}"

                                        ng-model="role"
                                    >
                                    <label for="role" ng-class="{ active:  role }">Functional role / Designation</label>
                                </div>

                                <div class="input-field custom-form">
                                    <input id="remarks" name="remarks" type="text" class="" value="{{isset($reference['remarks'])?$reference['remarks']:''}}"
                                        ng-model="remarks"
                                    >
                                    <label for="remarks" ng-class="{ active:  remarks }">Remarks </label>
                                </div>


                                <ul class="d-flex mb0 mobile-number-field">
                                    <li class="input-field custom-form country-code">
                                        <div class="input-field">
                                            <select  id="phoneCode" name="phoneCode" ng-model="phoneCode">
                                                <option value="" selected>Select</option>
                                                @foreach($countryCodeList as $key =>$countryCode)
                                                    <option value="{{$countryCode}}" {{(isset($reference['phoneCode']) && $reference['phoneCode']==$countryCode)?'selected=selected':''}}>{{$countryCodeList[$key]}} (+{{$countryCode}})</option>
                                                @endforeach
                                              </select>
                                            <label class="active" for="phoneCode">Country code </label>
                                        </div>
                                    </li>
                                    <li class="custom-form pr0">
                                        <div class="input-field">
                                            <input id="phone" name="phone" type="text" value="{{isset($reference['phone'])?$reference['phone']:''}}" class="validate numeric" ng-model="phone" maxlength="12" >
                                            <label ng-class="{ active: phone }"  for="phone">Contact Number</label>
                                        </div>
                                    </li>
                                </ul>


                                <div class="input-field custom-form">
                                    <input id="email" name="email" type="text" class="emailvalidate" value="{{isset($reference['email'])?$reference['email']:''}}"
                                        required
                                        ng-model="email"
                                    >

                                    <label for="email" ng-class="{ active:  email }">Contact Email <span>*</span></label>
                                </div>

                                <div class="row">
                                    @if(isset($reference['id']) && $reference['id']!='')
                                    <div class="col s6 pl0" id="remove">
                                        <a href="javascript:void(0);" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>
                                    @else
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>
                                    @endif
                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="{{isset($reference['id'])?$reference['id']:''}}">
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
    $(document).ready(function() {
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Please enter alpha numeric value only.");
        $.validator.setDefaults({
            ignore: [],
            onfocusout: function () { return true; }
        });

        $( "#referenceForm" ).validate({
            rules: {
                reference: {required: true},
                email: {required: true,email:true },
                school: {required: true},
            },
            messages: {
                reference: {
                    required: "Required"
                },
                email: {
                    required: "Required",
                    email: "Enter valid email."
                },
                school: {
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
                var formData = $("#referenceForm").serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    url:$("#referenceForm").attr("action"),
                    data:formData,
                    success: function(response){
                        console.log(response);
                        window.location.href = "{{url($returnUrl)}}";
                    }
                });
            }
        });


        @if(isset($reference['id']) && $reference['id']!='')
        $("#remove").on("click", function(event){
            var r = confirm("Are you sure you want to delete!");
            var formData = $(this).serializeArray();
            formData.push({ name: "_token", value: "{{ csrf_token()}}" });
            if (r == true) {
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/reference/remove')}}/"+$("#id").val(),
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
    });

</script>
@endsection
