                                <li>
                                    <div class="collapsible-header" id="skillInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="skillData" name"skillData" @if($resumeAccess && $resumeAccess->skillData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="skillData"></label>
                                            </div>
                                            <div class="fl">
                                                Skills
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/skill')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
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
                                                            @if($skillCount > 0 && $skillInfo[0]['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="skill" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="skill">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                             @if($skillCount > 0)
                                                
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/skill')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span>
                                                            <?php 
                                                                $skills = json_decode($skillInfo[0]->skill);
                                                            ?>
                                                            @foreach($skills as $skill)
                                                            <div class="chip">
                                                                {{$skill->id}}
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
                                                    <a href="{{URL::to('update/skill')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add skill</span> 
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
