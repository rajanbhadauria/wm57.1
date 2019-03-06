@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=softskillInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=softskillInfo');
}
?>

<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>Add / Update Personal management skills</h1>
                    <ul class="panel-actions resumebox-actions pull-right">
                            <li>
                                <a href="{{url('/update')}}" class="text-primary"><i class="tiny material-icons">edit</i></a>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="section wrappit" ng-app="SoftSkillFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row mb20">
                        <div class="">
                            <form action="{{URL::to('update/soft-skill-save')}}" method="POST" id="skillForm" name="skillForm" novalidate>
                                {{ csrf_field() }}
                                <div class="input-field custom-form">
                                    <p><span id="multiple-input" class="select3-input" name="skills"></span></p>
                                    <label class="active">Soft management skills <span>*</span></label>
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
                url:"{{URL::to('update/soft-skill-save')}}",
                data:{
                    "id":$("#id").val(),
                    "skills":$('#multiple-input').select3('data'),
                    "_token": "{{ csrf_token()}}"
                },
                success: function(response){
                    window.location.href = "{{url($returnUrl)}}";
                }
            });
        });

        $("#remove").hide();

        $("#remove").on("click", function(event){
            var r = confirm("Are you sure you want to delete!");
            if (r == true) {
                var formData = $(this).serializeArray();
                formData.push({ name: "_token", value: "{{ csrf_token()}}" });
                $.ajax({
                    type:"POST",
                    dataType : "JSON",
                    url:"{{URL::to('update/soft-skill/remove')}}/"+$("#id").val(),
                    data:formData,
                    success: function(response){
                        if(response.error == 0){
                            window.location.href = "{{url($returnUrl)}}";
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
var app = angular.module('SoftSkillFromApp', []);

function getSoftSkillDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-soft-skill-details')}}",{'id':'{{$id}}' })
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.softSkill.id);

                var SkillObj = $('#multiple-input').select3({
                    multiple: true,
                    placeholder: 'Type to search',
                    data:JSON.parse(response.data.softSkill.soft_skill),
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


        });
    });
}

getSoftSkillDetails();


</script>

@endsection
