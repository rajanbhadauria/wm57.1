<li>
                                    <div class="collapsible-header" id="objectiveInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="objectiveData" name"objectiveData" @if($resumeAccess && $resumeAccess->objectiveData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="objectiveData"></label>
                                            </div>
                                            <div class="fl">
                                                Objective
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>
                                                <div class="button-content top10">
                                                    <div class = "switch">
                                                        <label>
                                                            @if($contactInfo['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="objective" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="objective">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
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
                                                            Click to add objective
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
