<li>
    <div class="collapsible-header" id="contactInfo">
        <div class="custom-collapsible-header-inner">
            <div class="fl disable-bubble">
                <input type="checkbox" class="shareCheckbox" id="contactData" name="contactData" @if($resumeAccess && $resumeAccess->contactData=='1')
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
            <li class="collection-header">
                <div>
                    Hide / Show
                </div>
                <div class="button-content top10">
                    <div class="switch">
                        <label>
                            @if($contactInfo['private'])
                            <input type="checkbox" class="PPCheck" data-id="contact" checked>
                            @else
                            <input type="checkbox" class="PPCheck" data-id="contact">
                            @endif
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
            </li>

            @if( $contactInfo != "")
            <li class="collection-item">
                <a href="{{URL::to('update/contact')}}" class="collapsible-body-inner">
                    <div class="update-desc">
                        <span class="bold">{{$contactInfo->primaryEmail}}</span>
                    </div>
                    <span class="secondary-content">
                        <i class="material-icons">edit</i>
                    </span>
                </a>
            </li>
            @if($contactInfo->altEmail!="")
            <li class="collection-item">
                <a href="{{URL::to('update/contact')}}" class="collapsible-body-inner">
                    <div class="update-desc">
                        <span class="bold">
                            <?php $contactInfo->altEmail!=""?$altEmail=$contactInfo->altEmail." (alternative)": $altEmail="(alternative email)"; echo $altEmail ?></span>
                    </div>
                    <span class="secondary-content">
                        <i class="material-icons">edit</i>
                    </span>
                </a>
            </li>
            @endif
            <li class="collection-item">
                <a href="{{URL::to('update/contact')}}" class="collapsible-body-inner">
                    <div class="update-desc">
                        <span class="bold">+ {{$contactInfo->primaryPhoneCode}}-{{$contactInfo->primaryPhone}}</span>
                    </div>
                    <span class="secondary-content">
                        <i class="material-icons">edit</i>
                    </span>
                </a>
            </li>
            @if($contactInfo->altPhone!="")
            <li class="collection-item">
                <a href="{{URL::to('update/contact')}}" class="collapsible-body-inner">
                    <div class="update-desc">
                        <span class="bold">
                            <?php $contactInfo->altPhone!=""?$altPhone="+".$contactInfo->altPhoneCode."-".$contactInfo->altPhone." (alternative)": $altPhone="(alternative Phone)"; echo $altPhone ?></span>
                    </div>
                    <span class="secondary-content">
                        <i class="material-icons">edit</i>
                    </span>
                </a>
            </li>
            @endif
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
