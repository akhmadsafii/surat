@extends('content.profiles.admin.v_main')
@section('content_profile')
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Detail Informasi
                </h3>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="m_user_profile_tab_1">
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">Nama :</label>
                        <div class="col-lg-6">
                            <p class="form-control-static my-2">{{ Auth::guard('admin')->user()->name }}</p>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">Telepon :</label>
                        <div class="col-lg-6">
                            <p class="form-control-static my-2">{{ Auth::guard('admin')->user()->phone }}</p>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">Email :</label>
                        <div class="col-lg-6">
                            <p class="form-control-static my-2">{{ Auth::guard('admin')->user()->email }}</p>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">IP Terakhir :</label>
                        <div class="col-lg-6">
                            <p class="form-control-static my-2">{{ Auth::guard('admin')->user()->last_ip ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">Login Terakhir :</label>
                        <div class="col-lg-6">
                            <p class="form-control-static my-2">{{ Auth::guard('admin')->user()->last_login ? DateHelper::getHoursMinute(Auth::guard('admin')->user()->last_login) : '-' }}</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-7">
                                <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save
                                    changes</button>&nbsp;&nbsp;
                                <button type="reset"
                                    class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </form>
        </div>
    </div>
@endsection
