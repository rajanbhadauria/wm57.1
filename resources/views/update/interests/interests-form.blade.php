@extends('layouts.app')
@section('content')

<?php
// This section is for redirect back

if( isset($redirectBack) ) {
    if($redirectBack == "view"){
        $redirectBack = URL::to('resume/view?sectionid=interestInfo');
    }
} else {
    $redirectBack = URL::to('update?sectionid=interestInfo');
}
?>

<section class="title-bar">
        <div class="container">
            <div class="row mb0">
                <div class="col s12 pr">
                    <h1>{{isset($interests['id'])?'Update':'Add'}} Interests</h1>
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
    <div class="section wrappit" ng-app="InterestsFromApp" ng-controller="myCtrl">
      <div class="container">
        <div class="center-wrapper" id="heightSet" >
          <div class="center-container">
            <div class="big-center-box">
                <div class="inner-half-container" id="loginDiv"  >
                    <div class="row mb20">
                        <div class="">
                            <form action="{{URL::to('update/interests-save')}}" method="POST" id="interestsForm" name="interestsForm" novalidate>
                                {{ csrf_field() }}
                                <div class="input-field custom-form">
                                    <p><span id="multiple-input" class="select3-input" name="interests"></span></p>
                                    <label class="active">Interests <span>*</span></label>
                                </div>

                                <div class="row">
                                    <div class="col s6 pl0" id="cancel">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-black display-block">Cancel</a>
                                    </div>

                                    <div class="col s6 pl0" id="remove">
                                        <a href="{{$redirectBack}}" class="waves-effect waves-light btn-red display-block">Remove</a>
                                    </div>

                                    <div class="col s6 pr0 custom-submit">
                                    <input type="hidden" name="id" id="id" value="{{isset($interests['id'])?$interests['id']:''}}">
                                        <a href="javascript:void(0)" name="saveInterestsButton" id="saveInterestsButton" class="waves-effect waves-light btn-blue display-block" >Save</a>
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

        $("#interestsForm").on('submit', function(e){
            e.preventDefault();
            e.preventDefault();
        });
        $("#saveInterestsButton").on('click', function( event ) {

            $.ajax({
                type:"POST",
                url:"{{URL::to('update/interests-save')}}",
                data:{
                    "id":$("#id").val(),
                    "interests":$('#multiple-input').select3('data'),
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
                    type:"GET",
                    dataType : "JSON",
                    url:"{{URL::to('update/interests/remove')}}/"+$("#id").val(),
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


        var interests = <?php echo json_encode($interestsList);?>;


                var transformText = $.fn.select3.transformText;

                // example query function that returns at most 10 skills matching the given text
                function queryFunction(query) {
                    var term = query.term;
                    var offset = query.offset || 0;
                    var results = interests.filter(function(interest) {
                        return transformText(interest).indexOf(transformText(term)) > -1;
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
var app = angular.module('InterestsFromApp', []);

function getInterestDetails(){
    app.controller('myCtrl', function($scope, $http) {
        $http.post("{{URL::to('update/get-interests-details')}}",{'id':'{{$id}}' })
        .then(function(response) {
            if(response.data.error == false){
                $('#id').val(response.data.interests.id);

                var SkillObj = $('#multiple-input').select3({
                    multiple: true,
                    placeholder: 'Type to search',
                    data:JSON.parse(response.data.interests.interest),//[{"id":"Amsterdam","text":"Amsterdam"},{"id":"Barcelona","text":"Barcelona"},{"id":"Bremen","text":"Bremen"}],
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

getInterestDetails();


</script>

@endsection
