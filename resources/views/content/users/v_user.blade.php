@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        <style>
            .banner {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 125px;
                /* background-image: url(../img/banner.jpg); */
                background-position: center;
                background-size: cover;
            }
        </style>
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
                            <span class="m-nav__link-text">User</span>
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
        <div class="row">
            @foreach ($user as $us)
                <div class="col-md-4">
                    <div
                        class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center position-relative overflow-hidden">
                        <div class="banner" style="background-image: url({{ asset('asset/img/bg-1.png') }});"></div>
                        <h4 class="mb-4">{{ $us['position'] }}</h4>
                        <img src="{{ $us['file'] }}" alt="" class="m--img-rounded mx-auto mb-3">
                        <div class="text-center mb-4">
                            <p class="mb-2">{{ $us['name'] ?? '-' }}</p>
                            <p class="mb-2">{{ $us['nip'] ?? '-' }}</p>
                        </div>
                        <div class="social-links d-flex justify-content-center">
                            <button type="button" onclick="{{ $us['name'] == null ? 'addData("'.$us['code'].'")' : 'editData('.$us['code'].')' }}" class="btn btn-{{ $us['name'] == null ? 'accent' : 'primary' }} m-btn m-btn--air m-btn--custom">{{ $us['name'] == null ? 'Tambah' : 'Edit' }}</button>
                            @if ($us['name'] != null)
                                &nbsp;&nbsp;
                                <button type="button" class="btn btn-info m-btn m-btn--air m-btn--custom">Detail</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @push('modals')
        <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formSubmit">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_user">
                            <input type="hidden" name="position" id="position">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control m-input" id="name" name="name"
                                    placeholder="Nama Pengguna">
                            </div>
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" class="form-control m-input" id="nip" name="nip"
                                    placeholder="NIP">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control m-input" id="email" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" class="form-control m-input" id="phone" name="phone"
                                    placeholder="Telepon">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" id="address" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control m-input" id="password" name="password"
                                            placeholder="Password">
                                        <span class="m-form__help d-none" id="notice_password">Harap kosongi, jika tidak ingin
                                            mengubah passwords.</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="file" class="form-control-file"
                                            onchange="readURL(this);">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="preview-image" src="https://via.placeholder.com/150" alt="Preview" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        @include('package.datatables.datatable_js')
        @include('component.formImageSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var table = $('#list-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
                    dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    buttons: [
                        "print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5",
                    ],
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'align-middle'
                    }, {
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'phone',
                        name: 'phone',
                    }, {
                        data: 'email',
                        name: 'email',
                    }, {
                        data: 'last_login',
                        name: 'last_login',
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center align-middle'
                    }, ]
                });

                formImageSubmit('#formSubmit', '#btnSubmit', '', '#modalForm')

            })

            function addData(position) {
                $('#id_user').val("");
                $('#position').val(position);
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
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
