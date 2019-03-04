@extends('layouts.app')
@section('content')
<style>
.select3-no-results, .select3-results-container{ visibility: hidden !important;}
</style>
<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=skillInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=skillInfo');
}
?>

<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Add / Update Functional domain skills</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="SkillFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row mb20">
                        <div class="">
                            <form action="{{URL::to('update/skill-save')}}" method="POST" id="skillForm" name="skillForm" novalidate>

                                <div class="input-field custom-form">
                                    <p><span id="multiple-input" class="select3-input" name="skills"></span></p>
                                    <label class="active">Functional skills <span>*</span></label>
                                </div>

                                <div class="row">
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>

                                    <div class="col s6 pl0" id="remove">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>

                                    <div class="col s6 pr0 custom-submit">
                                        <input type="hidden" name="id" id="id" value="0">
                                        <a href="javascript:void(0)" name="saveSkillButton" id="saveSkillButton" class="waves-effect waves-light btn-blue display-block" >Save</a>
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

        $("#skillForm").on('submit', function(e){
            e.preventDefault();
            e.preventDefault();
        });
        $("#saveSkillButton").on('click', function( event ) {

            $.ajax({
                type:"POST",
                url:"{{URL::to('update/skill-save')}}",
                data:{
                    "id":$("#id").val(),
                    "skills":$('#multiple-input').select3('data'),
                    "_token": "{{ csrf_token()}}"
                },
                success: function(response){
                    window.location.href = "{{$redirectBack}}";
                }
            });
        });

        $("#remove").hide();

        $("#remove").on("click", function(event){
            event.preventDefault();
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/skill/remove')}}/"+$("#id").val(),
                    data:$(this).serialize(),
                    success: function(response){
                        if(response.error == 0){
                            window.location.href = "{{$redirectBack}}";
                        }
                    }
                });

            }
        });

    });
</script>



<script>


        var skills = <?php echo json_encode($skillList);?>;


                var transformText = $.fn.select3.transformText;

                // example query function that returns at most 10 skills matching the given text
                function queryFunction(query) {
                    var term = query.term;
                    var offset = query.offset || 0;
                    var results = skills.filter(function(skill) {
                        return transformText(skill).indexOf(transformText(term)) > -1;
                    });
                    results.sort(function(a, b) {
                        a = transformText(a);
                        b = transformText(b);
                        var startA = (a.slice(0, term.length) === term),
                            startB = (b.slice(0, term.length) === term);
                        if (startA) {
                            return (startB ? (a > b ? 1 : -1) : -1);
                        } else {
                            return (startB ? 1 : (a > b ? 1 : -1));
                        }
                    });
                    setTimeout(query.callback({
                        more: results.length > offset + 10,
                        results: results.slice(offset, offset + 10)
                    }), 500);
                }

</script>

<script type="text/javascript">
var app = angular.module('SkillFromApp', []);

function getSkillDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-skill-details')}}",{'id':'{{$id}}' })
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.skill.id);

                var SkillObj = $('#multiple-input').select3({
                    multiple: true,
                    placeholder: 'Type to search',
                    data:JSON.parse(response.data.skill.skill),//[{"id":"Amsterdam","text":"Amsterdam"},{"id":"Barcelona","text":"Barcelona"},{"id":"Bremen","text":"Bremen"}],
                    query: queryFunction
                });

                transformText = $.fn.select3.transformText;
                $("#cancel").hide();
                $("#remove").show();
            } else {

                var SkillObj = $('#multiple-input').select3({
                    multiple: true,
                    placeholder: 'Type to search',
                    query: queryFunction
                });
                transformText = $.fn.select3.transformText;

            }


            console.log(response.data)
        });
    });
}

getSkillDetails();


</script>

@endsection
