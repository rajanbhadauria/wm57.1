                                <li>
                                    <div class="collapsible-header" id="travelInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="travelData" name"travelData" @if($resumeAccess && $resumeAccess->travelData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="travelData"></label>
                                            </div>
                                            <div class="fl">
                                                Work related travels @if($travelCount > 0) ({{$travelCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/travel')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
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
                                                            @if($travelCount > 0 && $travelInfo[0]['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="travel" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="travel">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>

                                            @if($travelCount > 0)
                                                @foreach($travelInfo as $travel)
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/travel')}}/{{$travel->id}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">{{$travel->project}}</span> 
                                                        <span class="normal">- {{$travel->company}}</span> 
                                                    </div>
                                                        <span class="secondary-content">
                                                            <i class="material-icons">edit</i>
                                                        </span>
                                                    </a>
                                                </li>
                                                @endforeach  
                                            @else
                                                <li class="collection-item">
                                                    <a href="{{URL::to('update/travel')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add work related travel</span> 
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
