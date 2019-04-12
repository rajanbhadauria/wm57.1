@extends('layouts.app')
@section('content')
<style>
    input[type=color] {
        width: 100%;
    height: 3em;
    text-align: center;
    padding: 0;

}
    }
</style>
<!-- Inner page code -->
<section class="title-bar">
    <div class="container">
        <div class="row mb0">
            <div class="col s12 pr">
                <h1>Resume theme</h1>
            </div>
        </div>
    </div>
  </section>
  <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="ak-custom-center-box">
              <div class="row m-0 form-wrapper">
              <form action="{{url('resume/styles')}}" method="POST" id="styleForm">
                {{ csrf_field() }}
                <div class="">
                <div class="ak-selecBtnChkboxGrp ak-resumeTheme">
                  <span class="ak-fontSize">Font type</span>
                </div>
                <ul class="reset-list-style mb-30">
                    <li class="option-list secondary-card">
                      <div class="option-list__text">Default</div>
                      <div class="option-list__select">
                          <input {{($style && $style->font_family == "'Roboto', sans-serif") ? 'checked' : 'checked'}} value="'Roboto', sans-serif" class="with-gap numeric" name="font_family" id="ft-options1" type="radio"/>
                          <label for="ft-options1"></label>
                      </div>
                    </li>
                    <li class="option-list secondary-card">
                      <div class="option-list__text" style="font-family:Arial, Helvetica, sans-serif">Arial, Helvetica, sans-serif</div>
                      <div class="option-list__select">
                          <input {{($style && $style->font_family == 'Arial, Helvetica, sans-serif') ? 'checked' : ''}} value="Arial, Helvetica, sans-serif" class="with-gap numeric" name="font_family" id="ft-options2" type="radio"/>
                          <label for="ft-options2"></label>
                      </div>
                    </li>
                    <li class="option-list secondary-card">
                      <div class="option-list__text" style="font-family:'Times New Roman', Times, serif">'Times New Roman', Times, serif</div>
                      <div class="option-list__select">
                          <input {{($style && $style->font_family == "'Times New Roman', Times, serif") ? 'checked' : ''}} value="'Times New Roman', Times, serif" class="with-gap numeric" name="font_family" id="ft-options3" type="radio"/>
                          <label for="ft-options3"></label>
                      </div>
                    </li>
                    <li class="option-list secondary-card">
                      <div class="option-list__text" style="font-family:Verdana, Geneva, Tahoma, sans-serif">Verdana, Geneva, Tahoma, sans-serif</div>
                      <div class="option-list__select">
                          <input {{($style && $style->font_family == 'Verdana, Geneva, Tahoma, sans-serif') ? 'checked' : ''}} value="Verdana, Geneva, Tahoma, sans-serif" class="with-gap numeric" name="font_family" id="ft-options4" type="radio"/>
                          <label for="ft-options4"></label>
                      </div>
                    </li>
                </ul>



                <div class="ak-selecBtnChkboxGrp ak-resumeTheme">
                  <span class="ak-fontSize">Font title color</span>
                </div>
                <ul class="reset-list-style mb-30">
                    <li class="option-list secondary-card">
                      <div class="option-list__text">Default</div>
                      <div class="option-list__select">
                          <input class="with-gap numeric" {{($style && $style->font_heading_color == 'black') ? 'checked' : 'checked'}} value="black" name="font_heading_color" id="fc-options1" type="radio"/>
                          <label for="fc-options1"></label>
                      </div>
                    </li>
                    <li class="option-list secondary-card">
                      <div class="option-list__text blue-text">Blue</div>
                      <div class="option-list__select">
                          <input class="with-gap numeric" {{($style && $style->font_heading_color == 'blue') ? 'checked' : ''}} value="blue" name="font_heading_color" id="fc-options2" type="radio"/>
                          <label for="fc-options2"></label>
                      </div>
                    </li>
                    <li class="option-list secondary-card">
                      <div class="option-list__text purple-text">Purple</div>
                      <div class="option-list__select">
                          <input class="with-gap numeric" {{($style && $style->font_heading_color == 'purple') ? 'checked' : ''}} value="purple" name="font_heading_color" id="fc-options3" type="radio"/>
                          <label for="fc-options3"></label>
                      </div>
                    </li>
                    <li class="option-list secondary-card">
                        <div class="option-list__text indigo-text">Indigo</div>
                        <div class="option-list__select">
                            <input class="with-gap numeric" {{($style && $style->font_heading_color == 'indigo') ? 'checked' : ''}} value="indigo" name="font_heading_color" id="fc-options4" type="radio"/>
                            <label for="fc-options4"></label>
                        </div>
                      </li>
                      <li class="option-list secondary-card">
                        <div class="option-list__text green-text">Green</div>
                        <div class="option-list__select">
                            <input class="with-gap numeric" {{($style && $style->font_heading_color == 'green') ? 'checked' : ''}} value="green" name="font_heading_color" id="fc-options5" type="radio"/>
                            <label for="fc-options5"></label>
                        </div>
                      </li>
                </ul>
                  <div class="container-card">
                    <div class="row">
                      <div class="col s6 pl0" id="skip">
                          <a href="#delete-acct-alert" class="modal-trigger waves-effect waves-light btn-black display-block">Cancel</a>
                      </div>
                      <div class="col s6 pr0 custom-submit">
                          <input type="submit" class="waves-effect waves-light btn-blue input-btn display-block" value="Save" />
                      </div>
                    </div>
                  </div>


                </div>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    $(document).ready(function(){
    $( "#styleForm" ).validate({
            ignore: [],
            rules: {
                font_family: {required: true },
                font_heading_color: {required:true},
            },
            messages: {
                font_family: {
                    required: "Required"
                },
                font_heading_color: {
                    required: "Required",
                    email: "Enter vaild email"
                },
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
                $.ajax({
                type:"POST",
               	dataType: "JSON",
                url:$("#styleForm").attr("action"),
                data:$("#styleForm").serialize(),
                beforeSend: function(){$("#loading").show();},
                success: function(response){
                    var redirectFlag = 1;
                    $("#loading").hide();
                    if(response.error == 1){
                    	$.notify({ content:response.error_msg, timeout:3000});
                    } else {
                       window.location.href = "{{url('/resume/view')}}";
                    }
                },
                error: function(response) {
                    $("#loading").hide();
                }
            });
            }
        });
    });
    </script>

    @endsection
