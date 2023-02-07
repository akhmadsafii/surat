@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.editables.editable_css')
    @endpush
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <button class="btn btn-secondary">
                    <i class="la la-angle-left"></i> Kembali
                </button>
            </div>
        </div>
    </div>
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Surat</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Surat Masuk</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Detail Surat</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="javascript:void(0)" onclick="deleteData({{ $message['id'] }})" class="btn btn-danger">
                            <i class="la la-trash"></i> Hapus
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="btn btn-success">
                            <i class="la la-check-circle"></i> Konfirmasi
                        </a>
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ route('admin.message.inbox.disposition.create', $message['code']) }}" class="btn btn-primary">
                            <i class="la la-mail-forward"></i> Disposisi

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li>
                            <h3 class="m-portlet__head-text">
                                Surat Masuk
                            </h3>
                            <p class="my-0">12.010/DP-KM/IX/2022</p>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                        <li class="m-portlet__nav-item">
                            <span class="m-badge  m-badge--primary m-badge--wide">Proses</span>
                        </li>
                    </ul>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-map-marker"></i>
                                    <span>Track Surat</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right" id="formSubmit">
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Nomor Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <span>{{ $message['number'] }}</span>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Tanggal Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="date" href="#" data-type="combodate" data-viewformat="DD/MM/YYYY"
                                        data-url="{{ route('admin.message.inbox.save') }}" data-pk="{{ $message['id'] }}"
                                        class="pUpdate" data-template="D / MMM / YYYY"
                                        data-value="{{ $message['date'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Sifat Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="nature_letter" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}" data-pk="{{ $message['id'] }}"
                                        class="pUpdate" data-source="['biasa', 'terbatas', 'rahasia', 'sangat_rahasia']"
                                        data-value="{{ $message['nature_letter'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Urgensi Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="urgency_letter" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}" data-pk="{{ $message['id'] }}"
                                        class="pUpdate" data-source="['biasa', 'segera', 'sangat_segera']"
                                        data-value="{{ $message['urgency_letter'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Klasifikasi Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="classification" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}"
                                        data-pk="{{ $message['id'] }}" class="pUpdate"
                                        data-source="['eksternal', 'internal']"
                                        data-value="{{ $message['classification'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Klasifikasi Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="classification" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}"
                                        data-pk="{{ $message['id'] }}" class="pUpdate"
                                        data-source="['eksternal', 'internal']"
                                        data-value="{{ $message['classification'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Dari:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="from" href="#" data-type="text"
                                        data-url="{{ route('admin.message.inbox.save') }}"
                                        data-pk="{{ $message['id'] }}" class="pUpdate" data-title=""
                                        data-value="{{ $message['from'] }}"></a>
                                </div>
                            </div>
                            @php
                                $job = implode(', ', $position);
                            @endphp
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Tujuan:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="to_position" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}"
                                        data-pk="{{ $message['id'] }}" class="pUpdate"
                                        data-source="[{{ $job }}]"
                                        data-value="{{ $message['to_position'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-3 col-form-label">Perihal:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="regard" href="#" data-type="text"
                                        data-url="{{ route('admin.message.inbox.save') }}"
                                        data-pk="{{ $message['id'] }}" class="pUpdate" data-title=""
                                        data-value="{{ $message['regard'] }}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Dokumen Pendukung 1</label>
                                <input type="file" name="doc_1" id="doc_1" class="form-control-file">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Dokumen Pendukung 2</label>
                                <input type="file" name="doc_2" id="doc_2" class="form-control-file">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Dokumen Pendukung 3</label>
                                <input type="file" name="doc_3" id="doc_3" class="form-control-file">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        @include('package.summernote.summernote_js')
        @include('package.editables.editable_js')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.fn.editable.defaults.mode = 'inline';
                $('.pUpdate').editable({

                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return 'Value is required.';
                        }
                    },
                    send: 'always',
                    ajaxOptions: {
                        dataType: 'json'
                    }
                });

                // $('body').on('submit', '#formSubmit', function(e) {
                //     e.preventDefault();
                //     $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                //     $('#btnSubmit').attr("disabled", true);
                //     var formData = new FormData(this);
                //     $.ajax({
                //         type: "POST",
                //         url: "{{ route('admin.message.inbox.store') }}",
                //         data: formData,
                //         cache: false,
                //         contentType: false,
                //         processData: false,
                //         success: (data) => {
                //             $('#formSubmit').trigger("reset");
                //             $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                //             $('#btnSubmit').attr("disabled", false);
                //         },
                //         error: function(data) {
                //             const res = data.responseJSON;
                //             toastr.error(res.message, "GAGAL");
                //             $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                //             $('#btnSubmit').attr("disabled", false);
                //         }
                //     });
                // });

            })

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.message.inbox.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            toastr.success(data.message, "Berhasil");
                            window.location.href = "{{ route('admin.message.inbox.page')}}";
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    })
                }
            }

            function readURL(input, id) {
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
