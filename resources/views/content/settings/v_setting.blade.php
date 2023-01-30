@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.tagsinput.tags_input_css')
    @endpush
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{ session('title') }}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">{{ session('title') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ session('title') }}
                        </h3>
                    </div>
                </div>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="formSubmit">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label>Nama Sekolah:</label>
                            <input type="text" name="name_school" class="form-control m-input"
                                value="{{ $setting['name_school'] }}" placeholder="Nama Sekolah">
                        </div>
                        <div class="col-lg-4">
                            <label>Nama Aplikasi:</label>
                            <input type="text" class="form-control m-input" name="name_application"
                                value="{{ $setting['name_application'] }}" placeholder="Nama Aplikasi">
                        </div>
                        <div class="col-lg-4">
                            <label class="">NPSN:</label>
                            <input type="text" name="npsn" value="{{ $setting['npsn'] }}" class="form-control m-input"
                                placeholder="NPSN">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label class="">Telepon:</label>
                            <input type="text" name="phone" value="{{ $setting['phone'] }}"
                                class="form-control m-input" placeholder="Telepon">
                        </div>
                        <div class="col-lg-4">
                            <label class="">Email:</label>
                            <input type="email" name="email" value="{{ $setting['email'] }}"
                                class="form-control m-input" placeholder="Email">
                        </div>
                        <div class="col-lg-4">
                            <label class="">Website:</label>
                            <input type="text" name="website" value="{{ $setting['website'] }}"
                                class="form-control m-input" placeholder="Website">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-4">
                            <label class="">Batas Upload File (KB):</label>
                            <input type="text" name="max_upload" value="{{ $setting['max_upload'] }}"
                                class="form-control m-input" placeholder="Ukuran Maksimal Upload">
                        </div>
                        <div class="col-lg-4">
                            <label class="">Resolusi Kompress:</label>
                            <input type="text" name="size_compress" value="{{ $setting['size_compress'] }}"
                                class="form-control m-input" placeholder="Resolusi Gambar">
                        </div>
                        <div class="col-lg-4">
                            <label class="">Format Gambar Diizinkan:</label>
                            <input type="text" class="form-control m-input" name="format_image"
                                value="{{ str_replace('|', ',', $setting['format_image']) }}" data-role="tagsinput">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="">Alamat Sekolah:</label>
                                    <textarea name="address" rows="3" class="form-control m-input">{{ $setting['address'] }}</textarea>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="">Footer Aplikasi:</label>
                                    <input type="text" name="footer" value="{{ $setting['footer'] }}"
                                        class="form-control m-input" placeholder="Footer website">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="">Logo Sekolah:</label>
                                    <input type="file" onchange="readURL(this);" name="logo" class="form-control-file m-input">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <img id="preview-image" src="{{ $setting['logo'] == '' ? 'https://via.placeholder.com/150' : asset($setting['logo']) }}" alt="Preview"
                                        class="form-group w-100">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" onclick="clickSubmit()" class="btn btn-primary">Save</button>
                                <button type="button" onclick="resetForm()" class="btn btn-secondary">Batalkan</button>
                            </div>
                            <div class="col-lg-6 m--align-right">
                                <button type="button" onclick="deleteForm()" id="btn-delete"
                                    class="btn btn-danger">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        @include('package.tagsinput.tags_input_js')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    e.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: '',
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
            });

            function clickSubmit() {
                $('#formSubmit').submit();
            }

            function resetForm() {
                $('#formSubmit').trigger("reset");
            }

            function deleteForm() {
                let notify = confirm('Apakah anda yakin ingin menghapus semua data settingan');
                if (notify == true) {
                    $.ajax({
                        url: '{{ route('admin.setting.reset') }}',
                        beforeSend: function() {
                            $('#btn-delete').addClass('m-loader m-loader--light m-loader--right');
                            $('#btn-delete').attr("disabled", true);
                        },
                        success: (data) => {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btn-delete').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btn-delete').attr("disabled", false);
                        }
                    });
                }
            }

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
