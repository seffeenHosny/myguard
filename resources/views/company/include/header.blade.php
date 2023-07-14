<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <div class="iq-sidebar-logo">
            <div class="top-logo">
                <a href="index.html" class="logo">
                    <img src="{{ asset('assets/plugins/vito/images/logo.gif') }}" class="img-fluid" alt="">
                    <span>vito</span>
                </a>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                    <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item">
                        <a class="search-toggle iq-waves-effect language-title" href="#">
                            @if (auth()->user()->lang == 'ar')
                                <img src="{{ asset('assets/images/egypt.png') }}" style="width: 18px ; height: 20px;"
                                    alt="img-flaf" class="img-fluid mr-2" />
                                عربي
                            @else
                                <img src="{{ asset('assets/plugins/vito/images/small/flag-01.png') }}"
                                    style="width: 18px ; height: 20px;" alt="img-flaf" class="img-fluid mr-2" />
                                English
                            @endif
                            <i class="ri-arrow-down-s-line"></i>
                        </a>
                        <div class="iq-sub-dropdown">
                            <a class="iq-sub-card" href="{{ route('company.settings.changelang', 'ar') }}">
                                <img src="{{ asset('assets/images/egypt.png') }}" style="width: 16px" alt="img-flaf"
                                    class="img-fluid mr-2" />
                                Arabic
                            </a>
                            <a class="iq-sub-card" href="{{ route('company.settings.changelang', 'en') }}">
                                <img src="{{ asset('assets/plugins/vito/images/small/flag-01.png') }}"
                                    style="width: 16px" alt="img-flaf" class="img-fluid mr-2" />
                                English
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="search-toggle iq-waves-effect position-relative">
                            <div id="lottie-beil"></div>
                            <span class="bg-danger dots"></span>
                            <span class="notifaionCount count-of-notification">{{ count(getUserNotifications()) }}</span>
                        </a>
                        <div class="iq-sub-dropdown" style="max-height: 300px;overflow-y: auto">
                            <div class="iq-card shadow-none m-0" >
                                <div class="iq-card-body p-0 " >
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">
                                            @lang('admin.All Notifications')
                                            <small class="badge  badge-light float-right pt-1 count-of-notification">
                                                {{ count(getUserNotifications()) }}
                                            </small>
                                        </h5>
                                        @if(count(getUserNotifications()) > 0)
                                        <a class="read_all_notifications" style="cursor: pointer">@lang('admin.read all')</a>
                                        @endif
                                    </div>
                                    @foreach (getUserNotifications() as $notifiction )
                                    <a href="#" class="iq-sub-card notification_item" data-id="{{ $notifiction->id }}">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="{{ asset('assets/images/logo.svg') }}" alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">{{ $notifiction->notification->title }}</h6>
                                                <small class="float-right font-size-12">{{ date('h:i Y-m-d ' , strToTime($notifiction->created_at)) }}</small>
                                                <p class="mb-0">{{ $notifiction->notification->message }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a href="{{ route('chat') }}" class="search-toggle iq-waves-effect">
                            <div id="lottie-mail"></div>
                            <span class="bg-primary count-mail"></span>
                        </a>
                    </li> --}}
                </ul>
            </div>
            <ul class="navbar-list">
                <li>
                    <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        @if (!empty(auth()->user()->image))
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" class="img-fluid rounded mr-3"
                                alt="user">
                        @else
                            <img src="{{ asset('assets/imgs/avatar.png') }}"
                                class="img-fluid rounded mr-3" alt="user">
                        @endif
                        <div class="caption">
                            <h6 class="mb-0 line-height">{{ auth()->user()->name }}</h6>
                        </div>
                    </a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">{{ auth()->user()->name }}</h5>
                                </div>
                                <a href="{{ route('company.profile') }}" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">{{ trans('admin.user-profile') }} </h6>
                                            <p class="mb-0">{{ trans('admin.user-profile-details') }}</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('company.update.password') }}" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                        <div class="rounded iq-card-icon iq-bg-primary">
                                            <i class="ri-file-user-line"></i>
                                        </div>
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 ">{{ trans('admin.password') }} </h6>
                                            <p class="mb-0">{{ trans('admin.update_password') }}</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn"
                                        onclick="document.getElementById('submit-form').submit()" href="#"
                                        role="button">
                                        {{ trans('admin.logout') }}
                                        <i class="ri-login-box-line ml-2"></i>
                                    </a>
                                    <form id="submit-form" method="POST" action="{{ route('company.logout') }}">
                                        @csrf
                                        <a href="{{ route('company.logout') }}" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

    </div>
</div>
