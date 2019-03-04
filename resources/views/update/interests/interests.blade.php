                                <li>
                                    <div class="collapsible-header" id="interestInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="interestData" name"interestData" @if(($resumeAccess && $resumeAccess->interestData=='1') || !$resumeAccess) value="1" checked="checked" @else value="0" @endif />
                                                <label for="interestData"></label>
                                            </div>
                                            <div class="fl">
                                                Interests
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/interests')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            @if($interestCount > 0)
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>
                                                <div class="button-content top10">
                                                    <div class = "switch">
                                                        <label>
                                                            @if($interestCount > 0 && $interestInfo[0]['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="interests">
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="interests" checked>
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                             @if($interestCount > 0)
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/interests')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span>
                                                            <?php
                                                                $interests = json_decode($interestsInfo[0]->interest);
                                                            ?>
                                                            @foreach($interests as $interest)
                                                            <div class="chip">
                                                                {{$interest->id}}
                                                            </div>
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                        <span class="secondary-content">
                                                            <i class="material-icons">edit</i>
                                                        </span>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/interests')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add interests</span>
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
                                            $('.PPCheck[data-id="interests"]').on('change', function() {
                                                if($('.PPCheck[data-id="interests"]:checked').length == 0) {
                                                    $("#interestData").prop('checked',false);
                                                } else {
                                                    $("#interestData").prop('checked',true);
                                                }
                                            });
                                        });
                                    </script>
