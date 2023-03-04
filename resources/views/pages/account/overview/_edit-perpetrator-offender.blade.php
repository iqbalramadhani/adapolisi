@if((new \Jenssegers\Agent\Agent())->isDesktop())
<style>
    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 100px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        margin-top: 5px;
        padding: 5px;
        display: block;
        background: #f1416c;
        border: 1px;
        color: white;
        text-align: center;
        cursor: pointer;
        border-radius: 15px;
    }

    .remove:hover {
        background: white;
        color: black;
    }

    .removeImage {
        margin-top: 5px;
        padding: 5px;
        display: block;
        background: #f1416c;
        border: 1px;
        color: white;
        text-align: center;
        cursor: pointer;
        border-radius: 15px;
    }

    .removeImage:hover {
        background: white;
        color: black;
    }
</style>

<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_input_data_kejadian" aria-expanded="true" aria-controls="kt_input_data_kejadian">
        <div class="row p-9" style="margin-left: -40px;">
            <h1>NIK Pelaku: {{ $perpetrator_info->nik }}</h1>
        </div>
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_input_data_kejadian" class="collapse show">
        <!--begin::Form-->
        <form id="kt_input_data_kejadian_form" class="form" method="POST" action="{{ route('perpetrator.updateOffender') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="offender_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ request()->segment(4) }}" />
            <!--begin::Card body-->
            <div class="card-body p-9">

                <div class="row mb-6" style="margin-top: -25px;">
                    <h1><u>Detail Indikasi Kejahatan</u></h1>
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jenis Kejahatan') }}</label>
                                <select name="crime_id" aria-label="{{ __('Pilih Jenis Kejahatan') }}" data-control="select2" data-placeholder="{{ __('Pilih Jenis Kejahatan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Jenis Kejahatan..') }}</option>
                                    @foreach($crimes as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->crime_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Tanggal Kejadian') }}</label>

                                <input type="date" name="date_incident" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->date_incident}}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Waktu Kejadian') }}</label>
                                <select name="time_id" aria-label="{{ __('Pilih Waktu Kejadian') }}" data-control="select2" data-placeholder="{{ __('Pilih Waktu Kejadian..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Waktu Kejadian..') }}</option>
                                    @foreach($time_patterns as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->time_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Lokasi Kejadian') }}</label>
                                <input type="text" id="location_incident" name="location_incident" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->location_incident}}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('RT') }}</label>
                                <input type="text" id="location_rt" name="location_rt" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->rt}}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('RW') }}</label>
                                <input type="text" id="location_rw" name="location_rw" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->rw}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Provinsi') }}</label>

                                <select id="select_province_location" name="province_location" aria-label="{{ __('Pilih Provinsi') }}" data-control="select2" data-placeholder="{{ __('Pilih Provinsi..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Provinsi..') }}</option>
                                    @foreach($provinces as $value)
                                    <option value="{{ $value->code }}" {{ $value->code == $offender->offenderCrimeIndication->province_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kota') }}</label>

                                <select id="select_city_location" name="city_location" data-control="select2" data-placeholder="Pilih Kota.." class="form-select form-select-solid form-select-lg">
                                    <option value="{{ $selected_city->code ?? '' }}" selected>{{ $selected_city->name ?? '' }}</option>
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kecamatan') }}</label>
                                <select id="select_district_location" name="district_location" data-control="select2" data-placeholder="Pilih Kecamatan.." class="form-select form-select-solid form-select-lg">
                                    <option value="{{ $selected_district->code ?? '' }}" selected>{{ $selected_district->name ?? '' }}</option>
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kelurahan') }}</label>
                                <select id="select_village_location" name="village_location" data-control="select2" data-placeholder="Pilih Kelurahan.." class="form-select form-select-solid form-select-lg">
                                    <option value="{{ $selected_village->code ?? '' }}" selected>{{ $selected_village->name ?? '' }}</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <div style="margin-top: 50px; margin-bottom: 30px;">
                    <hr>
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Apakah terindikasi/terdapat temuan Minuman Keras') }}</label>
                                <select name="is_indication_alchohol" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih..') }}</option>
                                    <option value="1" {{ $offender->offenderCrimeIndication->is_indication_alchohol == '1' ? "selected" : "" }}>Iya</option>
                                    <option value="0" {{ $offender->offenderCrimeIndication->is_indication_alchohol == '0' ? "selected" : "" }}>Tidak</option>
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Cara Peroleh (Minuman Keras)') }}</label>
                                <input type="text" name="how_to_get_alchohol" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->how_to_get_alchohol}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Apakah terindikasi mengkonsumsi narkoba?') }}</label>
                                <select name="is_indication_drug" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih..') }}</option>
                                    <option value="1" {{ $offender->offenderCrimeIndication->is_indication_drug == '1' ? "selected" : "" }}>Iya</option>
                                    <option value="0" {{ $offender->offenderCrimeIndication->is_indication_drug == '0' ? "selected" : "" }}>Tidak</option>
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label fw-bold fs-6">{{ __('Cara Peroleh (Narkoba)') }}</label>
                                <input type="text" name="how_to_get_drug" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->how_to_get_drug}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Alat (Senjata)') }}</label>
                                <select name="equipment_id" aria-label="{{ __('Pilih Alat (Senjata)') }}" data-control="select2" data-placeholder="{{ __('Pilih Alat (Senjata)..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Alat (Senjata)..') }}</option>
                                    @foreach($equipments as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->equipment_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label fw-bold fs-6">{{ __('Cara Peroleh Alat (Senjata)') }}</label>
                                <select name="how_to_get_equipment_id" aria-label="{{ __('Pilih Cara Peroleh Alat (Senjata)') }}" data-control="select2" data-placeholder="{{ __('Pilih Cara Peroleh Alat (Senjata)..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Cara Peroleh Alat (Senjata)..') }}</option>
                                    @foreach($how_get_equipments as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->how_get_equipment_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Motif Kejahatan') }}</label>
                                <select name="motives_id" aria-label="{{ __('Pilih Motif Kejahatan') }}" data-control="select2" data-placeholder="{{ __('Pilih Motif Kejahatan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Motif Kejahatan..') }}</option>
                                    @foreach($motives as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->motives_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Modus Kejahatan') }}</label>
                                <select name="crime_mode_id" aria-label="{{ __('Pilih Modus Kejahatan') }}" data-control="select2" data-placeholder="{{ __('Pilih Modus Kejahatan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Motif Kejahatan..') }}</option>
                                    @foreach($crime_modes as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->crime_mode_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Sarana') }}</label>
                                <select name="vehicle_id" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih Sarana..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Sarana..') }}</option>
                                    @foreach($vehicles as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->vehicle_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('No. Polisi (Plat)') }}</label>
                                <input type="text" name="plat_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->plat_number }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Catatan Lainnya') }}</label>
                                <textarea name="other_notes" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3">{{ $offender->offenderCrimeIndication->other_notes }}</textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <!--begin::Upload photo-->
                                <div class="row mb-2">
                                    <h2 style="margin-top: 10px;">Upload Foto</h2><br>
                                    <p><i>Dokumentasi barang bukti</i></p>
                                </div>

                                <div class="field" align="left">
                                    <input type="file" id="files" name="files[]" multiple />
                                    @foreach($offender_images as $key => $value)
                                    <span class="pip">
                                        <input type="text" name="old_files[{{$key}}]" style="display:none" value="{{ $value->file_path }}" />
                                        <img class="imageThumb gambar" src="{{ url('uploads') .'/'. $value->file_path }}" alt="" title="" data-gambar="{{ url('uploads') .'/'. $value->file_path }}" />
                                        <span class="removeImage">Delete</span>
                                    </span>
                                    @endforeach
                                </div>
                                <!--end::Upload photo-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <div style="margin-top: 50px; margin-bottom: 5px;">
                    <hr>
                </div>

                <!--begin::Input group-->
                <div class="row mb-0">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6" style="margin-top: 20px; margin-bottom: 25px;">{{ __('Kejahatan Berkelompok ') }}</label>
                    <!--begin::Label-->

                    <!--begin::Label-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="form-check form-check-solid form-check-custom form-switch fv-row">
                            <input type="hidden" name="is_gang_crime" value="0">
                            <input class="form-check-input w-45px h-30px" type="checkbox" id="isGangCrime" name="is_gang_crime" value="1" {{ $offender->offenderCrimeIndication->is_gang_crime === 1 ? 'checked' : '' }} />
                        </div>
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-5 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Ketua Kelompok') }}</label>
                                <input type="text" name="lead_gang_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->lead_gang_name }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-5 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama Kelompok') }}</label>
                                <input type="text" name="gang_crime_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->gang_crime_name }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-2 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Jumlah Anggota') }}</label>
                                <input type="text" name="total_gang_member" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->total_gang_member }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <div style="margin-top: 50px; margin-bottom: 5px;">
                    <hr>
                </div>

                <div class="row mb-6">
                    <h1 style="margin-top: 25px;"><u>Sambang Internal</u></h1>
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Tanggal Sambang') }}</label>
                                <input type="date" id="internal_date_visit" name="internal_date_visit" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderInternalVisit ? $offender->offenderInternalVisit->date_visit : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Mulai') }}</label>
                                <input type="time" id="internal_time_visit_start_at" name="internal_time_visit_start_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderInternalVisit ? $offender->offenderInternalVisit->time_visit_start_at : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Selesai') }}</label>
                                <input type="time" id="internal_time_visit_end_at" name="internal_time_visit_end_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->time_visit_end_at : '' }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama PIC') }}</label>
                                <input type="text" name="internal_pic_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_name : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jabatan') }}</label>
                                <input type="text" name="internal_pic_position" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_position : '' }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Instansi') }}</label>
                                <input type="text" name="internal_pic_instance" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_instance : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('No. Handphone') }}</label>
                                <input type="text" name="internal_pic_phone_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_phone_number : '' }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kegiatan') }}</label>
                                <textarea name="internal_activity" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3">{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->activity : '' }}</textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <!--begin::Upload photo-->
                                <div class="row mb-2">
                                    <h2 style="margin-top: 10px;">Upload Foto</h2><br>
                                    <p><i>Dokumentasi kegiatan</i></p>
                                </div>

                                <div class="field" align="left">
                                    <input type="file" id="filesInternal" name="files_internal[]" multiple />
                                    @foreach($internal_visit_images as $key => $value)
                                    <span class="pip">
                                        <input type="text" name="old_internal_visit_images[{{$key}}]" style="display:none" value="{{ $value->file_path }}" />
                                        <img class="imageThumb" src="{{ url('uploads') .'/'. $value->file_path }}" alt="" title="" />
                                        <span class="removeImage">Delete</span>
                                    </span>
                                    @endforeach
                                </div>
                                <!--end::Upload photo-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <div style="margin-top: 50px; margin-bottom: 5px;">
                    <hr>
                </div>

                <div class="row mb-6">
                    <h1 style="margin-top: 25px;"><u>Sambang Eksternal</u></h1>
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Tanggal Sambang') }}</label>
                                <input type="date" id="external_date_visit" name="external_date_visit" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->date_visit : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Mulai') }}</label>
                                <input type="time" id="external_time_visit_start_at" name="external_time_visit_start_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->time_visit_start_at : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Selesai') }}</label>
                                <input type="time" id="external_time_visit_end_at" name="external_time_visit_end_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->time_visit_end_at : '' }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama PIC') }}</label>
                                <input type="text" name="external_pic_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_name : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jabatan') }}</label>
                                <input type="text" name="external_pic_position" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_position : '' }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Instansi') }}</label>
                                <input type="text" name="external_pic_instance" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_instance : '' }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('No. Handphone') }}</label>
                                <input type="text" name="external_pic_phone_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_phone_number : '' }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kegiatan') }}</label>
                                <textarea name="external_activity" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3">{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->activity : '' }}</textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <!--begin::Upload photo-->
                                <div class="row mb-2">
                                    <h2 style="margin-top: 10px;">Upload Foto</h2><br>
                                    <p><i>Dokumentasi kegiatan</i></p>
                                </div>

                                <div class="field" align="left">
                                    <input type="file" id="filesExternal" name="files_external[]" multiple />
                                    @foreach($external_visit_images as $key => $value)
                                    <span class="pip">
                                        <input type="text" name="old_external_visit_images[{{$key}}]" style="display:none" value="{{ $value->file_path }}" />
                                        <img class="imageThumb" src="{{ url('uploads') .'/'. $value->file_path }}" alt="" title="" />
                                        <span class="removeImage">Delete</span>
                                    </span>
                                    @endforeach
                                </div>
                                <!--end::Upload photo-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->


                <div style="margin-top: 50px; margin-bottom: 5px;">
                    <hr>
                </div>
                <div class="row mb-6">
                    <h1 style="margin-top: 25px;"><u>Penyelesaian</u></h1>
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Cara Penyelesaian') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select name="adjudication" aria-label="{{ __('Pilih Cara Penyelesaian') }}" data-control="select2" data-placeholder="{{ __('Pilih Cara Penyelesaian...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                            <option value="">{{ __('Pilih Cara Penyelesaian') }}</option>
                            <option value="1" {{ $offender->adjudication == '1' ? "selected" : "" }}>Restorative Justice</option>
                            <option value="2" {{ $offender->adjudication == '2' ? "selected" : "" }}>Pembinaan</option>
                            <option value="3" {{ $offender->adjudication == '3' ? "selected" : "" }}>Proses Hukum</option>
                        </select>
                    </div>
                    <!--end::Col-->
                </div>

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary" id="kt_input_data_kejadian_submit">
                    @include('partials.general._button-indicator', ['label' => __('Simpan')])
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->
@else

