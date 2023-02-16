@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        <style>
            @media (min-width: 1025px) {
                .m-body .m-content {
                    padding-top: 0px !important;
                }
            }
        </style>
    @endpush
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-form__heading-title">{{ session('title') }}</h3>
                </div>
            </div>
        </div>
        <form class="m-form m-form--fit m-form--label-align-right" id="formSubmit">
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Sifat Surat</label>
                            <select name="nature_letter" id="nature_letter" class="form-control">
                                <option value="" selected disabled>Pilih Sifat Surat</option>
                                <option value="biasa">Biasa</option>
                                <option value="terbatas">Terbatas</option>
                                <option value="rahasia">Rahasia</option>
                                <option value="sangat_rahasia">Sangat Rahasia</option>
                            </select>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Jenis Surat</label>
                            <select name="type" id="type" class="form-control">
                                <option value="" selected disabled>Pilih Jenis Surat</option>
                                @foreach ($type as $tp)
                                    <option value="{{ $tp['id'] }}">{{ $tp['code_type'] . ' - ' . $tp['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Nomor Surat</label>
                            <input type="text" class="form-control" name="number"
                                {{ request()->segment(3) == 'outbox' ? 'readonly' : '' }}>
                            @if (request()->segment(3) == 'outbox')
                                <span class="m-form__help">akan terisi otomatis</span>
                            @endif
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Perihal</label>
                            <input type="text" class="form-control" name="regard" id="regard">
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Ditujukan Kepada</label>
                            <select name="to_position" id="to_position" class="form-control">
                                <option value="" selected disabled>Pilih Posisi</option>
                                @foreach (Helper::job_array() as $key => $job)
                                    <option value="{{ $key }}">{{ $job }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Urgensi Surat</label>
                            <select name="urgency_letter" id="urgency_letter" class="form-control">
                                <option value="" selected disabled>Pilih Urgensi Surat</option>
                                <option value="biasa">Biasa</option>
                                <option value="segera">Segera</option>
                                <option value="sangat_segera">Sangat Segera</option>
                            </select>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Klasifikasi Surat</label>
                            <select name="classification" id="classification" class="form-control">
                                <option value="" selected disabled>Pilih Klasifikasi Surat</option>
                                <option value="eksternal">Eksternal</option>
                                <option value="internal">Internal</option>
                            </select>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Dari</label>
                            <input type="text" class="form-control" name="from" id="from">
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Tanggal Surat</label>
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Tembusan</label>
                            <select name="copy_of_letter" id="copy_of_letter" class="form-control">
                                <option value="" selected disabled>Pilih Posisi</option>
                                @foreach (Helper::job_array() as $key => $job)
                                    <option value="{{ $key }}">{{ $job }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Alamat Pengirim</label>
                    <textarea name="address_sender" id="address_sender" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Isi</label>
                    <textarea name="content" id="content" class="form-control summernote"></textarea>
                </div>
                @if (request()->segment(3) == 'outbox')
                    <input type="hidden" name="category" value="out">
                    <input type="hidden" name="status" value="3">
                    <div class="row pb-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Verifikator</label>
                                <select name="verificator" id="verificator" class="form-control">
                                    <option value="" selected disabled>Pilih Verifikator</option>
                                    @foreach (Helper::job_array() as $key => $job)
                                        <option value="{{ $key }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group">
                                <label for="exampleInputEmail1">Petanda Tangan</label>
                                <select name="ttd" id="ttd" class="form-control">
                                    <option value="" selected disabled>Pilih Petanda Tangan</option>
                                    @foreach (Helper::ttd_array() as $key => $job)
                                        <option value="{{ $key }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="category" value="in">
                    <input type="hidden" name="status" value="2">
                @endif


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">Dokumen Pendukung</label>
                            <input type="file" name="doc_1" class="form-control-file"
                                onchange="readURL(this, '#doc-pendukung1');">
                            <img id="doc-pendukung1" src="https://via.placeholder.com/150" alt="Preview"
                                class="form-group my-2 w-100">
                        </div>
                    </div>
                    <input type="hidden" name="action" id="action" value="send">
                    <div class="col-md-3">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">Dokumen Pendukung</label>
                            <input type="file" name="doc_2" class="form-control-file"
                                onchange="readURL(this, '#doc-pendukung2');">
                            <img id="doc-pendukung2" src="https://via.placeholder.com/150" alt="Preview"
                                class="form-group my-2 w-100">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">Dokumen Pendukung</label>
                            <input type="file" name="doc_3" class="form-control-file"
                                onchange="readURL(this, '#doc-pendukung3');">
                            <img id="doc-pendukung3" src="https://via.placeholder.com/150" alt="Preview"
                                class="form-group my-2 w-100">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group m-form__group">
                            <label for="exampleSelect1">Dokumen Asli</label>
                            <input type="file" name="original_file" class="form-control-file"
                                onchange="readURL(this, '#doc-asli');">
                            <img id="doc-asli" src="https://via.placeholder.com/150" alt="Preview"
                                class="form-group my-2 w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--right">
                    <a href="javascript:void(0)" onclick="processDraft()" class="mx-2">Simpan sebagai draft</a>
                    <button type="button" class="btn btn-primary" onclick="processSubmit()">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        @include('package.summernote.summernote_js')
        @include('component.formImageSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.message.inbox.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            toastr.success(data.message, "Berhasil");
                            if ('{{ request()->segment(3) == 'outbox' }}') {
                                window.location.href = "{{ route('admin.message.outbox.page') }}";
                            } else {
                                window.location.href = "{{ route('admin.message.inbox.page') }}";
                            }
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    });
                });

            })

            function processSubmit() {
                $('#action').val('send');
                $('#formSubmit').submit();
            }

            function processDraft() {
                $('#action').val('draft');
                $('#formSubmit').submit();
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
