@extends('content.profiles.admin.v_main')
@section('content_profile')
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Perbarui Password
                </h3>
            </div>
        </div>
    </div>
    <form class="m-form m-form--fit m-form--label-align-right" id="formSubmit">
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">Password Lama</label>
                <div class="col-7">
                    <div class="input-group m-input-group">
                        <input type="password" class="form-control m-input"
                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="password" id="password">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary showPass" data-id="password" type="button"><i
                                    class="flaticon-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">Password Baru</label>
                <div class="col-7">
                    <div class="input-group m-input-group">
                        <input type="password" class="form-control m-input"
                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="current_password" id="current_password">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary generatePass" type="button"><i
                                    class="flaticon-refresh"></i></button>
                            <button class="btn btn-secondary showPass" data-id="current_password" type="button"><i
                                    class="flaticon-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">Konfirmasi Password</label>
                <div class="col-7">
                    <div class="input-group m-input-group">
                        <input type="password" class="form-control m-input"
                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" name="confirm_password"
                            id="confirm_passsword">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary showPass" data-id="confirm_passsword" type="button"><i
                                    class="flaticon-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-7">
                        <button type="submit" id="btnSubmit" class="btn btn-accent m-btn m-btn--air m-btn--custom">Save
                            changes</button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
            $(function() {

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    $.ajax({
                        url: "{{ route('admin.profile.update_password') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            if (data.status == true) {
                                $('#formSubmit').trigger("reset");
                                toastr.success(data.message, "Selamat");
                            } else {
                                toastr.error(data.message, "Gagal");
                            }
                            $('#btnSubmit').removeClass(
                                'm-loader m-loader--light m-loader--right');
                            $('#btnSubmit').attr("disabled", false);

                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btnSubmit').attr("disabled", false);
                        }
                    });
                });

                $('.showPass').mousedown(function() {
                    let id = $(this).data('id');
                    $('#' + id).attr('type', 'text');
                });
                $('.showPass').mouseup(function() {
                    let id = $(this).data('id');
                    $('#' + id).attr('type', 'password');
                });

                $(document).on('click', '.generatePass', function() {
                    var length = 8,
                        charset = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                        retVal = "";
                    for (var i = 0, n = charset.length; i < length; ++i) {
                        retVal += charset.charAt(Math.floor(Math.random() * n));
                    }
                    $('#current_password').val(retVal);
                });


            })
        </script>
    @endpush
@endsection
