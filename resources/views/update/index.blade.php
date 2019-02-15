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
                                @include("update.contact.contact")
                                @include("update.profileImage.profileImage")
                                @include("update.objective.objective")
                                @include("update.work.work")
                                @include("update.education.education")
                                @include("update.project.project")
                                @include("update.skill.skill")
                                @include("update.certification.certification")
                                @include("update.training.training")
                                @include("update.course.course")
                                @include("update.travel.travel")
                                @include("update.award.award")
                                @include("update.patent.patent")
                                @include("update.language.language")
                                @include("update.address.current-address")
                                @include("update.address.permanent-address")
                                @include("update.reference.reference")                                
                               
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

function PPCheck(section, value){
    $.ajax({
        url: "{{ URL::to('update/pp-check') }}", 
        type: 'POST',
        dataType: 'html',
        data: {
            "section" : section,
            "value" : value,
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
            PPCheck(section,value);
        })

        $(".shareCheckbox").on("click", function(){
            if($(this).is(":checked")){
                $(this).val("1");
            } else {
                $(this).val("0");
            }
            //event.preventDefault();
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

