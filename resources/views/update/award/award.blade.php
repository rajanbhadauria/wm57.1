                                <li>
                                    <div class="collapsible-header" id="awardInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="awardData" name"awardData" @if($resumeAccess && $resumeAccess->awardData=='1') value="1" checked="checked" @else value="0" @endif/>
                                                <label for="awardData"></label>
                                            </div>
                                            <div class="fl">
                                                Awards and honors @if($awardCount > 0) ({{$awardCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/award')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
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
                                                            @if($awardCount > 0 && $awardInfo[0]['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="award" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="award">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @if($awardCount > 0)
                                                @foreach($awardInfo as $award)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0">
                                                        <div class = "switch">
                                                            <label>
                                                                @if($award['private'])
                                                                    <input type="checkbox" data-value="<?php echo $award['id']?>" class="PPCheck" data-id="award" checked>
                                                                @else
                                                                    <input type="checkbox" data-value="<?php echo $award['id']?>" class="PPCheck" data-id="award">
                                                                @endif
                                                                <span class = "lever"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col s9 p0">
                                                        <a href="{{URL::to('update/award')}}/{{$award->id}}" class="collapsible-body-inner">
                                                        <div class="update-desc">
                                                            <span class="bold">{{$award->award}}</span>
                                                            <span class="normal">- {{$award->school}}</span>
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
                                                    <a href="{{URL::to('update/award')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add award and recognition</span>
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
