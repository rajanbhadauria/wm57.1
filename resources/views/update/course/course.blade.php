                                <li>
                                    <div class="collapsible-header" id="courseInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="courseData" name"courseData" @if(($resumeAccess && $resumeAccess->courseData=='1') || !$resumeAccess) value="1" checked="checked" @else value="0" @endif />
                                                <label for="courseData"></label>
                                            </div>
                                            <div class="fl">
                                                Subjects / Courses @if($courseCount > 0) ({{$courseCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/course')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>

                                            </li>
                                            @if($courseCount > 0)
                                                @foreach($courseInfo as $course)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0">
                                                        <div class = "switch">
                                                            <label>
                                                                @if($course['private'])
                                                                    <input type="checkbox" data-value="<?php echo $course['id']?>" class="PPCheck" data-id="course">
                                                                @else
                                                                    <input type="checkbox" data-value="<?php echo $course['id']?>" class="PPCheck" data-id="course" checked>
                                                                @endif
                                                                <span class = "lever"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col s9 p0">
                                                        <a href="{{URL::to('update/course')}}/{{$course->id}}" class="collapsible-body-inner">
                                                            <div class="update-desc">
                                                                <span class="bold">{{$course->course}}</span>
                                                                <span class="normal">- {{$course->school}}</span>
                                                            </div>
                                                            <span class="secondary-content">
                                                                <i class="material-icons">edit</i>
                                                            </span>
                                                        </a>
                                                    </div>

                                                </li>
                                                @endforeach
                                            @else
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/course')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add subject / course</span>
                                                    </div>
                                                        <span class="secondary-content">
                                                            <i class="material-icons">edit</i>
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                                <script>
                                        $(document).ready(function(){
                                            $('.PPCheck[data-id="course"]').on('change', function() {
                                                if($('.PPCheck[data-id="course"]:checked').length == 0) {
                                                    $("#courseData").prop('checked',false);
                                                    $("#courseData").trigger('change');
                                                } else {
                                                    $("#courseData").prop('checked',true);
                                                }

                                            });
                                            $("#courseData").on('change', function(){
                                                if($('#courseData:checked').length == 0) {
                                                    $(".PPCheck[data-id='course']").prop('checked',false);

                                                } else {
                                                    $(".PPCheck[data-id='course']").prop('checked',true);
                                                }
                                            });
                                        });
                                    </script>
