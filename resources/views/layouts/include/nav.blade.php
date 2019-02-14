@if(Auth::check())
<?php $resumeDetails = DB::table("resumes")->where("ownerEmail","=",Auth::user()->email)->get(); ?>
<nav id="site_nav" class="side-nav">
    <div class="menu">
        <div class="menu-scroll">
            <div class="menu-content margin-top-no">
                <ul class="nav">
                    <li class="header">
                        <a class="nav-home" href="{{ url('/home') }}">
                            <p>WorkMedian <span>[WM5456R]</span></p>
                            <!-- <span  class="menu-close waves-effect waves-white">
                                <i class="material-icons">close</i>
                            </span> -->
                        </a>
                    </li>
                    <!-- <li><a class="waves-effect" href="#"><i class="material-icons grey-text margin-right">assignment</i> WM5456R</a></li> -->
                    <!-- <li><a class="waves-effect waves-light-grey" href="#"><i class="material-icons grey-text margin-right">assignment</i>
                            Add credits</a></li>
                    <li><a class="waves-effect waves-light-grey" href="#"><i class="material-icons grey-text margin-right">assignment</i>
                            Credits status (456/1000) </a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/home') }}"><i class="material-icons grey-text margin-right">home</i>
                            Home</a></li> -->
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/update') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Update resume</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/view') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Edit resume (self view)</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{url('/resumesample')}}"><i
                                class="material-icons grey-text margin-right">public</i> View resume (Public)</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/postsignup') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Post signup</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/sendresume') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Send resume</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/requestresume') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Request resume</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/socialmediaverification') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Social media verification</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/preloader') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Preloader</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/forwardresume') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Forward resume</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/invite') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Invite</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/phoneverification') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Phone verification</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/jobseekingstatus') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Job seeking status</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/share') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Share</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/recommend') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Recommend</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/error') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Error</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/success') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Success</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/failure') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Failure</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/settings') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Settings</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/emailverification') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Email verification</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/deactivate') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Deactivate account</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resumebox') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Resume box</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/memberlist') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Memberslist</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/skillshiring') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Skills hiring</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/membersinvited') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Members invited</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/accesscode') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Access code</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resumetrack') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Track resume</a></li>
                    <li><a class="waves-effect waves-light-grey modal-trigger" href="#resume-actions"><i class="material-icons grey-text  margin-right">assignment</i>
                            Popup</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/password/activation-link-sent') }}"><i
                                class="material-icons grey-text  margin-right">assignment</i>
                            Password activation link</a></li>
                </ul>
                <ul class="nav">
                    <li><a class="waves-effect waves-light-grey" href="termsconditions.php">Terms &amp; conditions </a></li>
                    <li><a class="waves-effect waves-light-grey" href="privacypolicy.php">Privacy policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div id="user_nav" class="side-nav-rhs">
    <div class="sidebar-overlay"></div>
    <div id="sidebar" class="menu sidebar sidebar-fixed-right sidebar-default">
        <div class="menu-scroll">
            <div class="menu-top">
                <div class="menu-top-img brand">
                    @if(Auth::user()->avatar != "")
                    @if(strpos(Auth::user()->avatar,"ttp"))
                    <img alt="" src="{{Auth::user()->avatar}}">
                    @elseif(file_exists(public_path("/uploads/images/user/".Auth::user()->avatar)))
                    <img alt="" src="{{url('uploads/images/user/')}}/{{Auth::user()->avatar}}">
                    @else
                    <img alt="" src="/uploads/images/user/user-img-white.jpg">
                    @endif
                    @else
                    <img alt="" src="/uploads/images/user/user-img-white.jpg">
                    @endif
                </div>
                @if(!count($resumeDetails))
                <div class="menu-top-info">
                    <a class="menu-top-user bold flow-text" href="javascript:void(0);">
                        <span class="avatar avatar-lg avatar-inline margin-right border-fade">
                                @if(Auth::user()->avatar != "")
                            @if(strpos(Auth::user()->avatar,"ttp"))
                            <img alt="" src="{{Auth::user()->avatar}}">
                            @elseif(file_exists(public_path("/uploads/images/user/".Auth::user()->avatar)))
                            <img alt="" src="{{url('uploads/images/user/')}}/{{Auth::user()->avatar}}">
                            @else
                            <img alt="" src="/uploads/images/user/user-img-white.jpg">
                            @endif
                            @else
                            <img alt="" src="/uploads/images/user/user-img-white.jpg">
                            @endif
                          </span>
                        {{Auth::user()->name}}
                    </a>
                </div>
                @else
                <div class="menu-top-info">
                    <a class="menu-top-user bold flow-text" href="{{ url('/resume/'.$resumeDetails[0]->id) }}">
                        <span class="avatar avatar-lg avatar-inline margin-right border-fade">
                            @if(Auth::user()->avatar != "")
                            @if(strpos(Auth::user()->avatar,"ttp:"))
                            <img alt="" src="{{Auth::user()->avatar}}">
                            @elseif(file_exists(public_path("/uploads/images/user/".Auth::user()->avatar)))
                            <img alt="" src="/uploads/images/user/{{Auth::user()->avatar}}">
                            @else
                            <img alt="" src="/uploads/images/user/user-img-white.jpg">
                            @endif
                            @else
                            <img alt="" src="/uploads/images/user/user-img-white.jpg">
                            @endif
                        </span>
                        {{Auth::user()->name}}
                    </a>
                </div>
                @endif
                <div class="menu-top-info-sub">
                    <a href="{{URL::to('user/profile-image')}}">
                        <i class="material-icons font-inherit grey-text">photo_camera</i>
                        <span>Change / Upload photo</span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="menu-content margin-top-no">
                <ul class="nav">
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/settings') }}"><i class="material-icons icon-lg margin-right grey-text">settings</i>
                            Settings</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{URL::to('/change-password')}}"><i class="material-icons icon-lg margin-right grey-text">lock</i>
                            Change password</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{URL::to('/logout')}}"><i class="material-icons icon-lg margin-right grey-text">power_settings_new</i>
                            Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif

