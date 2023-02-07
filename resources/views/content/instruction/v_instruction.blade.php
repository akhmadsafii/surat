@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.datatables.datatable_css')
    @endpush
    <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{ session('title') }}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="javascript:void(0)" onclick="deleteData()"
                            class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-trash-o"></i>
                                <span>Hapus</span>
                            </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>
                    <li class="m-portlet__nav-item">
                        <a href="javascript:void(0)" onclick="addData()"
                            class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Tambah</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <form action="" class="m-form">
            <div class="m-portlet__body">
                <div class="m-form__group form-group">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox">
                            <input type="checkbox"> Centang Semua
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="m-checkbox-inline">
                            @if (!$instruction->isEmpty())
                                @foreach ($instruction as $ins)
                                    <label class="m-checkbox">
                                        <input type="checkbox" value="{{ $ins['id'] }}"
                                            {{ $ins['status'] == 1 ? 'checked' : '' }}> {{ $ins['name'] }}
                                        <span></span>
                                    </label>
                                @endforeach
                            @else
                                <p>Tidak tersedia</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="reset" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
                    <form id="formSubmit" class="m-form">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_instruction">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control m-input" id="name" name="name"
                                    placeholder="Nama Instruksi">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>&nbsp;<span class="m-form__help">(Opsional)</span>
                                <input type="text" class="form-control m-input" id="code" name="code"
                                placeholder="Slug Instruksi">
                                
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Status:</label>
                                <div class="m-radio-inline">
                                    <label class="m-radio">
                                        <input type="radio" name="status" checked value="1"> Aktif
                                        <span></span>
                                    </label>
                                    <label class="m-radio">
                                        <input type="radio" name="status" value="2"> Tidak Aktif
                                        <span></span>
                                    </label>
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
        @include('component.formSubmit')
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

                // formSubmit('#formSubmit', '#btnSubmit', '', '#modalForm')

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    $.ajax({
                        url: '',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.reload();
                            $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                            $('##btnSubmit').attr("disabled", false);
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

            function addData() {
                $('#id_instruction').val("");
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
        </script>
    @endpush
@endsection
