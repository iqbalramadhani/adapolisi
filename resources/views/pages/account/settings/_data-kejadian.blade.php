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
</style>

<!--begin::Basic info-->
<div class="card {{ $class }}" style="@if(!(new \Jenssegers\Agent\Agent())->isDesktop()) margin-top: -30px; @endif">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_input_data_kejadian" aria-expanded="true" aria-controls="kt_input_data_kejadian">
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'others/step-data-kejadian.png') }}" class="center" style="display:block; height:20%; width:80%; margin-top:20px; margin-left:auto; margin-right:auto; margin-bottom:25px;">
        @else
        <svg width="100%" height="100%" viewBox="0 0 298 28" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 20px;">
            <path d="M14 14H148.5" stroke="#1D99B4" stroke-width="2" />
            <circle cx="14" cy="14" r="6" fill="#1D99B4" />
            <path d="M148.5 14H283" stroke="#1D99B4" stroke-width="2" />
            <circle cx="148.5" cy="14" r="6" fill="#1D99B4" />
            <rect x="269.5" width="28" height="28" rx="14" fill="#1D99B4" />
            <path d="M286.167 8.66675H287.5C287.853 8.66675 288.193 8.80722 288.443 9.05727C288.693 9.30732 288.833 9.64646 288.833 10.0001V19.3334C288.833 19.687 288.693 20.0262 288.443 20.2762C288.193 20.5263 287.853 20.6667 287.5 20.6667H279.5C279.146 20.6667 278.807 20.5263 278.557 20.2762C278.307 20.0262 278.167 19.687 278.167 19.3334V10.0001C278.167 9.64646 278.307 9.30732 278.557 9.05727C278.807 8.80722 279.146 8.66675 279.5 8.66675H280.833" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M285.5 7.33325H281.5C281.132 7.33325 280.833 7.63173 280.833 7.99992V9.33325C280.833 9.70144 281.132 9.99992 281.5 9.99992H285.5C285.868 9.99992 286.167 9.70144 286.167 9.33325V7.99992C286.167 7.63173 285.868 7.33325 285.5 7.33325Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <h3 class="mt-5" style="color: #232F6B;">Data Kejadian</h3>
        @endif
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_input_data_kejadian" class="collapse show">
        <!--begin::Form-->
        <form id="kt_input_data_kejadian_form" class="form" method="POST" action="{{ route('settings.updateDataKejadian') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="offender_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ request()->segment(4) }}" />
            <input type="hidden" name="perpetrator_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ request()->segment(6) }}" />
            <!--begin::Card body-->
            <div class="card-body p-9">

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
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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

                                <input type="date" name="date_incident" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Waktu Kejadian') }}</label>
                                <select name="time_id" aria-label="{{ __('Pilih Waktu Kejadian') }}" data-control="select2" data-placeholder="{{ __('Pilih Waktu Kejadian..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Waktu Kejadian..') }}</option>
                                    @foreach($time_patterns as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                <input type="text" id="location_incident" name="location_incident" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('RT') }}</label>
                                <input type="text" id="location_rt" name="location_rt" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('RW') }}</label>
                                <input type="text" id="location_rw" name="location_rw" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
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
                                    <option value="{{ $value->code }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kota') }}</label>

                                <select id="select_city_location" name="city_location" data-control="select2" data-placeholder="Pilih Kota.." class="form-select form-select-solid form-select-lg"></select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kecamatan') }}</label>
                                <select id="select_district_location" name="district_location" data-control="select2" data-placeholder="Pilih Kecamatan.." class="form-select form-select-solid form-select-lg"></select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __('Kelurahan') }}</label>
                                <select id="select_village_location" name="village_location" data-control="select2" data-placeholder="Pilih Kelurahan.." class="form-select form-select-solid form-select-lg"></select>
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
                                <!--begin::Label-->
                                <div class="form-check form-check-solid form-check-custom form-switch fv-row">
                                    <input type="hidden" name="is_indication_alchohol" value="0">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" id="is_indication_alchohol" name="is_indication_alchohol" value="1"/>
                                </div>

                                <!-- <select name="is_indication_alchohol" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih..') }}</option>
                                    <option value="1">Iya</option>
                                    <option value="0">Tidak</option>
                                </select> -->
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Cara Peroleh (Minuman Keras)') }}</label>
                                <input type="text" name="how_to_get_alchohol" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
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

                                <div class="form-check form-check-solid form-check-custom form-switch fv-row">
                                    <input type="hidden" name="is_indication_drug" value="0">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" id="is_indication_drug" name="is_indication_drug" value="1"/>
                                </div>

                                <!-- <select name="is_indication_drug" aria-label="{{ __('Pilih Sarana') }}" data-control="select2" data-placeholder="{{ __('Pilih..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih..') }}</option>
                                    <option value="1">Iya</option>
                                    <option value="0">Tidak</option>
                                </select> -->
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label fw-bold fs-6">{{ __('Cara Peroleh (Narkoba)') }}</label>
                                <input type="text" name="how_to_get_drug" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
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
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('No. Polisi (Plat)') }}</label>
                                <input type="text" name="plat_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
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
                                <textarea name="other_notes" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3"></textarea>
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

                <!--begin::Upload photo-->
                <div class="row mb-6">
                    <h1 style="margin-top: 10px;">Upload Foto</h1><br>
                    <p><i>Dokumentasi barang bukti</i></p>
                </div>

                <div class="field" align="left">
                    <input type="file" id="files" name="files[]" multiple />
                </div>
                <!--end::Upload photo-->

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
                            <!-- <input type="hidden" name="is_gang_crime" value="0"> -->
                            <input class="form-check-input w-45px h-30px" type="checkbox" id="isGangCrime" name="is_gang_crime" value="1" />
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
                                <input type="text" name="lead_gang_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-5 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama Kelompok') }}</label>
                                <input type="text" name="gang_crime_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-2 fv-row">
                                <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Jumlah Anggota') }}</label>
                                <input type="text" name="total_gang_member" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                <!-- <input type="text" name="last_name" class="form-control form-control-lg form-control-solid" placeholder="Last name" value=""/> -->
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

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('log.system.index') }}" class="btn btn-light btn-active-light-primary" style="margin-right: 10px;">{{ __('Kembali') }}</a>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // ---------------------------------------------------- START OF MULTIPLE UPLOAD ---------------------------------------------------- //
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