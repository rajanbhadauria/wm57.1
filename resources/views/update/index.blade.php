@extends('layouts.app')
@section('content')
<?php
if(isset($sectionid)) {
    $sectionid = $sectionid;
} else {
    $sectionid = '';
}
?>


    <section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Resume update</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box" id="loginDiv"  >
                <div class="inner-half-container">
                    <div class="row">
                        <div class="">

                            <ul class="collapsible no-shadow" data-collapsible="accordion">
                            <!-- Profile Image -->@include("update.profileImage.profileImage")
                            <!-- Resume Title and Cover Note -->    @include("update.resume.resumetitle")
                            <!-- Professional Summary -->    @include("update.objective.objective")
                            <!-- functional domain skills --> @include("update.skill.skill")
                            <!-- Work Exprience --> @include("update.work.work")
                            <!-- Key Assignment and Projects --> @include("update.project.project")
                            <!-- Cerification and Trainings --> @include("update.certification.certification")
                            <!-- Trainings attended -->@include("update.training.training")
                            <!-- Publications, Research, Patent etc details-->@include("update.travel.travel")
                            <!-- Subject and coursed --> @include("update.course.course")
                            <!-- Education Details --> @include("update.education.education")
                            <!-- Awards and honors --> @include("update.award.award")
                            <!-- Personal Management Skills --> @include("update.skill.skill_soft")
                            <!-- Languages -->@include("update.language.language")
                            <!-- Interests --> @include("update.interests.interests")
                            <!-- References -->    @include("update.reference.reference")
                            <!-- User Basic Info -->     @include("update.basic_information.basicinfo")
                            <!-- contact details --> @include("update.contact.contact")
                            <!-- Current address --> @include("update.address.current-address")
                            <!-- Permanent address -->@include("update.address.permanent-address")

                            </ul>


                        </div>

                    </div>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>

<script>

function PPCheck(section, value, id=0){
    $.ajax({
        url: "{{ URL::to('update/pp-check') }}",
        type: 'POST',
        dataType: 'html',
        data: {
            "section" : section,
            "value" : value,
            "_token": "{{ csrf_token()}}",
            "id" : id

        },
        beforeSend: function(){

        },
        success: function(data){


        },
    });
}

    $(document).ready(function(){
        var sectionid = '<?php echo $sectionid; ?>';
        setTimeout(function(){
            if(sectionid){
                $('html, body').animate({
                    scrollTop: $("#"+sectionid).offset().top - 50
                }, 2000);
                $("#"+sectionid).trigger('click');
            }
        }, 1000);

        $(".PPCheck").on("click", function(){
            var section = $(this).attr("data-id");
            var value = $(this).prop("checked");
            var id = $(this).attr("data-value");
            PPCheck(section,value, id);
        })

        $(".shareCheckbox").on("click", function(){
            if($(this).is(":checked")){
                $(this).val("1");
            } else {
                $(this).val("0");
            }

            $(".shareCheckbox").each(function(){
                shareData[$(this).attr('id')] = $(this).val();
            });

            var url = $(this).attr("href");

            $.ajax({
                type:"POST",
                url:"{{URL::to('resume/save-share-data')}}",
                data:{ "shareData":shareData, "_token": "{{ csrf_token()}}" } ,
                success: function(response){
                    //window.location.href = url;

                }
            });
        });

        var shareData = {};
        $(".view-resume").on("click", function(event ) {
            event.preventDefault();
            $(".shareCheckbox").each(function(){
                shareData[$(this).attr('id')] = $(this).val();
            });

            var url = $(this).attr("href");
            console.log(shareData);

            $.ajax({
                type:"POST",
                url:"{{URL::to('resume/save-share-data')}}",
                data:{ "shareData":shareData } ,
                success: function(response){
                    window.location.href = url;

                }
            });

        });

    });


</script>

@endsection

