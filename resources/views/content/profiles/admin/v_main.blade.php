@extends('layout.admin.v_main')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Inner Page</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Resources</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Timesheet</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Your Profile
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper border-0">
                                    <img src="{{ Auth::guard('admin')->user()->file ? asset(Auth::guard('admin')->user()->file) : asset('asset/img/user4.jpg') }}" alt="" />
                                    <img src="../assets/app/media/img/users/user4.jpg" alt="" />
                                </div>
                            </div>
                            <div class="m-card-profile__details">
                                <span class="m-card-profile__name text-capitalize">
                                    @if (Auth::guard('admin')->check())
                                        {{ Auth::guard('admin')->user()->name }}
                                    @elseif(Auth::guard('user')->check())
                                        {{ Auth::guard('user')->user()->name }}
                                    @endif
                                </span>
                                <a href="" class="m-card-profile__email m-link">
                                    @if (Auth::guard('admin')->check())
                                        {{ Auth::guard('admin')->user()->email }}
                                    @elseif(Auth::guard('user')->check())
                                        {{ Auth::guard('user')->user()->email }}
                                    @endif
                                </a>
                            </div>
                        </div>
                        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                            <li class="m-nav__separator m-nav__separator--fit"></li>
                            <li class="m-nav__section m--hide">
                                <span class="m-nav__section-text">Section</span>
                            </li>
                            <li class="m-nav__item">
                                <a href="{{ route('admin.profile.page', ['information' => 'detail']) }}" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                    <span class="m-nav__link-title">
                                        <span class="m-nav__link-wrap">
                                            <span class="m-nav__link-text">Informasi Saya</span>
                                            <span class="m-nav__link-badge"><span
                                                    class="m-badge m-badge--success">2</span></span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="{{ route('admin.profile.page', ['information' => 'edit']) }}" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-list"></i>
                                    <span class="m-nav__link-text">Edit</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="{{ route('admin.profile.page', ['information' => 'reset-password']) }}" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-lock"></i>
                                    <span class="m-nav__link-text">Perbarui Password</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="{{ route('admin.profile.page', ['information' => 'reset-password']) }}" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-close"></i>
                                    <span class="m-nav__link-text">Tutup Akun</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    @yield('content_profile')
                </div>
            </div>
        </div>
    </div>
@endsection
