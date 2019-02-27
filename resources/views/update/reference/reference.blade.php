                                <li>
                                    <div class="collapsible-header" id="referenceInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="referenceData" name"referenceData" @if($resumeAccess && $resumeAccess->referenceData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="referenceData"></label>
                                            </div>
                                            <div class="fl">
                                                References @if($referenceCount > 0) ({{$referenceCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/reference')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>

                                            </li>
                                            @if($referenceCount > 0)
                                                @foreach($referenceInfo as $reference)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0">
                                                            <div class = "switch">
                                                                    <label>
                                                                        @if($reference['private'])
                                                                            <input type="checkbox" data-value="<?php echo $reference['id']?>" class="PPCheck" data-id="reference" checked>
                                                                        @else
                                                                            <input type="checkbox" data-value="<?php echo $reference['id']?>" class="PPCheck" data-id="reference">
                                                                        @endif
                                                                        <span class = "lever"></span>
                                                                    </label>
                                                                </div>
                                                    </div>
                                                    <div class="col s9 p0">
                                                        <a href="{{URL::to('update/reference')}}/{{$reference->id}}" class="collapsible-body-inner">
                                                            <div class="update-desc">
                                                                <span class="bold">{{$reference->reference}}</span>
                                                                <span class="normal">- {{$reference->school}}</span>
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
                                                    <a href="{{URL::to('update/reference')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add reference</span>
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
