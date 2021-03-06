                                <li>
                                    <div class="collapsible-header" id="certificationInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="certificationData" name"certificationData"  @if(($resumeAccess && $resumeAccess->certificationData=='1') || !$resumeAccess ) value="1" checked="checked" @else value="0" @endif />
                                                <label for="certificationData"></label>
                                            </div>
                                            <div class="fl">
                                                Certifications @if($certificationCount > 0) ({{$certificationCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/certification')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            @if($certificationCount > 0)
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>

                                            </li>
                                            @endif
                                            @if($certificationCount > 0)
                                                @foreach($certificationInfo as $certification)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0">
                                                            <div class = "switch">
                                                                    <label>
                                                                        @if($certification['private'])
                                                                            <input type="checkbox" data-value="<?php echo $certification['id']?>" class="PPCheck" data-id="certification">
                                                                        @else
                                                                            <input type="checkbox" data-value="<?php echo $certification['id']?>" class="PPCheck" data-id="certification" checked>
                                                                        @endif
                                                                        <span class = "lever"></span>
                                                                    </label>
                                                                </div>
                                                    </div>
                                                    <div class="col s9 p0">
                                                            <a href="{{URL::to('update/certification')}}/{{$certification->id}}" class="collapsible-body-inner">
                                                                <div class="update-desc">
                                                                    <span class="bold">{{$certification->certification}}</span>
                                                                    <span class="normal">- {{$certification->school}}</span>
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
                                                    <a href="{{URL::to('update/certification')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add certification summary</span>
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
                                <script>
                                        $(document).ready(function(){
                                            $('.PPCheck[data-id="certification"]').on('change', function() {
                                                if($('.PPCheck[data-id="certification"]:checked').length == 0) {
                                                    $("#certificationData").prop('checked',false);
                                                    $("#certificationData").trigger('change');
                                                } else {
                                                    $("#certificationData").prop('checked',true);
                                                }
                                            });
                                            $("#certificationData").on('change', function(){
                                                if($('#certificationData:checked').length == 0) {
                                                    $(".PPCheck[data-id='certification']").prop('checked',false);
                                                } else {
                                                    $(".PPCheck[data-id='certification']").prop('checked',true);
                                                }
                                            });
                                        });
                                    </script>
