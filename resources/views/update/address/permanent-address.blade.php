
                                <li>
                                    <div class="collapsible-header" id="permanent-address">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="permanentAddressData" name"permanentAddressData"  @if($resumeAccess && $resumeAccess->permanentAddressData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="permanentAddressData"></label>
                                            </div>
                                            <div class="fl">
                                                Permanent address
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
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
                                                            @if($permanentAddressInfo['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="permanentAddress" checked>
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="permanentAddress">
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                              
                                            <li class="collection-item">
                                                @if($permanentAddressCount>0)
                                                <a href="{{URL::to('update/permanent-address')}}" class="collapsible-body-inner">
                                                <div class="update-desc">
                                                    <span class="bold"><span class="bold">{{showDetail($permanentAddressInfo['houseNumber'])}} {{showDetail($permanentAddressInfo['blockSector'])}} {{showDetail($permanentAddressInfo['societyName'])}} {{showDetail($permanentAddressInfo['city'])}}</span></span> 
                                                </div>
                                                    <span class="secondary-content">
                                                        <i class="material-icons">edit</i>
                                                    </span>
                                                </a>
                                                @else
                                                <a href="{{URL::to('update/permanent-address')}}" class="collapsible-body-inner">
                                                <div class="update-desc">
                                                    <span class="bold"><span class="bold">click to update permanent address</span></span> 
                                                </div>
                                                    <span class="secondary-content">
                                                        <i class="material-icons">edit</i>
                                                    </span>
                                                </a>
                                                @endif
                                            </li> 
                                        </ul> 
                                    </div>
                                </li>
