@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.datatables.datatable_css')
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
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Kelola {{ session('title') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="javascript:void(0)" onclick="addData()"
                                class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Tambah</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                        <li class="m-portlet__nav-item">
                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                                m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#"
                                    class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                    <i class="la la-ellipsis-h m--font-brand"></i>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span
                                        class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">Opsi Tambahan</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-notes"></i>
                                                            <span class="m-nav__link-text">Import</span>
                                                        </a>
                                                    </li>
                                                    {{-- <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">Send Messages</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                            <span class="m-nav__link-text">Upload File</span>
                                                        </a>
                                                    </li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        <div class="table-responsive">
                            <table class="table table-hover" id="list-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Terakhir Login</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
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
                            <input type="hidden" name="id" id="id_admin">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control m-input" id="name" name="name"
                                    placeholder="Nama Admin">
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
                                    <img id="preview-image" src="https://via.placeholder.com/150" alt="Preview"
                                        class="w-100">
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
