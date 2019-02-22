                                <li>
                                    <div class="collapsible-header" id="softskillInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="softskillData" name"softskillData" @if($resumeAccess && $resumeAccess->softskillData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="skillData"></label>
                                            </div>
                                            <div class="fl">
                                                Soft management skills
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/soft-skill')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
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
                                                            @if($softskillCount > 0 && $softskillInfo[0]['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="skill" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="skill">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                             @if($softskillCount > 0)

                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/soft-skill')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span>
                                                            <?php

                                                                $softskills = json_decode($softskillInfo[0]->soft_skill);
                                                            ?>
                                                            @foreach($softskills as $skill)
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
                                                    <a href="{{URL::to('update/soft-skill')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add soft management skills</span>
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
