<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div class="logo-src2"></div>
        <!--  <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div> -->
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-left">
            {{-- <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div> --}}
            {{-- <ul class="header-megamenu nav">
                <li class="nav-item">
                    <a class="nav-link">
                        03 / 09 / 2021 Friday
                    </a>
                </li>
            </ul> --}}
        </div>

        <div class="app-header-right">
            <div class="header-dots">
               <!-- <div class="dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                        class="p-0 mr-2 btn btn-link">
                        <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                            <span class="icon-wrapper-bg bg-primary"></span>
                            <i class="fa fa-cog"></i>
                        </span>
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true"
                        class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                        <div class="dropdown-menu-header">
                            <div class="dropdown-menu-header-inner bg-plum-plate">
                                <div class="menu-header-image"
                                    style="background-image: url('{{ asset('frontend/assets/images/dropdown-header/abstract4.jpg') }}');">
                                </div>
                                <div class="menu-header-content text-white">
                                    <h5 class="menu-header-title">Grid Dashboard</h5>
                                    <h6 class="menu-header-subtitle">Easy grid navigation inside dropdowns</h6>
                                </div>
                            </div>
                        </div>
                        <div class="grid-menu grid-menu-xl grid-menu-3col">
                            <div class="no-gutters row">
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i
                                            class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                        Automation
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i
                                            class="pe-7s-piggy icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3">
                                        </i> Reports
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i
                                            class="pe-7s-config icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3">
                                        </i> Settings
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i
                                            class="pe-7s-browser icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3">
                                        </i> Content
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i
                                            class="pe-7s-hourglass icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                        Activity
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                        <i
                                            class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3">
                                        </i> Contacts
                                    </button>
                                </div>
                            </div>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item-divider nav-item"></li>
                            <li class="nav-item-btn text-center nav-item">
                                <button class="btn-shadow btn btn-primary btn-sm">Follow-ups</button>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div class="dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                        class="p-0 mr-2 btn btn-link">
                        <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                            <span class="icon-wrapper-bg bg-danger"></span>
                            <i class="icon  icon-anim-pulse ion-android-notifications"></i>
                            <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                        </span>
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true"
                    class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                    <div class="dropdown-menu-header mb-0">
                        <div class="dropdown-menu-header-inner bg-deep-blue">
                            <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                            <div class="menu-header-content text-dark p-3">
                                <h5 class="menu-header-title">Notifications</h5>
                                <h6 class="menu-header-subtitle">You have <b>21</b> unread messages</h6>
                            </div>
                        </div>
                    </div>
                   <div class="scroll-area-sm">
                                <div class="scrollbar-container">
                                    <div class="p-3">
                                        <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                        <p>Lorem ipsum dolor sic amet, today at 
                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                                        <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Build the production release</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                            labore et dolore magna elit enim at minim veniam quis nostrud
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-primary"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title text-success">Something not important</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-success"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                                        <p>Lorem ipsum dolor sic amet, today at 
                                                            <a href="javascript:void(0);">12:00 PM</a>
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                                        <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title">Build the production release</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                            labore et dolore magna elit enim at minim veniam quis nostrud
                                                        </p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-item vertical-timeline-element">
                                                <div>
                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                        <i class="badge badge-dot badge-dot-xl badge-primary"> </i>
                                                    </span>
                                                    <div class="vertical-timeline-element-content bounce-in">
                                                        <h4 class="timeline-title text-success">Something not important</h4>
                                                        <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                                        <span class="vertical-timeline-element-date"></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  
                    <ul class="nav flex-column">
                        <li class="nav-item-divider nav-item"></li>
                        <li class="nav-item-btn text-center nav-item">
                            <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">Close all<span class="ml-2"><i class="fa fa-times-circle" aria-hidden="true"></i></span></button>
                        </li>
                    </ul>
                </div>
                </div>
            </div>

            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left header-user-info">
                            <div class="widget-heading"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                            <div class="widget-subheading"> Member Seance: {{ Auth::user()->created_at ? date('Y',strtotime(Auth::user()->created_at)) : 'N/A'}} </div>
                        </div>
                        <div class="widget-content-left ml-3">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="p-0 btn">
                                    <img width="42" class="rounded-circle"
                                        src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/assets/images/avatars/1.jpg') }}" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-info">
                                            <div class="menu-header-image opacity-2"
                                                style="background-image: url('{{ asset('frontend/assets/images/dropdown-header/city3.jpg') }}');">
                                            </div>
                                            <div class="menu-header-content text-left">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/assets/images/avatars/1.jpg') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                                            <div class="widget-subheading opacity-8">A short
                                                                profile description</div>
                                                        </div>
                                                        <div class="widget-content-right mr-2">

                                                            <a class="btn-pill btn-shadow btn-shine btn btn-focus"
                                                                href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                                                {{ __('Logout') }}
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scroll-area-xs" style="height: 150px;">
                                        <div class="scrollbar-container ps">
                                            <ul class="nav flex-column">
                                                <li class="nav-item-header nav-item">Activity</li>
                                                <li class="nav-item">
                                                    <a href="{{ route('hr.profile') }}" class="nav-link">Profile
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('hr.changePassword') }}" class="nav-link">Change
                                                        Password</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-main">