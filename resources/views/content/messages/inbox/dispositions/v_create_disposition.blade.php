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
        <div class="m-portlet__head border-0">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-form__heading-title">{{ session('title') }}</h3>
                </div>
            </div>
        </div>
        <div class="m-divider">
            <span></span>
            <span>Detail Pesan</span>
            <span></span>
        </div>


        <div class="m-portlet__body">
            <table class="table">
                <tr>
                    <th>Nomor Agenda</th>
                    <td>{{ $message['no_agenda'] ?? '-' }}</td>
                    <th>Klasifikasi Surat</th>
                    <td>{{ ucfirst($message['classification']) }}</td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td>{{ $message['number'] }}</td>
                    <th>Dari</th>
                    <td>{{ $message['from'] }}</td>
                </tr>
                <tr>
                    <th>Tanggal Surat</th>
                    <td>{{ DateHelper::getTanggal($message['date']) }}</td>
                    <th>Tujuan</th>
                    <td>{{ Helper::get_job($message['to_position']) }}</td>
                </tr>
                <tr>
                    <th>Sifat Surat</th>
                    <td>{{ ucfirst($message['nature_letter']) }}</td>
                    <th>Perihal</th>
                    <td>{{ $message['regard'] }}</td>
                </tr>
            </table>
        </div>
        <div class="m-divider">
            <span></span>
            <span>Disposisikan</span>
            <span></span>
        </div>
        <form class="m-form m-form--fit m-form--label-align-right" id="formSubmit">
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Tanggal Disposisi</label>
                            <div class="input-group date">
                                <input type="text" name="date" id="date"
                                    class="form-control m-input m_datetimepicker_6" readonly=""
                                    value="{{ date('Y/m/d') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-form__group">
                            <label for="exampleInputEmail1">Penerima</label>
                            <select name="urgency_letter" id="urgency_letter"
                                class="form-control m-bootstrap-select m_selectpicker" multiple data-actions-box="true">
                                @foreach (Helper::job_array() as $key => $job)
                                    <option value="{{ $key }}">{{ $job }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Instruksi</label>
                    <div class="m-checkbox-inline">
                        @if (!$instructions->isEmpty())
                            @foreach ($instructions as $ins)
                                <label class="m-checkbox">
                                    <input type="checkbox" name="id_instruction[]"> {{ $ins['name'] }}
                                    <span></span>
                                </label>
                            @endforeach
                        @else
                        @endif
                    </div>
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Lainnya</label>
                    <input type="text" name="other_instruction" id="other_instruction" class="form-control"
                        placeholder="Masukan instruksi langsung">
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Sifat Disposisi</label>
                    <div class="m-radio-inline">
                        <label class="m-radio">
                            <input type="radio" name="nature" value="penting" checked> Penting
                            <span></span>
                        </label>
                        <label class="m-radio">
                            <input type="radio" name="nature" value="rahasia"> Rahasia
                            <span></span>
                        </label>
                        <label class="m-radio">
                            <input type="radio" name="nature" value="biasa"> Biasa
                            <span></span>
                        </label>
                        <label class="m-radio">
                            <input type="radio" name="nature" value="segera"> Segera
                            <span></span>
                        </label>
                        <label class="m-radio">
                            <input type="radio" name="nature" value="sangat_segera"> Sangat Segera
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group m-form__group">
                    <label for="exampleInputEmail1">Tanggal Maksimal Dilaksanakan</label>
                    <div class="input-group date">
                        <input type="text" name="max_date" id="max_date" class="form-control m-input m_datetimepicker_6"
                            readonly="" value="{{ date('Y/m/d') }}">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions--right">
                    <button type="reset" class="btn btn-secondary">Batal</button>
                    <button type="submit" id="btnSubmit" class="btn btn-brand">Simpan</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        @include('package.datetimepicker.datetimepicker_js')
        @include('package.select.select_js')
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
                        url: url,
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            $(id_form).trigger("reset");
                            $(modal).modal('hide');
                            $('.datatable').dataTable().fnDraw(false);
                            $(btnSubmit).removeClass('m-loader m-loader--light m-loader--right');
                            $(btnSubmit).attr("disabled", false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $(btnSubmit).removeClass('m-loader m-loader--light m-loader--right');
                            $(btnSubmit).attr("disabled", false);
                        }
                    });
                });

            })
        </script>
    @endpush
@endsection
