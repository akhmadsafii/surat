@extends('layout.admin.v_main')
@section('content')
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
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <input type="text" class="form-control" placeholder="Jenis Pesan" id="type" name="type">
                    <div class="input-group mt-1 mb-2">
                        <input type="text" class="form-control form-control-danger" placeholder="Kode Jenis"
                            id="code_type" name="code_type">
                        <div class="input-group-append">
                            <a href="javascript:void(0)" onclick="addType()" class="btn btn-primary m-btn m-btn--icon">
                                <i class="la la-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    @foreach ($type as $tp)
                        <div class="nav-link mb-3 p-3 shadow d-flex justify-content-between">
                            <a href="{{ route('admin.type.more', $tp['code']) }}">
                                <span
                                    class="font-weight-bold small text-uppercase">{{ $tp['code_type'] . ' - ' . $tp['name'] }}</span>
                            </a>
                            <div class="action">
                                <a href="javascript:void(0)" class="text-info" onclick="editType({{ $tp['id'] }})"><i
                                        class="la la-pencil"></i></a>
                                <a href="javascript:void(0)" class="text-danger"
                                    onclick="deleteType({{ $tp['id'] }})"><i class="la la-trash"></i></a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="m-portlet">
                        @yield('type')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })

            function addType() {
                if ($('#type').val() && $('#code_type').val()) {
                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.type.store') }}',
                        data: {
                            name: $('#type').val(),
                            code_type: $('#code_type').val(),
                        },
                        success: (data) => {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    });
                } else {
                    alert('Nama dan kode wajib diisi');
                }
            }

            function deleteType(id) {
                if (confirm("Apa kamu yakin ingin menghapus jenis ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.type.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    })
                }
            }

            function editType(id) {

            }
        </script>
    @endpush
@endsection
