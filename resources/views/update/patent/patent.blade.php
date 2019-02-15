                                <li>
                                    <div class="collapsible-header" id="patentInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="patentData" name"patentData" @if($resumeAccess && $resumeAccess->patentData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="patentData"></label>
                                            </div>
                                            <div class="fl">
                                                Patents @if($patentCount > 0) ({{$patentCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/patent')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
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
                                                            @if($patentCount > 0 && $patentInfo[0]['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="patent" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="patent">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @if($patentCount > 0)
                                                @foreach($patentInfo as $patent)
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/patent')}}/{{$patent->id}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">{{$patent->patent}}</span> 
                                                        <span class="normal">- {{$patent->reference}}</span> 
                                                     </div>
                                                        <span class="secondary-content">
                                                            <i class="material-icons">edit</i>
                                                        </span>
                                                    </a>
                                                </li>
                                                @endforeach  
                                            @else
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/patent')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add patent</span> 
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
