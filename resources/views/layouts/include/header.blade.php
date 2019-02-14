<body>
    <header class="z-depth-0 header">
        <div class="container">
            <div class="row mb0">
                <div class="col s12">
                    @if(Auth::check())
                    <a href="#" data-activates="site_nav" class="button-collapse waves-effect main-menu-icon">
                        <i class="material-icons">menu</i>
                    </a>
                    @endif
                    <a href="{{URL::to('home')}}" class="logo-text">
                        WorkMedian
                    </a>
                    @if(Auth::check())
                    <ul class="auth-list">
                        <li>
                            <a href="javascript:void(0)" class="sidebar-toggle waves-effect dark">
                                <span class="avatar avatar-menu">
<!--                                    <img alt="" src="{{ url('assets/images/icons-customer.png') }}">-->
                                @if(Auth::user()->avatar != "")
                                    @if(strpos(Auth::user()->avatar,"ttp"))
                                        <img alt="" src="{{Auth::user()->avatar}}">
                                    @elseif(file_exists(public_path("/uploads/images/user/".Auth::user()->avatar)))
                                        <img alt="" src="{{uploads_url('images/user/')}}/{{Auth::user()->avatar}}">
                                    @else
                                        <img alt="" src="{{uploads_url('images/user/user-img-white.jpg')}}">
                                    @endif
                                @else
                                    <i class="material-icons">account_box</i>
                                @endif
                                </span>
                            </a>
                        </li>
                        <li style="display:none;">
                            <a href="login.php" class="waves-effect btn-google btn-block box-shadow-no bg-gplus btn-hsin">Logout</a>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </header>
