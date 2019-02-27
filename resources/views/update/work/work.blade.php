                                <li>
                                    <div class="collapsible-header" id="workInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="workData" name"workData" @if($resumeAccess && $resumeAccess->workData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="workData"></label>
                                            </div>
                                            <div class="fl">
                                                Work experience @if($workCount > 0) ({{$workCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/work')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>

                                            </li>

                                            @if($workCount > 0)
                                                @foreach($workInfo as $work)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0 text-left">
                                                            <div class = "switch">
                                                                <label>
                                                                    @if($work['private'])
                                                                        <input type="checkbox" class="PPCheck" data-value="<?php echo $work['id']?>" data-id="work" checked>
                                                                    @else
                                                                        <input type="checkbox" class="PPCheck" data-value="<?php echo $work['id']?>" data-id="work">
                                                                    @endif
                                                                    <span class = "lever"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col s9">
                                                    <a href="{{URL::to('update/work')}}/{{$work->id}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">{{$work->company}}</span>
                                                        <span class="normal">- {{$work->role}} - {{$work->city}}</span>
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
                                                    <a href="{{URL::to('update/work')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add work experience</span>
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