<!-- User Image Upload Modal -->
<div id="imageUploadModal" class="modal fade" role="dialog" style="z-index:999">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="float:right">&times;</button>
                <h4 class="modal-title">Change / Upload Image</h4>
            </div>
            <div class="modal-body">
                <div id="fileuploader">Upload</div>
                <input type="hidden" id="uploadImageName" value="">
                <input type="hidden" id="uploadOrignalName" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" id="save-avatar">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>

<div id="resume-actions" class="resume-actions-modal menu-popup modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Resume update required</h4>
            <a href="javascript:void(0)" class="modal-close waves-effect close-btn"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-body">
            <ul class="popup-menu-list">
                <li class="text-center"><a href="#">Go for resume update</a></li>
                <li class="text-center">
                    <p>
                        With GDPT we all need to comply understand GDPR act released by UK
                    </p>
                </li>
                <li>
                    <div class="input-field custom-form popup-emptyp">
                        <select id="employementType" name="employementType" required data-msg="Employement type required">
                            <option value="">Select Level</option>
                            <option value="1">Full time</option>
                            <option value="2">Time</option>
                            <option value="3">Full time</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="row mb0 popup-yr">
                        <div class="col s4 pl0 pr0">
                            <div class="input-field">
                                <select id="ddStart" name="ddStart" ng-model="ddStart">
                                    <option value="" selected>DD</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s4 pr0">
                            <div class="input-field">
                                <select id="mmStart" name="mmStart" data-msg="Required" required>
                                    <option value="" selected>MM</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s4 pr0">
                            <div class="input-field">
                                <select id="yyyyStart" name="yyyyStart" data-msg="Required" required>
                                    <option value="" selected>YYYY</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="">
                        <input type="text" class="m-0" placeholder="Search">
                    </div>
                </li>
                <li>
                    <ul class="reset-list-style">
                        <li class="display-inline">
                            <input class="with-gap" name="option" type="radio" id="option1" checked>
                            <label for="option1">Male </label>
                        </li>
                        <li class="display-inline">
                            <input class="with-gap" name="option" type="radio" id="option2">
                            <label for="option2">Female </label>
                        </li>
                    </ul>
                </li>
                <li>
                    <ul class="reset-list-style">
                        <li class="display-inline">
                            <input class="with-gap" name="checkbox" type="checkbox" id="checkbox1" value="email-option-content"
                                checked>
                            <label for="checkbox1">Select </label>
                        </li>
                        <li class="display-inline">
                            <input class="with-gap" name="checkbox" type="checkbox" id="checkbox2" value="phonenumber-option-content">
                            <label for="checkbox2">Select</label>
                        </li>
                    </ul>
                </li>
                <li class="text-center search-modal">
                    <a href="">Search</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#change-image-link").on("click", function () {
            $('.sidebar-overlay').click();
            $('.menu-close').click();
            $("#imageUploadModal").modal("show");

        });

        $("#save-avatar").on("click", function () {
            saveImage()
        });

        try {
            $("#fileuploader").uploadFile({
                url: "{{URL::to('/user/upload-file')}}",
                fileName: "tmpPic",
                acceptFiles: "image/*",
                showPreview: true,
                previewHeight: "100px",
                previewWidth: "100px",
                onSuccess: function (files, data, xhr, pd) {
                    $("#uploadImageName").val(data.filename);
                    $("#uploadOrignalName").val(data.orignalName)
                    console.log(data);
                },
            });
        } catch(e){

        }

        function saveImage() {
            $.ajax({
                url: "{{ URL::to('user/save-profile-image') }}",
                type: 'POST',
                dataType: 'html',
                data: {
                    "id": $("#imageId").val(),
                    "image": $("#uploadImageName").val(),
                    "image_orignal_name": $("#uploadOrignalName").val(),
                },
                beforeSend: function () {

                },
                success: function (data) {
                    console.log(data);
                    window.location.reload();
                },
            });
        }
    });
</script>