<form id="kt_input_data_kejadian_form" class="form" method="POST" action="{{ route('perpetrator.updateOffender') }}" enctype="multipart/form-data">

    <!--begin::Basic info-->
    <div class="card {{ $class }} shadow-lg mb-10" style="margin-top: -30px;">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_input_data_kejadian" aria-expanded="true" aria-controls="kt_input_data_kejadian">
            <div class="row p-9" style="margin-left: -40px;">
                <h1>NIK Pelaku: {{ $perpetrator_info->nik }}</h1>
            </div>
        </div>
        <!--begin::Card header-->

        <!--begin::Content-->
        <div id="kt_input_data_kejadian" class="collapse show">
            <!--begin::Form-->
            @csrf
            @method('PUT')
            <input type="hidden" name="offender_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ request()->segment(4) }}" />
            <!--begin::Card body-->
            <div class="card-body p-9">

                <div class="row mb-6" style="margin-top: -25px;">
                    <h1><u>Detail Indikasi Kejahatan</u></h1>
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jenis Kejahatan') }}</label>
                                <select name="crime_id" aria-label="{{ __('Pilih Jenis Kejahatan') }}" data-control="select2" data-placeholder="{{ __('Pilih Jenis Kejahatan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Jenis Kejahatan..') }}</option>
                                    @foreach($crimes as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->crime_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Tanggal Kejadian') }}</label>

                                <input type="date" name="date_incident" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->date_incident}}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Waktu Kejadian') }}</label>
                                <select name="time_id" aria-label="{{ __('Pilih Waktu Kejadian') }}" data-control="select2" data-placeholder="{{ __('Pilih Waktu Kejadian..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Waktu Kejadian..') }}</option>
                                    @foreach($time_patterns as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->time_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Lokasi Kejadian') }}</label>
                                <input type="text" id="location_incident" name="location_incident" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->location_incident}}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('RT') }}</label>
                                <input type="text" id="location_rt" name="location_rt" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->rt}}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('RW') }}</label>
                                <input type="text" id="location_rw" name="location_rw" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->rw}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Provinsi') }}</label>

                                <select id="select_province_location" name="province_location" aria-label="{{ __('Pilih Provinsi') }}" data-control="select2" data-placeholder="{{ __('Pilih Provinsi..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Provinsi..') }}</option>
                                    @foreach($provinces as $value)
                                    <option value="{{ $value->code }}" {{ $value->code == $offender->offenderCrimeIndication->province_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kota') }}</label>

                                <select id="select_city_location" name="city_location" data-control="select2" data-placeholder="Pilih Kota.." class="form-select form-select-solid form-select-lg">
                                    <option value="{{ $selected_city->code ?? '' }}" selected>{{ $selected_city->name ?? '' }}</option>
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kecamatan') }}</label>
                                <select id="select_district_location" name="district_location" data-control="select2" data-placeholder="Pilih Kecamatan.." class="form-select form-select-solid form-select-lg">
                                    <option value="{{ $selected_district->code ?? '' }}" selected>{{ $selected_district->name ?? '' }}</option>
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kelurahan') }}</label>
                                <select id="select_village_location" name="village_location" data-control="select2" data-placeholder="Pilih Kelurahan.." class="form-select form-select-solid form-select-lg">
                                    <option value="{{ $selected_village->code ?? '' }}" selected>{{ $selected_village->name ?? '' }}</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Apakah terindikasi/terdapat temuan Minuman Keras') }}</label>
                                <select name="is_indication_alchohol" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih..') }}</option>
                                    <option value="1" {{ $offender->offenderCrimeIndication->is_indication_alchohol == '1' ? "selected" : "" }}>Iya</option>
                                    <option value="0" {{ $offender->offenderCrimeIndication->is_indication_alchohol == '0' ? "selected" : "" }}>Tidak</option>
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Cara Peroleh (Minuman Keras)') }}</label>
                                <input type="text" name="how_to_get_alchohol" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->how_to_get_alchohol}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Apakah terindikasi mengkonsumsi narkoba?') }}</label>
                                <select name="is_indication_drug" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih..') }}</option>
                                    <option value="1" {{ $offender->offenderCrimeIndication->is_indication_drug == '1' ? "selected" : "" }}>Iya</option>
                                    <option value="0" {{ $offender->offenderCrimeIndication->is_indication_drug == '0' ? "selected" : "" }}>Tidak</option>
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label fw-bold fs-6">{{ __('Cara Peroleh (Narkoba)') }}</label>
                                <input type="text" name="how_to_get_drug" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderCrimeIndication->how_to_get_drug}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Alat (Senjata)') }}</label>
                                <select name="equipment_id" aria-label="{{ __('Pilih Alat (Senjata)') }}" data-control="select2" data-placeholder="{{ __('Pilih Alat (Senjata)..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Alat (Senjata)..') }}</option>
                                    @foreach($equipments as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->equipment_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label fw-bold fs-6">{{ __('Cara Peroleh Alat (Senjata)') }}</label>
                                <select name="how_to_get_equipment_id" aria-label="{{ __('Pilih Cara Peroleh Alat (Senjata)') }}" data-control="select2" data-placeholder="{{ __('Pilih Cara Peroleh Alat (Senjata)..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Cara Peroleh Alat (Senjata)..') }}</option>
                                    @foreach($how_get_equipments as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->how_get_equipment_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Motif Kejahatan') }}</label>
                                <select name="motives_id" aria-label="{{ __('Pilih Motif Kejahatan') }}" data-control="select2" data-placeholder="{{ __('Pilih Motif Kejahatan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Motif Kejahatan..') }}</option>
                                    @foreach($motives as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->motives_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Modus Kejahatan') }}</label>
                                <select name="crime_mode_id" aria-label="{{ __('Pilih Modus Kejahatan') }}" data-control="select2" data-placeholder="{{ __('Pilih Modus Kejahatan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Motif Kejahatan..') }}</option>
                                    @foreach($crime_modes as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->crime_mode_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Sarana') }}</label>
                                <select name="vehicle_id" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih Sarana..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Sarana..') }}</option>
                                    @foreach($vehicles as $value)
                                    <option value="{{ $value->id }}" {{ $value->id === $offender->offenderCrimeIndication->vehicle_id ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('No. Polisi (Plat)') }}</label>
                                <input type="text" name="plat_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->plat_number }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Catatan Lainnya') }}</label>
                                <textarea name="other_notes" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3">{{ $offender->offenderCrimeIndication->other_notes }}</textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <!--begin::Upload photo-->
                                <div class="row mb-2">
                                    <h2 style="margin-top: 10px;">Upload Foto</h2><br>
                                    <p><i>Dokumentasi barang bukti</i></p>
                                </div>

                                <div class="field" align="left">
                                    <input type="file" id="files" name="files[]" multiple />
                                    @foreach($offender_images as $key => $value)
                                    <span class="pip">
                                        <input type="text" name="old_files[{{$key}}]" style="display:none" value="{{ $value->file_path }}" />
                                        <img class="imageThumb gambar" src="{{ url('uploads') .'/'. $value->file_path }}" alt="" title="" data-gambar="{{ url('uploads') .'/'. $value->file_path }}" />
                                        <span class="removeImage">Delete</span>
                                    </span>
                                    @endforeach
                                </div>
                                <!--end::Upload photo-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <div class="row mb-0">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6" style="margin-top: 20px; margin-bottom: 25px;">{{ __('Kejahatan Berkelompok ') }}</label>
                    <!--begin::Label-->

                    <!--begin::Label-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="form-check form-check-solid form-check-custom form-switch fv-row">
                            <input type="hidden" name="is_gang_crime" value="0">
                            <input class="form-check-input w-45px h-30px" type="checkbox" id="isGangCrime" name="is_gang_crime" value="1" {{ $offender->offenderCrimeIndication->is_gang_crime === 1 ? 'checked' : '' }} />
                        </div>
                    </div>
                    <!--begin::Label-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">

                    <!--begin::Col-->
                    <div class="col-lg-12">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-5 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Ketua Kelompok') }}</label>
                                <input type="text" name="lead_gang_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->lead_gang_name }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-5 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama Kelompok') }}</label>
                                <input type="text" name="gang_crime_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->gang_crime_name }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-2 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Jumlah Anggota') }}</label>
                                <input type="text" name="total_gang_member" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderCrimeIndication->total_gang_member }}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

    <div class="card mb-10 shadow-lg">
        <div class="card-body">
            <div class="row mb-6">
                <h1 style="margin-top: 25px;"><u>Sambang Internal</u></h1>
            </div>

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Tanggal Sambang') }}</label>
                            <input type="date" id="internal_date_visit" name="internal_date_visit" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderInternalVisit ? $offender->offenderInternalVisit->date_visit : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Mulai') }}</label>
                            <input type="time" id="internal_time_visit_start_at" name="internal_time_visit_start_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{$offender->offenderInternalVisit ? $offender->offenderInternalVisit->time_visit_start_at : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Selesai') }}</label>
                            <input type="time" id="internal_time_visit_end_at" name="internal_time_visit_end_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->time_visit_end_at : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama PIC') }}</label>
                            <input type="text" name="internal_pic_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_name : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jabatan') }}</label>
                            <input type="text" name="internal_pic_position" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_position : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Instansi') }}</label>
                            <input type="text" name="internal_pic_instance" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_instance : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('No. Handphone') }}</label>
                            <input type="text" name="internal_pic_phone_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->pic_phone_number : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kegiatan') }}</label>
                            <textarea name="internal_activity" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3">{{ $offender->offenderInternalVisit ? $offender->offenderInternalVisit->activity : '' }}</textarea>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <!--begin::Upload photo-->
                            <div class="row mb-2">
                                <h2 style="margin-top: 10px;">Upload Foto</h2><br>
                                <p><i>Dokumentasi kegiatan</i></p>
                            </div>

                            <div class="field" align="left">
                                <input type="file" id="filesInternal" name="files_internal[]" multiple />
                                @foreach($internal_visit_images as $key => $value)
                                <span class="pip">
                                    <input type="text" name="old_internal_visit_images[{{$key}}]" style="display:none" value="{{ $value->file_path }}" />
                                    <img class="imageThumb" src="{{ url('uploads') .'/'. $value->file_path }}" alt="" title="" />
                                    <span class="removeImage">Delete</span>
                                </span>
                                @endforeach
                            </div>
                            <!--end::Upload photo-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
    </div>

    <div class="card mb-10 shadow-lg">
        <div class="card-body">
            <div class="row mb-6">
                <h1 style="margin-top: 25px;"><u>Sambang Eksternal</u></h1>
            </div>

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Tanggal Sambang') }}</label>
                            <input type="date" id="external_date_visit" name="external_date_visit" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->date_visit : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Mulai') }}</label>
                            <input type="time" id="external_time_visit_start_at" name="external_time_visit_start_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->time_visit_start_at : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-3 fv-row">
                            <label class="col-lg-6 col-form-label  fw-bold fs-6">{{ __('Waktu Selesai') }}</label>
                            <input type="time" id="external_time_visit_end_at" name="external_time_visit_end_at" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->time_visit_end_at : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama PIC') }}</label>
                            <input type="text" name="external_pic_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_name : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jabatan') }}</label>
                            <input type="text" name="external_pic_position" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_position : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Instansi') }}</label>
                            <input type="text" name="external_pic_instance" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_instance : '' }}" />
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-6 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('No. Handphone') }}</label>
                            <input type="text" name="external_pic_phone_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->pic_phone_number : '' }}" />
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kegiatan') }}</label>
                            <textarea name="external_activity" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3">{{ $offender->offenderExternalVisit ? $offender->offenderExternalVisit->activity : '' }}</textarea>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Col-->
                <div class="col-lg-12">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <!--begin::Upload photo-->
                            <div class="row mb-2">
                                <h2 style="margin-top: 10px;">Upload Foto</h2><br>
                                <p><i>Dokumentasi kegiatan</i></p>
                            </div>

                            <div class="field" align="left">
                                <input type="file" id="filesExternal" name="files_external[]" multiple />
                                @foreach($external_visit_images as $key => $value)
                                <span class="pip">
                                    <input type="text" name="old_external_visit_images[{{$key}}]" style="display:none" value="{{ $value->file_path }}" />
                                    <img class="imageThumb" src="{{ url('uploads') .'/'. $value->file_path }}" alt="" title="" />
                                    <span class="removeImage">Delete</span>
                                </span>
                                @endforeach
                            </div>
                            <!--end::Upload photo-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="row mb-6">
                <h1 style="margin-top: 25px;"><u>Penyelesaian</u></h1>
            </div>
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Cara Penyelesaian') }}</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select name="adjudication" aria-label="{{ __('Pilih Cara Penyelesaian') }}" data-control="select2" data-placeholder="{{ __('Pilih Cara Penyelesaian...') }}" class="form-select form-select-solid form-select-lg fw-bold">
                        <option value="">{{ __('Pilih Cara Penyelesaian') }}</option>
                        <option value="1" {{ $offender->adjudication == '1' ? "selected" : "" }}>Restorative Justice</option>
                        <option value="2" {{ $offender->adjudication == '2' ? "selected" : "" }}>Pembinaan</option>
                        <option value="3" {{ $offender->adjudication == '3' ? "selected" : "" }}>Proses Hukum</option>
                    </select>
                </div>
                <!--end::Col-->
            </div>
        </div>
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="submit" class="btn btn-primary" id="kt_input_data_kejadian_submit">
                @include('partials.general._button-indicator', ['label' => __('Simpan')])
            </button>
        </div>
        <!--end::Actions-->
    </div>
