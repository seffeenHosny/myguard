<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{ url('/') }}">
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
                @if (Auth::user()->type == 'super_admin')
                    <li class="{{ active_link('users') }}">
                        <a href="{{ route('users.index') }}" class="iq-waves-effect">
                            <img src="{{ asset('assets/images/icons/users.svg') }}" class="images-sidebar" />
                            <span> {{ trans('admin.users') }} </span>
                        </a>
                    </li>
                @endif

                <li class="{{ active_link('companies') }}">
                    <a href="{{ route('companies.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/companies.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.companies') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('guards') }}">
                    <a href="{{ route('guards.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/guards.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.guards') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('jobs') }}">
                    <a href="{{ route('jobs.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/job_offers.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.job_offers') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('cities') }}">
                    <a href="{{ route('cities.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/cities.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.cities') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('districts') }}">
                    <a href="{{ route('districts.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/districts.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.districts') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('jop_conditions') }}">
                    <a href="{{ route('jop_conditions.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/job_conditions.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.jop_conditions') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('company_types') }}">
                    <a href="{{ route('company_types.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/company_types.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.company_types') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('company_packages') }}">
                    <a href="{{ route('company_packages.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/company_packages.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.company_packages') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('guard_packages') }}">
                    <a href="{{ route('guard_packages.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/guard_packages.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.guard_packages') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('news') }}">
                    <a href="{{ route('news.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/news.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.news') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('notifications') }}">
                    <a href="{{ route('notifications.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/notifications.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.notifications') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('transactions') }}">
                    <a href="{{ route('transactions.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/transactions.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.transactions') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('contact_us') }}">
                    <a href="{{ route('contact_us.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/contact_us.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.contact_us') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('contact_reasons') }}">
                    <a href="{{ route('contact_reasons.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/contact_reasons.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.contact_reasons') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('work_natures') }}">
                    <a href="{{ route('work_natures.index') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/work_natures.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.work_natures') }} </span>
                    </a>
                </li>

                <li class="{{ active_link('settings') }}">
                    <a href="{{ route('settings') }}" class="iq-waves-effect">
                        <img src="{{ asset('assets/images/icons/settings.svg') }}" class="images-sidebar" />
                        <span> {{ trans('admin.settings') }} </span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
