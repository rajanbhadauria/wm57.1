<?php function showDetail($value){
    if($value!= ""){
        return $value.", ";
    } else {
        return "";
    }
}
?>
                                <li>
                                    <div class="collapsible-header" id="current-address">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="currentAddressData" name="currentAddressData" @if(($resumeAccess && $resumeAccess->currentAddressData=='1')  || !$resumeAccess) value="1" checked="checked" @else value="0" @endif  />
                                                <label for="currentAddressData"></label>
                                            </div>
                                            <div class="fl">
                                                Current address
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                        @if($currentAddressCount>0)
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>
                                                <div class="button-content top10">

                                                    <div class = "switch">
                                                        <label>
                                                            @if($currentAddressInfo['private'])
                                                                <input type="checkbox" class="PPCheck" data-id="currentAddress">
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="currentAddress" checked>
                                                            @endif
                                                            <span class = "lever"></span>
                                                        </label>
                                                    </div>

                                                </div>
                                            </li>
                                            @endif

                                            <li class="collection-item">
                                                @if($currentAddressCount>0)
                                                <a href="{{URL::to('update/current-address')}}" class="collapsible-body-inner">
                                                <div class="update-desc">
                                                    <span class="bold">{{showDetail($currentAddressInfo['houseNumber'])}} {{ showDetail($currentAddressInfo['blockSector'])}} {{showDetail($currentAddressInfo['societyName'])}} {{showDetail($currentAddressInfo['city'])}}</span>
                                                </div>
                                                    <span class="secondary-content">
                                                        <i class="material-icons">edit</i>
                                                    </span>
                                                </a>
                                                @else
                                                <a href="{{URL::to('update/current-address')}}" class="collapsible-body-inner">
                                                <div class="update-desc">
                                                    <span class="bold"><span class="bold">click to update current address</span></span>
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
                                <script>
                                        $(document).ready(function(){
                                            $('.PPCheck[data-id="currentAddress"]').on('change', function() {
                                                if($('.PPCheck[data-id="currentAddress"]:checked').length == 0) {
                                                    $("#currentAddressData").prop('checked',false);
                                                    $("#currentAddressData").trigger('change');
                                                } else {
                                                    $("#currentAddressData").prop('checked',true);
                                                }
                                            });
                                            $("#currentAddressData").on('change', function(){
                                                if($('#currentAddressData:checked').length == 0) {
                                                    $(".PPCheck[data-id='currentAddress']").prop('checked',false);
                                                } else {
                                                    $(".PPCheck[data-id='currentAddress']").prop('checked',true);
                                                }
                                            });
                                        });
                                    </script>