</form>


@endif

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <img src="" id="modal-gambar" alt="gambar" width="100%">
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('.gambar').click(function() {
            $('#modal-gambar').attr('src', $(this).data('gambar'));
            $('#staticBackdrop').modal('show');
        });

        // ---------------------------------------------------- START OF MULTIPLE UPLOAD ---------------------------------------------------- //
        $(".removeImage").click(function() {
            $(this).parent(".pip").remove();
        });

        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Delete</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });

                        // Old code here
                        /*$("<img></img>", {
                            class: "imageThumb",
                            src: e.target.result,
                            title: file.name + " | Click to remove"
                        }).insertAfter("#files").click(function(){$(this).remove();});*/

                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });

            $("#filesInternal").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Delete</span>" +
                            "</span>").insertAfter("#filesInternal");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });

                        // Old code here
                        /*$("<img></img>", {
                            class: "imageThumb",
                            src: e.target.result,
                            title: file.name + " | Click to remove"
                        }).insertAfter("#files").click(function(){$(this).remove();});*/

                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });

            $("#filesExternal").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Delete</span>" +
                            "</span>").insertAfter("#filesExternal");
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                        });

                        // Old code here
                        /*$("<img></img>", {
                            class: "imageThumb",
                            src: e.target.result,
                            title: file.name + " | Click to remove"
                        }).insertAfter("#files").click(function(){$(this).remove();});*/

                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
            });

        } else {
            alert("Your browser doesn't support to File API")
        }
        // ---------------------------------------------------- END OF MULTIPLE UPLOAD ---------------------------------------------------- //


        // ---------------------------------------------------- START OF ALAMAT ORANG TUA ---------------------------------------------------- //

        //  Event on change select province:start
        $('#select_province_location').change(function() {
            //clear select
            $('#select_city_location').empty();
            $("#select_district_location").empty();
            $("#select_village_location").empty();
            //set id
            let provinceID = $(this).val();
            if (provinceID) {
                $('#select_city_location').select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('cities.select') }}?province_code=" + provinceID,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.code
                                    }
                                })
                            };
                        }
                    }
                });
            } else {
                $('#select_city_location').empty();
                $("#select_district_location").empty();
                $("#select_village_location").empty();
            }
        });
        //  Event on change select province:end

        //  Event on change select city:start
        $('#select_city_location').change(function() {
            //clear select
            $("#select_district_location").empty();
            $("#select_village_location").empty();
            //set id
            let cityID = $(this).val();
            if (cityID) {
                $('#select_district_location').select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('districts.select') }}?city_code=" + cityID,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.code
                                    }
                                })
                            };
                        }
                    }
                });
            } else {
                $("#select_district_location").empty();
                $("#select_village_location").empty();
            }
        });
        //  Event on change select city:end

        //  Event on change select district:Start
        $('#select_district_location').change(function() {
            //clear select
            $("#select_village_location").empty();
            //set id
            let districtID = $(this).val();
            if (districtID) {
                $('#select_village_location').select2({
                    allowClear: true,
                    ajax: {
                        url: "{{ route('villages.select') }}?district_code=" + districtID,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.code
                                    }
                                })
                            };
                        }
                    }
                });
            }
        });
        //  Event on change select district:End

        // EVENT ON CLEAR
        $('#select_province_location').on('select2:clear', function(e) {
            $("#select_city_location").select2();
            $("#select_district_location").select2();
            $("#select_village_location").select2();
        });

        $('#select_city_location').on('select2:clear', function(e) {
            $("#select_district_location").select2();
            $("#select_village_location").select2();
        });

        $('#select_district_location').on('select2:clear', function(e) {
            $("#select_village_location").select2();
        });

        // ---------------------------------------------------- END OF ALAMAT ORANG TUA ---------------------------------------------------- //

    });
</script>