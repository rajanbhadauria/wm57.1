                                <li>
                                    <div class="collapsible-header" id="trainingInfo">
                                        <div class="custom-collapsible-header-inner">
                                            <div class="fl disable-bubble">
                                                <input type="checkbox" class="shareCheckbox" id="trainingData" name"trainingData" @if($resumeAccess && $resumeAccess->trainingData=='1') value="1" checked="checked" @else value="0" @endif />
                                                <label for="trainingData"></label>
                                            </div>
                                            <div class="fl">
                                                Trainings attended @if($trainingCount > 0) ({{$trainingCount}}) @endif
                                            </div>
                                            <span class="fr"><i class="material-icons mr0">expand_more</i></span>
                                            <a href="{{URL::to('update/training')}}" class="fr addnewform"><i class="material-icons">add_circle_outline</i></a>
                                        </div>
                                    </div>
                                    <div class="collapsible-body custom-collapsible-body">
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                Hide / Show
                                                </div>

                                            </li>
                                            @if($trainingCount > 0)
                                                @foreach($trainingInfo as $training)
                                                <li class="collection-item row">
                                                    <div class="col s3 p0">
                                                            <div class = "switch">
                                                                    <label>
                                                                        @if($training['private'])
                                                                            <input type="checkbox" data-value="<?php echo $training['id']?>" class="PPCheck" data-id="training" checked>
                                                                        @else
                                                                            <input type="checkbox" data-value="<?php echo $training['id']?>" class="PPCheck" data-id="training">
                                                                        @endif
                                                                        <span class = "lever"></span>
                                                                    </label>
                                                                </div>
                                                    </div>
                                                    <div class="col s9 p0">
                                                        <a href="{{URL::to('update/training')}}/{{$training->id}}" class="collapsible-body-inner">
                                                            <div class="update-desc">
                                                                <span class="bold">{{$training->training}}</span>
                                                                <span class="normal">- {{$training->school}}</span>
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
                                                    <a href="{{URL::to('update/training')}}" class="collapsible-body-inner">
                                                    <div class="update-desc">
                                                        <span class="bold">Click to add training attended</span>
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
