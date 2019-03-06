<li>
                                    <div class="collapsible-header" id="profileimage">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox"  id="profileData" name="profileData" @if(($resumeAccess && $resumeAccess->profileData=='1') || !$resumeAccess) value="1" checked="checked" @else value="0" @endif />
                                                <label for="profileData"></label>
                                            </div>
                                            <div class="fl">
                                                Profile image
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            @if($profileImageData['avatar']!="")
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>
                                                <div class="button-content top10">
                                                    <div class = "switch">
                                                        <label>
                                                            @if($profileImageData['profilePrivate'] == '1')
                                                                <input type="checkbox" class="PPCheck" data-id="profilePrivate">
                                                            @else
                                                                <input type="checkbox" class="PPCheck" data-id="profilePrivate" checked>
                                                            @endif
                                                        <span class = "lever"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            <li class="collection-item">
                                                <a href="{{URL::to('user/profile-image?ref_url=update?sectionid=profileimage')}}" class="collapsible-body-inner">
                                                <div class="update-desc">
                                                    <span class="bold">
                                                        @if($profileImageData['avatar']!="")
                                                            Updated on {{ date("d, M Y", strtotime($profileImageData['avatar_updated'])) }}
                                                        @else
                                                            Click to update profile image
                                                        @endif
                                                    </span>
                                                 </div>
                                                    <span class="secondary-content">
                                                        <i class="material-icons">edit</i>
                                                    </span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
<script>
    $(document).ready(function(){
        $('.PPCheck[data-id="profilePrivate"]').on('change', function() {
            if(!$('.PPCheck[data-id="profilePrivate"]:checked').length) {
               $("#profileData").prop('checked',false);
               $("#profileData").trigger('change');
            } else {
                $("#profileData").prop('checked',true);
            }
        });
        $("#profileData").on('change', function(){
                if($('#profileData:checked').length == 0) {
                    $(".PPCheck[data-id='profilePrivate']").prop('checked',false);
                } else {
                    $(".PPCheck[data-id='profilePrivate']").prop('checked',true);
                }
            });
    });
</script>
