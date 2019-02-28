<li>
    <div class="collapsible-header" id="resumetitleInfo">
        <div class="custom-collapsible-header-inner">
            <div class="fl disable-bubble">
                <input type="checkbox" class="shareCheckbox" id="resumetitleData" name"resumetitleData" @if($resumeAccess && $resumeAccess->resumetitleData=='1') value="1" checked="checked" @else value="0" @endif />
                <label for="resumetitleData"></label>
            </div>
            <div class="fl">
                Resume title
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
                            @if($resumetitleInfo['private'])
                                <input type="checkbox" class="PPCheck" data-id="resumetitle" checked>
                            @else
                                <input type="checkbox" class="PPCheck" data-id="resumetitle">
                            @endif
                            <span class = "lever"></span>
                        </label>
                    </div>
                </div>
            </li>
            <li class="collection-item">
                <a href="{{URL::to('update/resume-title-cover-note')}}" class="collapsible-body-inner">
                <div class="update-desc">
                    <span class="bold">
                        @if($resumetitleCount > 0)
                            @if(strlen($resumetitleInfo['resumetitle']) > 50)
                                <?php echo substr($resumetitleInfo['resume_title'],0,50); ?>...
                            @else
                                {{$resumetitleInfo['resume_title']}}
                            @endif
                        @else
                            Click to add resume title
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
