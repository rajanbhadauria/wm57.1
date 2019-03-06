                                <li>
                                    <div class="collapsible-header" id="educationInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="educationData" name"educationData" @if(($resumeAccess && $resumeAccess->educationData=='1') || !$resumeAccess) value="1" checked="checked" @else value="0" @endif />
                                                <label for="educationData"></label>
                                            </div>
                                            <div class="fl">
                                                Education @if($educationCount > 0) ({{$educationCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/education')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>

                                            </li>
                                            @if($educationCount > 0)
                                                @foreach($educationInfo as $education)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0">
                                                        <div class = "switch">
                                                            <label>
                                                                @if($education['private'])
                                                                    <input type="checkbox" data-value="<?php echo $education['id']?>" class="PPCheck" data-id="education">
                                                                @else
                                                                    <input type="checkbox" data-value="<?php echo $education['id']?>" class="PPCheck" data-id="education" checked>
                                                                @endif
                                                                <span class = "lever"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col s9 p0">
                                                        <a href="{{URL::to('update/education')}}/{{$education['id']}}?url=update?sectionid=educationInfo" class="collapsible-body-inner">
                                                        <div class="update-desc">
                                                            <span class="bold">{{$education->educationName}}</span>
                                                            <span class="normal">- {{$education->school}} - {{$education->city}}</span>
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
                                                    <a href="{{URL::to('update/education')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add education</span>
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
                                            $('.PPCheck[data-id="education"]').on('change', function() {
                                                if($('.PPCheck[data-id="education"]:checked').length == 0) {
                                                    $("#educationData").prop('checked',false);
                                                    $("#educationData").trigger('change');
                                                } else {
                                                    $("#educationData").prop('checked',true);
                                                }
                                            });

                                            $("#educationData").on('change', function(){
                                                if($('#educationData:checked').length == 0) {
                                                    $(".PPCheck[data-id='education']").prop('checked',false);

                                                } else {
                                                    $(".PPCheck[data-id='education']").prop('checked',true);
                                                }
                                            });
                                        });
                                    </script>
