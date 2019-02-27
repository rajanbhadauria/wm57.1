                                <li>
                                    <div class="collapsible-header" id="languageInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="languageData" name"languageData" @if($resumeAccess && $resumeAccess->languageData=='1') value="1" checked="checked" @else value="0" @endif  />
                                                <label for="languageData"></label>
                                            </div>
                                            <div class="fl">
                                                Languages @if($languageCount > 0) ({{$languageCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/language')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>
                                            </li>
                                            @if($languageCount > 0)
                                                @foreach($languageInfo as $language)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0">
                                                        <div class = "switch">
                                                            <label>
                                                                @if($language['private'])
                                                                    <input type="checkbox" data-value="<?php echo $language['id']?>" class="PPCheck" data-id="language" checked>
                                                                @else
                                                                    <input type="checkbox" data-value="<?php echo $language['id']?>" class="PPCheck" data-id="language">
                                                                @endif
                                                                <span class = "lever"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col s9 p0">
                                                        <a href="{{URL::to('update/language')}}/{{$language->id}}" class="collapsible-body-inner">
                                                            <div class="update-desc">
                                                                <span class="bold">{{$language->language}}</span>
                                                                <span class="normal">-
                                                                                        {{$language->read=="1"?"Read,":""}}
                                                                                        {{$language->write=="1"?"Write,":""}}
                                                                                        {{$language->speak=="1"?"Speak,":""}}
                                                                </span>
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
                                                    <a href="{{URL::to('update/language')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add language</span>
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
