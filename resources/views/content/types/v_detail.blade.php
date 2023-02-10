@extends('content.types.layout.v_main')
@section('type')
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Pengaturan {{ session('title') }}
                </h3>
            </div>
        </div>
    </div>
    <form class="m-form" id="formSubmit">
        <input type="hidden" name="id" value="{{ $type['id'] }}">
        <div class="m-portlet__body">
            <div class="m-checkbox-list">
                <label class="m-checkbox">
                    <input type="checkbox" id="select-all"> Centang Semua
                    <span></span>
                </label>
            </div>
            @php
                $arrayData = [];
            @endphp
            @foreach ($type_template as $data)
                @php $arrayData[$data] = $data @endphp
            @endforeach
            {{-- {{ dd($arrayData) }} --}}
            <div class="m-checkbox-inline">
                @foreach ($template as $output_grade)
                    <label class="m-checkbox">
                        <input type="checkbox" name="template[]" value="{{ $output_grade['id'] }}"
                            @if (in_array($output_grade['id'], $arrayData)) checked="checked" @endif
                            > {{ $output_grade['name'] }}
                        <span></span>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <button type="submit" id="btnSubmit" class="btn btn-brand">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
        @include('component.formSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#select-all").click(function() {
                    $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
                });

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    $.ajax({
                        url: "{{ route('admin.type.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
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
        </script>
    @endpush
@endsection
