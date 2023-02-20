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
                        <a href="{{ route('admin.message.inbox.disposition.create', $message['code']) }}"
                            class="btn btn-primary">
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
                        <div class="col-md-6">
                            <div class="form-group m-form__group row py-0">
                                <label class="col-lg-3 col-form-label">Nomor Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <span>{{ $message['number'] }}</span>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $message['id'] }}">
                            <div class="form-group m-form__group row py-0">
                                <label class="col-lg-3 col-form-label">Tanggal Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="date" href="#" data-type="combodate" data-viewformat="DD/MM/YYYY"
                                        data-url="{{ route('admin.message.inbox.save') }}" data-pk="{{ $message['id'] }}"
                                        class="pUpdate" data-template="D / MMM / YYYY"
                                        data-value="{{ $message['date'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row py-0">
                                <label class="col-lg-3 col-form-label">Sifat Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="nature_letter" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}" data-pk="{{ $message['id'] }}"
                                        class="pUpdate" data-source="['biasa', 'terbatas', 'rahasia', 'sangat_rahasia']"
                                        data-value="{{ $message['nature_letter'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row py-0">
                                <label class="col-lg-3 col-form-label">Urgensi Surat:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="urgency_letter" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}" data-pk="{{ $message['id'] }}"
                                        class="pUpdate" data-source="['biasa', 'segera', 'sangat_segera']"
                                        data-value="{{ $message['urgency_letter'] }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row py-0">
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
                            <div class="form-group m-form__group row py-0">
                                <label class="col-lg-3 col-form-label">Tujuan:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="to_position" href="#" data-type="select"
                                        data-url="{{ route('admin.message.inbox.save') }}"
                                        data-pk="{{ $message['id'] }}" class="pUpdate"
                                        data-source="[{{ $job }}]"
                                        data-value="{{ Helper::get_job($message['to_position']) }}"></a>
                                </div>
                            </div>
                            <div class="form-group m-form__group row py-0">
                                <label class="col-lg-3 col-form-label">Perihal:</label>
                                <div class="col-lg-6 my-auto">
                                    <a data-name="regard" href="#" data-type="text"
                                        data-url="{{ route('admin.message.inbox.save') }}"
                                        data-pk="{{ $message['id'] }}" class="pUpdate" data-title=""
                                        data-value="{{ $message['regard'] }}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelect1">Dokumen Pendukung</label>
                                <input type="file" class="multi" name="doc[]">
                            </div>
                            <div class="m-list-search">
                                <div class="m-list-search__results">
                                    @foreach (json_decode($message['doc']) as $document)
                                        @php
                                            $name_doc = explode('/', $document);
                                        @endphp
                                        <div class="m-list-search__result-item d-flex">
                                            <a href="{{ route('admin.message.inbox.download', encrypt($document)) }}"
                                                target="_blank">
                                                <span class="m-list-search__result-item-icon"><i
                                                        class="flaticon-download"></i></span>
                                                <span class="m-list-search__result-item-text">{{ end($name_doc) }}</span>

                                            </a>
                                            <a href="{{ route('admin.message.inbox.delete_file', ['key' => encrypt($message['id']), 'coloumn' => 'doc', 'name' => encrypt($document)]) }}"
                                                class="ml-auto">
                                                <span class="m-list-search__result-item-icon text-danger"><i
                                                        class="flaticon-cancel"></i></span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="exampleSelect1">Dokumen Asli</label>
                                <input type="file" class="multi" name="original_file[]">
                            </div>
                            <div class="m-list-search">
                                <div class="m-list-search__results">
                                    @foreach (json_decode($message['original_file']) as $original)
                                        @php
                                            $name_file = explode('/', $original);
                                        @endphp
                                        <div class="m-list-search__result-item d-flex">
                                            <a href="{{ route('admin.message.inbox.download', encrypt($original)) }}"
                                                target="_blank">
                                                <span class="m-list-search__result-item-icon"><i
                                                        class="flaticon-download"></i></span>
                                                <span class="m-list-search__result-item-text">{{ end($name_file) }}</span>

                                            </a>
                                            <a href="{{ route('admin.message.inbox.delete_file', ['key' => encrypt($message['id']), 'coloumn' => 'original_file', 'name' => encrypt($original)]) }}"
                                                class="ml-auto">
                                                <span class="m-list-search__result-item-icon text-danger"><i
                                                        class="flaticon-cancel"></i></span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--right">
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Perbarui</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        {{-- @include('package.summernote.summernote_js') --}}
        @include('package.editables.editable_js')
        @include('package.uploadfile.uploadfile_js')
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

                $('body').on('submit', '#formSubmit', function(e) {
                    e.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.message.inbox.update') }}",
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

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.message.inbox.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            toastr.success(data.message, "Berhasil");
                            window.location.href = "{{ route('admin.message.inbox.page') }}";
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    })
                }
            }
        </script>
    @endpush
@endsection
