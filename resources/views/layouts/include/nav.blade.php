@if(Auth::check())
<?php $resumeDetails = DB::table("resumes")->where("ownerEmail","=",Auth::user()->email)->get(); ?>
<nav id="site_nav" class="side-nav">
    <div class="menu">
        <div class="menu-scroll">
            <div class="menu-content margin-top-no">
                <ul class="nav">
                    <li class="header">
                        <a class="nav-home" href="{{ url('/home') }}">
                            <p>WorkMedian <span>[{{Auth::user()->wmid}}]</span></p>
                            <!-- <span  class="menu-close waves-effect waves-white">
                                <i class="material-icons">close</i>
                            </span> -->
                        </a>
                    </li>

                    <li><a class="waves-effect waves-light-grey" href="{{ url('/socialmediaverification') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Social media verification</a></li>

                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/viewedbyme') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Resume Viewed By me </a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/viewedbyother') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                        Resume Viewed By Others </a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/received') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                        Resume Received By me </a></li>
                        <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/sentresumes') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Resume Sent By me </a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/requestedbyme') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                        Resume Requested By me </a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/requestedbyotheres') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                        Resume Requested By Others </a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resume/haveaccess') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                        Users can access my Resume </a></li>

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

                    <li><a class="waves-effect waves-light-grey" href="{{ url('/emailverification') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Email verification</a></li>

                    <li><a class="waves-effect waves-light-grey" href="{{ url('/resumebox') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Resume box</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/memberlist') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            WorkMedian Members(5)</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/skillshiring') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Skills hiring</a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{ url('/membersinvited') }}"><i class="material-icons grey-text  margin-right">assignment</i>
                            Members invited</a></li>


                    <li><a class="waves-effect waves-light-grey modal-trigger" href="#resume-actions"><i class="material-icons grey-text  margin-right">assignment</i>
                            Popup</a></li>
                </ul>
                <ul class="nav">
                <li><a class="waves-effect waves-light-grey" href="{{url('/terms')}}">Terms &amp; conditions </a></li>
                    <li><a class="waves-effect waves-light-grey" href="{{url('/privacy')}}">Privacy policy</a></li>
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
                    <img alt="" src="{{get_user_image(Auth::user()->avatar)}}">
                </div>
                @if(!count($resumeDetails))
                <div class="menu-top-info">
                    <a class="menu-top-user bold flow-text" href="javascript:void(0);">
                        <span class="avatar avatar-lg avatar-inline margin-right border-fade">
                            <img alt="" src="{{get_user_image(Auth::user()->avatar)}}">
                          </span>
                        {{Auth::user()->name}}
                    </a>
                </div>
                @else
                <div class="menu-top-info">
                    <a class="menu-top-user bold flow-text" href="{{ url('/resume/'.$resumeDetails[0]->id) }}">
                        <span class="avatar avatar-lg avatar-inline margin-right border-fade">
                            <img alt="" src="{{get_user_image(Auth::user()->avatar)}}">
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
