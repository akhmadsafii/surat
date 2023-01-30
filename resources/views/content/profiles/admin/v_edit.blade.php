@extends('content.profiles.admin.v_main')
@section('content_profile')
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Edit Profil
                </h3>
            </div>
        </div>
    </div>
    <form class="m-form m-form--fit m-form--label-align-right" id="formSubmit">
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-2 col-form-label">Nama</label>
                        <div class="col-7">
                            <input class="form-control m-input" type="text" name="name"
                                value="{{ Auth::guard('admin')->user()->name }}">
                            <input type="hidden" name="id" value="{{ Auth::guard('admin')->user()->id }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-2 col-form-label">Telepon</label>
                        <div class="col-7">
                            <input class="form-control m-input" type="text" name="phone"
                                value="{{ Auth::guard('admin')->user()->phone }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-2 col-form-label">Email</label>
                        <div class="col-7">
                            <input class="form-control m-input" type="email" name="email"
                                value="{{ Auth::guard('admin')->user()->email }}">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-2 col-form-label">Gambar Profil</label>
                        <div class="col-7">
                            <input type="file" name="file" id="file" class="form-control-file"
                                onchange="readURL(this);">
                        </div>
                    </div>
                    <div class="form-group m-form__group row pt-0">
                        <label for="example-text-input" class="col-2 col-form-label"></label>
                        <div class="col-3">
                            <img id="preview-image"
                                src="{{ Auth::guard('admin')->user()->file ? asset(Auth::guard('admin')->user()->file) : 'https://via.placeholder.com/150' }}"
                                alt="Preview" class="w-100">
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    // console.log('ping');
                    e.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: '{{ route('admin.profile.update') }}',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btnSubmit').attr("disabled", false);
                        }
                    });
                });
            })

            function readURL(input, id) {
                id = id || '#preview-image';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
