<li>
                                    <div class="collapsible-header" id="objectiveInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="objectiveData" name"objectiveData" @if(($resumeAccess && $resumeAccess->objectiveData=='1') || !$resumeAccess) value="1" checked="checked" @else value="0" @endif />
                                                <label for="objectiveData"></label>
                                            </div>
                                            <div class="fl">
                                                Professional summary and objective
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            @if($objectiveCount > 0)
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>
                                                <div class="button-content top10">
                                                    <div class = "switch">
                                                        <label>
                                                            @if($objectiveInfo['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="objective">
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="objective" checked>
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            <li class="collection-item">
                                                <a href="{{URL::to('update/objective')}}" class="collapsible-body-inner">
                                                <div class="update-desc">
                                                    <span class="bold">
                                                        @if($objectiveCount > 0)
                                                            @if(strlen($objectiveInfo['objective']) > 50)
                                                                <?php echo substr($objectiveInfo['objective'],0,50); ?>...
                                                            @else
                                                                {{$objectiveInfo['objective']}}
                                                            @endif
                                                        @else
                                                            Click to add professional summary
                                                        @endif
                                                    </span>
                                                    </div>
                                                    <span class="secondary-content">
                                                        <i class="material-icons">edit</i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <script>
                                        $(document).ready(function(){
                                            $('.PPCheck[data-id="objective"]').on('change', function() {
                                                if($('.PPCheck[data-id="objective"]:checked').length == 0) {
                                                   $("#objectiveData").prop('checked',false);
                                                   $("#objectiveData").trigger('change');
                                                } else {
                                                    $("#objectiveData").prop('checked',true);
                                                }
                                            });
                                            $("#objectiveData").on('change', function(){
                                                if($('#objectiveData:checked').length == 0) {
                                                    $(".PPCheck[data-id='objective']").prop('checked',false);
                                                } else {
                                                    $(".PPCheck[data-id='objective']").prop('checked',true);
                                                }
                                            });
                                        });
                                    </script>
