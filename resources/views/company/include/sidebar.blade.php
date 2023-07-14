<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{ route('company.home') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" class="img-fluid" alt="logo">
            <p class="logo-text" style="padding: 10px 10px 0 0;font-size: 24px;color: #4C2910;">{{ __('admin.app-name') }}</p>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="hover-circle">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul class="iq-menu">
                <li class="{{ active_link('company' , 'filter') }}">
                    <a href="{{ route('company.filter') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/company/new_guards.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.Request for new guards') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('company' , 'guards') }}">
                    <a href="{{ route('company.guards') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/guards.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.guards') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('company' , 'job-offers') }}">
                    <a href="{{ route('company.jobOffers') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/job_offers.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.job_offers') }} </span>
                    </a>
                </li>


                <li class="{{ active_link('company' , 'packages') }}">
                    <a href="{{ route('company.packages') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/company/packages.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.packages') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('company' , 'subscribe') }}">
                    <a href="{{ route('company.packages.subscribe') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/company/subscribe.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.subscribed packages') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('company' , 'conversations') }}">
                    <a href="{{ route('conversations.list') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/company/subscribe.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.conversations') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('company','technical_supports') }}">
                    <a href="{{ route('company.technical_supports') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/company/technical_supports.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.contact_us') }} </span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
