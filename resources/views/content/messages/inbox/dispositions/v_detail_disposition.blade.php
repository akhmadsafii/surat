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
                                {{ session('title') }}
                            </h3>
                            <p class="my-0">{{ $message['number'] }}</p>
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
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Pemberi Disposisi:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ Helper::get_job($message['to_position']) }}</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Tanggal Disposisi:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ DateHelper::getTanggal($disposition['date']) }}</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Isi Disposisi:</label>
                            <div class="col-lg-7 my-auto">
                                @foreach ($disposition['instruction'] as $ins)
                                    <p class="d-flex justify-content-between">{{ $ins }} <i
                                            class="la la-check-circle text-primary"></i></p>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Catatan Disposisi:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ $disposition['other_instruction'] }}</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Penerima Disposisi:</label>
                            <div class="col-lg-7 my-auto">
                                @foreach ($message['received'] as $rcv)
                                    <p>{{ $rcv }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Nomor Surat:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ $message['number'] }}</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Tanggal Surat:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ DateHelper::getTanggal($message['date']) }}</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Perihal Surat:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ $message['regard'] }}</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Sifat Surat:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ $message['nature_letter'] }}</span>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-5 col-form-label">Urgensi Surat:</label>
                            <div class="col-lg-7 my-auto">
                                <span>{{ $message['urgency_letter'] }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 text-center">
                                <label for="">Dokumen Pendukung</label>
                                <br>
                                <img src="{{ asset('asset/img/user4.jpg') }}" alt="">
                            </div>
                            <div class="col-lg-6 text-center">
                                <label for="">Dokumen Asli</label>
                                <br>
                                <img src="{{ asset('asset/img/user4.jpg') }}" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet">


            <div class="m-portlet__body p-4">
                <form class="m-form m-form--fit m-form--label-align-right" id="formSubmit">
                    <div class="d-flex justify-content-between my-2">
                        <b>Tanggapan</b>
                        <div class="m-checkbox-list">
                            <label class="m-checkbox m-checkbox--bold">
                                <input type="checkbox" name="status_preview" value="0"> Tidak Bisa dilihat orang
                                lain
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="card rounded mb-3">
                        <div class="card-header">
                            <input type="hidden" name="id_message" value="{{ $message['id'] }}">
                            <textarea name="chat" id="m_summernote_1" rows="4" class="form-control summernote"></textarea>
                            <div class="d-flex">
                                <button class="btn btn-success px-4 py-1 mt-2" type="submit"
                                    id="btnSubmit">Post</button>
                            </div>
                        </div>
                    </div>
                </form>
                @foreach ($chats as $ct)
                    <div class="card rounded mb-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="img-xs rounded-circle" src="{{ $ct['image'] }}" width="60"
                                        alt="">
                                    <div class="ml-2">
                                        <p>{{ $ct['name'] }}</p>
                                        <p class="tx-11 mb-0 text-muted">{{ $ct['time'] }}</p>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <span class="dropdown">
                                        <a href="#"
                                            class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                                            data-toggle="dropdown" aria-expanded="true">
                                            <i class="la la-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)"
                                                onclick="editData(' . $row['id'] . ')"><i class="la la-edit"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                                onclick="deleteData({{ $ct['id'] }})"><i class="la la-trash"></i>
                                                Hapus</a>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-3 tx-14">{!! $ct['chat'] !!}
                            </p>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex post-actions">
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-heart icon-md">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <p class="d-none d-md-block ml-2 my-auto">Like</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-message-square icon-md">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                        </path>
                                    </svg>
                                    <p class="d-none d-md-block ml-2 my-auto">Comment</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-share icon-md">
                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                        <polyline points="16 6 12 2 8 6"></polyline>
                                        <line x1="12" y1="2" x2="12" y2="15">
                                        </line>
                                    </svg>
                                    <p class="d-none d-md-block ml-2 my-auto">Share</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

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

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    $.ajax({
                        url: '{{ route('admin.message.chat.store') }}',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            toastr.success(data.message, "Berhasil");
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $(btnSubmit).removeClass('m-loader m-loader--light m-loader--right');
                            $(btnSubmit).attr("disabled", false);
                        }
                    });
                });


                // $("#btnSubmit").click(function(e) {
                //     $('#formSubmit').submit();
                // });
            })

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.message.chat.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            toastr.success(data.message, "Berhasil");
                            window.location.reload();
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
