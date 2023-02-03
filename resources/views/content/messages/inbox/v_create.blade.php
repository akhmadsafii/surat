@extends('layout.admin.v_main')
@section('content')
@push('styles')
<style>
    @media (min-width: 1025px){
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
                <h3 class="m-form__heading-title">Tambah Surat Masuk:</h3>
            </div>
        </div>
    </div>
    <form class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Kategori Surat</label>
                        <select name="category" id="category" class="form-control">
                            <option value="" selected disabled>Pilih Kategori Surat</option>
                            <option value="penting">Penting</option>
                            <option value="rahasia">Rahasia</option>
                            <option value="biasa">Biasa</option>
                            <option value="sangat_segera">Sangat Segera</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Nomor Surat</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Jenis Surat</label>
                        <select name="category" id="category" class="form-control">
                            <option value="" selected disabled>Pilih Jenis Surat</option>
                            <option value="skl">Surat Keterangan Lulus</option>
                            <option value="skp">Surat Pengumuman</option>
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Tanggal Surat</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Dari</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Alamat Pengirim</label>
                <textarea name="" id="" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Klasifikasi Surat</label>
                <select name="" id="" class="form-control">
                    <option value="" selected disabled>Pilih Klasifikasi Surat</option>
                    <option value="">Eksternal</option>
                    <option value="">Internal</option>
                </select>
            </div>
            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Ditujukan Kepada</label>
                <select name="" id="" class="form-control">
                    <option value="" selected disabled>Pilih Klasifikasi Surat</option>
                    <option value="">Eksternal</option>
                    <option value="">Internal</option>
                </select>
            </div>
            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Perihal</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Tembusan</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <button type="reset" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
    @push('scripts')
        @include('component.formImageSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                formImageSubmit('#formSubmit', '#btnSubmit', '', '#modalForm')

            })

            function addData() {
                $('#id_admin').val("");
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
                // $('#notice_password').addClass('d-none');
            }

            function editData(id) {
                $.ajax({
                    url: '{{ route('admin.manage.detail') }}',
                    data: {
                        id
                    },
                    success: (data) => {
                        $('.modal-title').html('Edit {{ session('title') }}');
                        $('#id_admin').val(data.id);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#phone').val(data.phone);
                        $('#preview-image').attr('src', data.avatar);
                        $('#modalForm').modal('show');
                    }
                });
            }

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.manage.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            $('#list-table').dataTable().fnDraw(false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    })
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
