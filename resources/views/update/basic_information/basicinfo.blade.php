                                <li>
                                    <div class="collapsible-header" id="basicInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="basicInfoData" name"basicInfoData"  @if($resumeAccess && $resumeAccess->basicInfoData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="basicInfoData"></label>
                                            </div>
                                            <div class="fl">
                                                User basic informations @if($basicInfoCount > 0) ({{$basicInfoCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('postsignup?url=update?sectionid=basicInfo')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
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
                                                                @if(@$basicInfo->private)
                                                                    <input type="checkbox" class="PPCheck" data-id="basic_info" checked>
                                                                @else
                                                                    <input type="checkbox" class="PPCheck" data-id="basic_info">
                                                                @endif
                                                                <span class = "lever"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                            </li>

                                            @if($basicInfoCount > 0)
                                                <li class="collection-item">
                                                    <div class="col s12 p0">
                                                            <a href="{{URL::to('postsignup?url=update?sectionid=basicInfo')}}" class="collapsible-body-inner">
                                                                    <div class="update-desc">
                                                                        <span class="bold">{{$basicInfo->first_name}} {{$basicInfo->last_name}}</span>
                                                                        <span class="normal">- {{$basicInfo->marital_status}}</span>
                                                                    </div>
                                                                        <span class="secondary-content">
                                                                            <i class="material-icons">edit</i>
                                                                        </span>
                                                                    </a>
                                                    </div>

                                                </li>
                                            @else
                                                <li class="collection-item">
                                                    <a href="{{URL::to('postsignup?url=update?sectionid=basicInfo')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add basic information</span>
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
