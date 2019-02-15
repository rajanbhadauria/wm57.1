                                <li>
                                    <div class="collapsible-header" id="educationInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="educationData" name"educationData" @if($resumeAccess && $resumeAccess->educationData=='1') value="1" checked="checked" @else value="0" @endif />
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
                                                <div class="button-content top10">
                                                    <div class = "switch">
                                                        <label>
                                                            @if($educationCount > 0 && $educationInfo[0]['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="education" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="education">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @if($educationCount > 0)
                                                @foreach($educationInfo as $education)
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/education')}}/{{$education['id']}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">{{$education->educationName}}</span> 
                                                        <span class="normal">- {{$education->school}} - {{$education->city}}</span>
                                                    </div>
                                                        <span class="secondary-content">
                                                            <i class="material-icons">edit</i>
                                                        </span>
                                                    </a>
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
