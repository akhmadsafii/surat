<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.admin.v_head')
</head>

<body
    class="m-content--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside--offcanvas-default">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

        <!-- BEGIN: Header -->
        <header id="m_header" class="m-grid__item m-header bg-light" m-minimize-offset="200"
            m-minimize-mobile-offset="200">
            <div class="m-container m-container--fluid m-container--full-height">
                <div class="m-stack m-stack--ver m-stack--desktop">

                    <!-- BEGIN: Brand -->
                    <div class="m-stack__item m-brand  m-brand--skin-light bg-light">
                        <div class="m-stack m-stack--ver m-stack--general m-stack--fluid">
                            <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                <a href="index.html" class="m-brand__logo-wrapper d-flex">
                                    <img alt="" src="{{ asset(env('CONFIG_LOGO')) }}" style="height: 52px" class="mr-1" />
                                    <h2 class="d-inline-flex my-auto ml-1" style="width: max-content;">{{ env('CONFIG_NAME_APPLICATION') }}</h2>
                                </a>
                            </div>
                            <div class="m-stack__item m-stack__item--middle m-brand__tools">

                                <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                    <span></span>
                                </a>

                                <!-- END -->

                                <!-- BEGIN: Topbar Toggler -->
                                <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                    <i class="flaticon-more"></i>
                                </a>

                                <!-- BEGIN: Topbar Toggler -->
                            </div>
                        </div>
                    </div>

                    <!-- END: Brand -->
                    <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                        <!-- BEGIN: Topbar -->
                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                            <div class="m-stack__item m-topbar__nav-wrapper">
                                <ul class="m-topbar__nav m-nav m-nav--inline">
                                    <li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                        m-dropdown-toggle="click" m-dropdown-persistent="1">
                                        <a href="#" class="m-nav__link m-dropdown__toggle"
                                            id="m_topbar_notification_icon">
                                            <span class="m-nav__link-icon">
                                                <span class="m-nav__link-icon-wrapper"><i
                                                        class="flaticon-alarm"></i></span>
                                                <span class="m-nav__link-badge m-badge m-badge--success">3</span>
                                            </span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center">
                                                    <span class="m-dropdown__header-title">9 New</span>
                                                    <span class="m-dropdown__header-subtitle">User Notifications</span>
                                                </div>
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand"
                                                            role="tablist">
                                                            <li class="nav-item m-tabs__item">
                                                                <a class="nav-link m-tabs__link active"
                                                                    data-toggle="tab"
                                                                    href="#topbar_notifications_notifications"
                                                                    role="tab">
                                                                    Alerts
                                                                </a>
                                                            </li>
                                                            <li class="nav-item m-tabs__item">
                                                                <a class="nav-link m-tabs__link" data-toggle="tab"
                                                                    href="#topbar_notifications_events"
                                                                    role="tab">Events</a>
                                                            </li>
                                                            <li class="nav-item m-tabs__item">
                                                                <a class="nav-link m-tabs__link" data-toggle="tab"
                                                                    href="#topbar_notifications_logs"
                                                                    role="tab">Logs</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active"
                                                                id="topbar_notifications_notifications" role="tabpanel">
                                                                <div class="m-scrollable" data-scrollable="true"
                                                                    data-height="250" data-mobile-height="200">
                                                                    <div
                                                                        class="m-list-timeline m-list-timeline--skin-light">
                                                                        <div class="m-list-timeline__items">
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                                                <span class="m-list-timeline__text">12
                                                                                    new users registered</span>
                                                                                <span class="m-list-timeline__time">Just
                                                                                    now</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge"></span>
                                                                                <span
                                                                                    class="m-list-timeline__text">System
                                                                                    shutdown <span
                                                                                        class="m-badge m-badge--success m-badge--wide">pending</span></span>
                                                                                <span class="m-list-timeline__time">14
                                                                                    mins</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge"></span>
                                                                                <span class="m-list-timeline__text">New
                                                                                    invoice received</span>
                                                                                <span class="m-list-timeline__time">20
                                                                                    mins</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge"></span>
                                                                                <span class="m-list-timeline__text">DB
                                                                                    overloaded 80% <span
                                                                                        class="m-badge m-badge--info m-badge--wide">settled</span></span>
                                                                                <span class="m-list-timeline__time">1
                                                                                    hr</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge"></span>
                                                                                <span
                                                                                    class="m-list-timeline__text">System
                                                                                    error - <a href="#"
                                                                                        class="m-link">Check</a></span>
                                                                                <span class="m-list-timeline__time">2
                                                                                    hrs</span>
                                                                            </div>
                                                                            <div
                                                                                class="m-list-timeline__item m-list-timeline__item--read">
                                                                                <span
                                                                                    class="m-list-timeline__badge"></span>
                                                                                <span href=""
                                                                                    class="m-list-timeline__text">New
                                                                                    order received <span
                                                                                        class="m-badge m-badge--danger m-badge--wide">urgent</span></span>
                                                                                <span class="m-list-timeline__time">7
                                                                                    hrs</span>
                                                                            </div>
                                                                            <div
                                                                                class="m-list-timeline__item m-list-timeline__item--read">
                                                                                <span
                                                                                    class="m-list-timeline__badge"></span>
                                                                                <span
                                                                                    class="m-list-timeline__text">Production
                                                                                    server down</span>
                                                                                <span class="m-list-timeline__time">3
                                                                                    hrs</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge"></span>
                                                                                <span
                                                                                    class="m-list-timeline__text">Production
                                                                                    server up</span>
                                                                                <span class="m-list-timeline__time">5
                                                                                    hrs</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="topbar_notifications_events"
                                                                role="tabpanel">
                                                                <div class="m-scrollable" data-scrollable="true"
                                                                    data-height="250" data-mobile-height="200">
                                                                    <div
                                                                        class="m-list-timeline m-list-timeline--skin-light">
                                                                        <div class="m-list-timeline__items">
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                                <a href=""
                                                                                    class="m-list-timeline__text">New
                                                                                    order received</a>
                                                                                <span
                                                                                    class="m-list-timeline__time">Just
                                                                                    now</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
                                                                                <a href=""
                                                                                    class="m-list-timeline__text">New
                                                                                    invoice received</a>
                                                                                <span class="m-list-timeline__time">20
                                                                                    mins</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                                <a href=""
                                                                                    class="m-list-timeline__text">Production
                                                                                    server up</a>
                                                                                <span class="m-list-timeline__time">5
                                                                                    hrs</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                                <a href=""
                                                                                    class="m-list-timeline__text">New
                                                                                    order received</a>
                                                                                <span class="m-list-timeline__time">7
                                                                                    hrs</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                                <a href=""
                                                                                    class="m-list-timeline__text">System
                                                                                    shutdown</a>
                                                                                <span class="m-list-timeline__time">11
                                                                                    mins</span>
                                                                            </div>
                                                                            <div class="m-list-timeline__item">
                                                                                <span
                                                                                    class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
                                                                                <a href=""
                                                                                    class="m-list-timeline__text">Production
                                                                                    server down</a>
                                                                                <span class="m-list-timeline__time">3
                                                                                    hrs</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="topbar_notifications_logs"
                                                                role="tabpanel">
                                                                <div class="m-stack m-stack--ver m-stack--general"
                                                                    style="min-height: 180px;">
                                                                    <div
                                                                        class="m-stack__item m-stack__item--center m-stack__item--middle">
                                                                        <span class="">All caught up!<br>No new
                                                                            logs.</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="m-nav__item m-topbar__quick-actions m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        m-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
                                            <span class="m-nav__link-icon">
                                                <span class="m-nav__link-icon-wrapper"><i
                                                        class="flaticon-share"></i></span>
                                                <span class="m-nav__link-badge m-badge m-badge--brand">5</span>
                                            </span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span
                                                class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center">
                                                    <span class="m-dropdown__header-title">Quick Actions</span>
                                                    <span class="m-dropdown__header-subtitle">Shortcuts</span>
                                                </div>
                                                <div class="m-dropdown__body m-dropdown__body--paddingless">
                                                    <div class="m-dropdown__content">
                                                        <div class="m-scrollable" data-scrollable="false"
                                                            data-height="380" data-mobile-height="200">
                                                            <div class="m-nav-grid m-nav-grid--skin-light">
                                                                <div class="m-nav-grid__row">
                                                                    <a href="#" class="m-nav-grid__item">
                                                                        <i class="m-nav-grid__icon flaticon-file"></i>
                                                                        <span class="m-nav-grid__text">Generate
                                                                            Report</span>
                                                                    </a>
                                                                    <a href="#" class="m-nav-grid__item">
                                                                        <i class="m-nav-grid__icon flaticon-time"></i>
                                                                        <span class="m-nav-grid__text">Add New
                                                                            Event</span>
                                                                    </a>
                                                                </div>
                                                                <div class="m-nav-grid__row">
                                                                    <a href="#" class="m-nav-grid__item">
                                                                        <i
                                                                            class="m-nav-grid__icon flaticon-folder"></i>
                                                                        <span class="m-nav-grid__text">Create New
                                                                            Task</span>
                                                                    </a>
                                                                    <a href="#" class="m-nav-grid__item">
                                                                        <i
                                                                            class="m-nav-grid__icon flaticon-clipboard"></i>
                                                                        <span class="m-nav-grid__text">Completed
                                                                            Tasks</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                        m-dropdown-toggle="click">
                                        <a href="#" class="m-nav__link m-dropdown__toggle">
                                            <span class="m-topbar__userpic">
                                                <img src="{{ asset('asset/img/user4.jpg') }}"
                                                    class="m--img-rounded m--marginless m--img-centered"
                                                    alt="" />
                                            </span>
                                            <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                                                <span class="m-nav__link-icon-wrapper"><i
                                                        class="flaticon-user-ok"></i></span>
                                            </span>
                                            <span class="m-topbar__username m--hide">Nick</span>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span
                                                class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__header m--align-center">
                                                    <div class="m-card-user m-card-user--skin-light">
                                                        <div class="m-card-user__pic">
                                                            <img src="{{ Auth::guard('admin')->user()->name ? asset(Auth::guard('admin')->user()->file) : asset('asset/img/user4.jpg') }}"
                                                                class="m--img-rounded m--marginless" alt="" />
                                                        </div>
                                                        <div class="m-card-user__details">
                                                            <span class="m-card-user__name m--font-weight-500">Mark
                                                                Andre</span>
                                                            <a href=""
                                                                class="m-card-user__email m--font-weight-300 m-link">mark.andre@gmail.com</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav m-nav--skin-light">
                                                            <li class="m-nav__section m--hide">
                                                                <span class="m-nav__section-text">Section</span>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                    <span class="m-nav__link-title">
                                                                        <span class="m-nav__link-wrap">
                                                                            <span class="m-nav__link-text">My
                                                                                Profile</span>
                                                                            <span class="m-nav__link-badge"><span
                                                                                    class="m-badge m-badge--success">2</span></span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                                    <span class="m-nav__link-text">Activity</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                    <span class="m-nav__link-text">Messages</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit">
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                                    <span class="m-nav__link-text">FAQ</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="profile.html" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                    <span class="m-nav__link-text">Support</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit">
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="snippets/pages/user/login-1.html"
                                                                    class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- END: Topbar -->
                    </div>
                </div>
            </div>
        </header>

        <!-- END: Header -->

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-light " id="m_aside_left_close_btn"><i
                    class="la la-close"></i></button>
            <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-light ">
                @include('layout.admin.v_sidebar')
            </div>

            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <!-- END: Subheader -->
                <div class="m-content">
                    @yield('content')
                </div>
            </div>
        </div>
        @stack('modals')
        <footer class="m-grid__item		m-footer ">
            <div class="m-container m-container--fluid m-container--full-height m-page__container">
                <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                    <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                        <span class="m-footer__copyright">
                            2017 &copy; Metronic theme by <a href="https://keenthemes.com"
                                class="m-link">Keenthemes</a>
                        </span>
                    </div>
                    <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                        <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">About</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">Privacy</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">T&C</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <span class="m-nav__link-text">Purchase</span>
                                </a>
                            </li>
                            <li class="m-nav__item m-nav__item--last">
                                <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center"
                                    data-placement="left">
                                    <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- end::Footer -->
    </div>



    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    @include('layout.admin.v_foot')
</body>

</html>
