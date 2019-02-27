                                <li>
                                    <div class="collapsible-header" id="projectInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="projectData" name"projectData" @if($resumeAccess && $resumeAccess->projectData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="projectData"></label>
                                            </div>
                                            <div class="fl">
                                                Key assignments and projects @if($projectCount > 0) ({{$projectCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/project')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>

                                            </li>

                                            @if($projectCount > 0)
                                                @foreach($projectInfo as $project)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0 m-0">
                                                            <div class = "switch">
                                                                    <label>
                                                                        @if($project['private'])
                                                                            <input type="checkbox" class="PPCheck" data-value="<?php echo $project['id']?>" data-id="project" checked>
                                                                        @else
                                                                            <input type="checkbox" class="PPCheck" data-value="<?php echo $project['id']?>" data-id="project">
                                                                        @endif
                                                                        <span class = "lever"></span>
                                                                    </label>
                                                                </div>
                                                    </div>
                                                    <div class="col s9">
                                                        <a href="{{URL::to('update/project')}}/{{$project->id}}" class="collapsible-body-inner">
                                                        <div class="update-desc">
                                                            <span class="bold">{{$project->project}}</span>
                                                            <span class="normal">- {{$project->school}}</span>
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
                                                    <a href="{{URL::to('update/project')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add key assignment / project</span>
                                                        <span class="normal"></span>
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
