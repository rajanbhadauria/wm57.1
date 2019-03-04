<li>
    <div class="collapsible-header" id="contactInfo">
        <div class="custom-collapsible-header-inner">
            <div class="fl disable-bubble">
                <input type="checkbox" class="shareCheckbox" id="contactData" name="contactData" @if(($resumeAccess && $resumeAccess->contactData=='1') || !$resumeAccess)
                value="1" checked="checked" @else value="0" @endif />
                <label for="contactData"></label>
            </div>
            <div class="fl">
                Contact details
            </div>
            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
        </div>
    </div>
    <div class="collapsible-body custom-collapsible-body">
        <ul class="collection with-header">
            @if( $contactInfo != "")
            <li class="collection-header">
                <div>
                    Hide / Show
                </div>
                <div class="button-content top10">
                    <div class="switch">
                        <label>
                            @if($contactInfo['private'])
                            <input type="checkbox" class="PPCheck" data-id="contact">
                            @else
                            <input type="checkbox" class="PPCheck" data-id="contact" checked>
                            @endif
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
            </li>
            @endif

            @if( $contactInfo != "")
            <li class="collection-item">
                    <a href="{{URL::to('update/contact')}}" class="collapsible-body-inner">
                        <div class="update-desc">

                                <span class="bold">{{$contactInfo->primaryEmail}}</span>
                                @if($contactInfo->altEmail)
                                 / <span class="bold">
                                    <?php echo $contactInfo->altEmail.'(alternative email)'; ?>
                                </span>
                                @endif
                                @if($contactInfo->url!="")
                                 / <span class="bold">{{$contactInfo->url}}</span>
                                @endif
                                @if($contactInfo->url!="")
                                 / <span class="bold">+{{$contactInfo->primaryPhoneCode}}-{{$contactInfo->primaryPhone}}</span>
                                @endif
                                @if($contactInfo->altPhone!="")
                                <span class="bold">
                                    <?php $contactInfo->altPhone!=""?$altPhone="+".$contactInfo->altPhoneCode."-".$contactInfo->altPhone." (alternative)": $altPhone="(alternative Phone)"; echo $altPhone ?>
                                </span>
                                @endif
                        </div>
                                <span class="secondary-content pull-right">
                                        <i class="material-icons">edit</i>
                                    </span>

                    </a>
                </li>
             @else
            <li class="collection-item">
                <a href="{{URL::to('update/contact')}}" class="collapsible-body-inner">
                    <div class="update-desc">
                        <span class="bold">click to update contact details</span>
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
<script>
        $(document).ready(function(){
            $('.PPCheck[data-id="contact"]').on('change', function() {
                if($('.PPCheck[data-id="contact"]:checked').length == 0) {
                    $("#contactData").prop('checked',false);
                } else {
                    $("#contactData").prop('checked',true);
                }
            });
        });
    </script>
