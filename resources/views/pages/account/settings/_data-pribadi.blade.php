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
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_input_data_pribadi" aria-expanded="true" aria-controls="kt_input_data_pribadi">
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'others/step-data-pribadi.png') }}" class="center" style="display:block; height:20%; width:80%; margin-top:20px; margin-left:auto; margin-right:auto; margin-bottom:25px;">
        @else
        <svg width="100%" height="100%" viewBox="0 0 298 28" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 20px;">
            <path d="M14 14H149" stroke="#1D99B4" stroke-width="2" />
            <circle cx="14" cy="14" r="6" fill="#1D99B4" />
            <path d="M149 14H284" stroke="#AFAFAF" stroke-width="2" stroke-dasharray="4 4" />
            <rect x="135" width="28" height="28" rx="14" fill="#1D99B4" />
            <path d="M151.667 20V18.6667C151.667 17.9594 151.386 17.2811 150.886 16.781C150.386 16.281 149.707 16 149 16H144.333C143.626 16 142.948 16.281 142.448 16.781C141.948 17.2811 141.667 17.9594 141.667 18.6667V20" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M146.667 13.3333C148.139 13.3333 149.333 12.1394 149.333 10.6667C149.333 9.19391 148.139 8 146.667 8C145.194 8 144 9.19391 144 10.6667C144 12.1394 145.194 13.3333 146.667 13.3333Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M152.333 13.3333L153.667 14.6667L156.333 12" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="284" cy="14" r="6" fill="#AFAFAF" />
        </svg>

        <h3 class="mt-5" style="color: #232F6B;">Data Pribadi</h3>
        @endif
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_input_data_pribadi" class="collapse show">
        <!--begin::Form-->
        <form id="kt_input_data_pribadi_form" class="form" method="POST" action="{{ route('settings.updateDataPribadi') }}" enctype="multipart/form-data">
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
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Nama Ayah') }}</label>
                                <input type="text" name="father_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('father_name') is-invalid @enderror" placeholder="" value="{{ old('father_name') }}" />
                                @error('father_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Pekerjaan Ayah') }}</label>
                                <select name="father_job" aria-label="{{ __('Pilih Pekerjaan') }}" data-control="select2" data-placeholder="{{ __('Pilih Pekerjaan..') }}" class="form-select form-select-solid form-select-lg @error('father_job') is-invalid @enderror">
                                    <option value="">{{ __('Pilih Pekerjaan..') }}</option>
                                    @foreach($jobs as $value)
                                    <option value="{{ $value->id }}" {{ old('father_job') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('father_job')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Nama Ibu') }}</label>
                                <input type="text" name="mother_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('mother_name') is-invalid @enderror" placeholder="" value="{{ old('mother_name') }}" />
                                @error('mother_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Pekerjaan Ibu') }}</label>
                                <select name="mother_job" aria-label="{{ __('Pilih Pekerjaan') }}" data-control="select2" data-placeholder="{{ __('Pilih Pekerjaan..') }}" class="form-select form-select-solid form-select-lg @error('mother_job') is-invalid @enderror">
                                    <option value="">{{ __('Pilih Pekerjaan..') }}</option>
                                    @foreach($jobs as $value)
                                    <option value="{{ $value->id }}" {{ old('mother_job') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('mother_job')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Nama Wali') }}</label>
                                <input type="text" name="guardian_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('guardian_name') }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Pekerjaan Wali') }}</label>
                                <select name="guardian_job" aria-label="{{ __('Pilih Pekerjaan') }}" data-control="select2" data-placeholder="{{ __('Pilih Pekerjaan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Pekerjaan..') }}</option>
                                    @foreach($jobs as $value)
                                    <option value="{{ $value->id }}" {{ old('guardian_job') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
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
                                <label class="col-lg-6 col-form-label required fw-bold fs-6">{{ __('Alamat Tinggal Orang Tua') }}</label>
                                <input type="text" id="parent_address" name="parent_address" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('parent_address') is-invalid @enderror" placeholder="" value="{{ old('parent_address') }}"/>
                                @error('parent_address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('RT') }}</label>
                                <input type="text" id="parent_rt" name="parent_rt" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('parent_rt') }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('RW') }}</label>
                                <input type="text" id="parent_rw" name="parent_rw" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('parent_rw') }}" />
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
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Provinsi') }}</label>

                                <select id="select_province_parent" name="province_parent" aria-label="{{ __('Pilih Provinsi') }}" data-control="select2" data-placeholder="{{ __('Pilih Provinsi..') }}" class="form-select form-select-solid form-select-lg @error('province_parent') is-invalid @enderror">
                                    <option value="">{{ __('Pilih Provinsi..') }}</option>
                                    @foreach($provinces as $value)
                                    <option value="{{ $value->code }}" {{ old('province_parent') == $value->code ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_parent')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Kota') }}</label>
                                <select id="select_city_parent" name="city_parent" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg @error('city_parent') is-invalid @enderror"></select>
                                @error('city_parent')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Kecamatan') }}</label>
                                <select id="select_district_parent" name="district_parent" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg @error('district_parent') is-invalid @enderror"></select>
                                @error('district_parent')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Kelurahan') }}</label>
                                <select id="select_village_parent" name="village_parent" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg @error('village_parent') is-invalid @enderror"></select>
                                @error('village_parent')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-0">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6" style="margin-top: 20px; margin-bottom: 25px;">{{ __('Alamat tinggal sama dengan orang tua ') }}</label>
                    <!--begin::Label-->

                    <!--begin::Label-->
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="form-check form-check-solid form-check-custom form-switch fv-row">
                            <!-- <input type="hidden" name="marketing" value="0"> -->
                            <input class="form-check-input w-45px h-30px" type="checkbox" id="isSameAddress" name="isSameAddress" value="1" />
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
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-6 col-form-label fw-bold fs-6">{{ __('Alamat Tinggal Pelaku Saat Ini') }}</label>

                                <input type="text" id="perpetrator_address" name="perpetrator_address" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('RT') }}</label>
                                <input type="text" id="perpetrator_rt" name="perpetrator_rt" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('RW') }}</label>
                                <input type="text" id="perpetrator_rw" name="perpetrator_rw" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
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
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Provinsi') }}</label>

                                <select id="select_province_perpetrator" name="province_perpetrator" aria-label="{{ __('Pilih Provinsi') }}" data-control="select2" data-placeholder="{{ __('Pilih Provinsi..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Provinsi..') }}</option>
                                    @foreach($provinces as $value)
                                    <option value="{{ $value->code }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kota') }}</label>

                                <select id="select_city_perpetrator" name="city_perpetrator" aria-label="{{ __('Pilih Kota') }}" data-control="select2" data-placeholder="{{ __('Pilih Kota') }}" class="form-select form-select-solid form-select-lg"></select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kecamatan') }}</label>
                                <select id="select_district_perpetrator" name="district_perpetrator" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg"></select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kelurahan') }}</label>
                                <select id="select_village_perpetrator" name="village_perpetrator" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg"></select>
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
                    <h1 style="margin-top: 20px;">Upload Foto</h1><br>
                    <p><i>Wajah tampak depan, kanan, kiri, foto KTP, cap sidik jari, kartu pelajar. dsb</i></p>
                </div>

                <div class="field" align="left">
                    <input type="file" id="files" name="files[]" multiple />
                </div>
                <!--end::Upload photo-->

                <div style="margin-top: 50px; margin-bottom: 30px;">
                    <hr>
                </div>

                <div class="row mb-6">
                    <h1 style="margin-top: 10px;">Detail Tindak Pidana</h1><br>
                    <p><i>Isi jika Target pernah melakukan tindak pidana sebelumnya. Kosongkan jika belum pernah</i></p>
                </div>
                <div class="row mb-6" id="dynamicPidanaForm">
                    <div class="row mb-6">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Pengadilan Negeri') }}</label>
                                    <input type="text" name="addpidana[0][district_court]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                </div>

                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Polres/Polsek') }}</label>
                                    <input type="text" name="addpidana[0][police_station]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jenis Kejahatan') }}</label>
                                    <input type="text" name="addpidana[0][crime]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                </div>

                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Penyelesaian') }}</label>
                                    <input type="text" name="addpidana[0][adjudication]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Catatan Tambahan') }}</label>
                                    <textarea name="addpidana[0][crime_notes]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div><br>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <button type="button" name="addpidana" id="addpidana" class="btn btn-success" style="width: 200px; margin-left: 10px;">Tambah Pidana</button>
                    </div>
                </div>
            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('log.system.index') }}" class="btn btn-light btn-active-light-primary" style="margin-right: 10px;">{{ __('Kembali') }}</a>

                <button type="submit" class="btn btn-primary" id="kt_input_data_pribadi_submit">
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

        // ---------------------------------------------------- START OF DYNAMIC FORM TINDAK PIDANA ---------------------------------------------------- //

        const province = `{{ old('province_parent') }}`;
        const city = `{{ old('city_parent') }}`;
        const distirct = `{{ old('district_parent') }}`;
        const village = `{{ old('village_parent') }}`;

        if(province !== ""){
            $.ajax({
                url: "{{ route('cities.select') }}?province_code=" + province,
                dataType: 'json',
                success: function(data) {
                    let option = '<option value="">Pilih</option>';
                    data.map(val => {
                        option += `<option value="${val.code}">${val.name}</option>`;
                    });
                    $('#select_city_parent').html(option);
                }
            });
        }

        var i = 0;
        $("#addpidana").click(function() {
            ++i;
            $("#dynamicPidanaForm").append('<div class="row mb-6" id="formDynamicPidana"> <div class="row mb-6" style="margin-top: 20px;"> <div class="col-lg-12"> <div class="row"> <div class="col-lg-6 fv-row"> <label class="col-lg-4 col-form-label fw-bold fs-6">Pengadilan Negeri</label> <input type="text" name="addpidana[' + i + '][district_court]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" /> </div> <div class="col-lg-6 fv-row"> <label class="col-lg-4 col-form-label fw-bold fs-6">Polres/Polsek</label> <input type="text" name="addpidana[' + i + '][police_station]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" /></div> </div></div></div> <div class="row mb-6"> <div class="col-lg-12"><div class="row"> <div class="col-lg-6 fv-row"> <label class="col-lg-4 col-form-label fw-bold fs-6">Jenis Kejahatan</label> <input type="text" name="addpidana[' + i + '][crime]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" /> </div> <div class="col-lg-6 fv-row"> <label class="col-lg-4 col-form-label fw-bold fs-6">Penyelesaian</label> <input type="text" name="addpidana[' + i + '][adjudication]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" /> </div></div></div></div> <div class="row mb-6"> <div class="col-lg-12"> <div class="row"> <div class="col-lg-12 fv-row"> <label class="col-lg-4 col-form-label fw-bold fs-6">Catatan Tambahan</label> <textarea name="addpidana[' + i + '][crime_notes]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3"></textarea> </div><br></div></div></div> <div class="row mb-6"> <button type="button" class="btn btn-danger remove-pidana" style="width: 200px; margin-left: 10px;">Hapus Pidana</button> </div></div>');
        });

        $(document).on('click', '.remove-pidana', function() {
            $(this).parents('#formDynamicPidana').remove();
        });
        // ---------------------------------------------------- END OF DYNAMIC FORM TINDAK PIDANA ---------------------------------------------------- //


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


        $('#isSameAddress').click(function() {
            if ($(this).is(':checked')) {
                $('#perpetrator_address').prop('disabled', true);
                $('#perpetrator_rt').prop('disabled', true);
                $('#perpetrator_rw').prop('disabled', true);
                $('#select_province_perpetrator').prop('disabled', true);
                $('#select_city_perpetrator').prop('disabled', true);
                $('#select_district_perpetrator').prop('disabled', true);
                $('#select_village_perpetrator').prop('disabled', true);
            } else {
                $('#perpetrator_address').prop('disabled', false);
                $('#perpetrator_rt').prop('disabled', false);
                $('#perpetrator_rw').prop('disabled', false);
                $('#select_province_perpetrator').prop('disabled', false);
                $('#select_city_perpetrator').prop('disabled', false);
                $('#select_district_perpetrator').prop('disabled', false);
                $('#select_village_perpetrator').prop('disabled', false);

            }
        });


        // ---------------------------------------------------- START OF ALAMAT ORANG TUA ---------------------------------------------------- //

        //  Event on change select province:start
        $('#select_province_parent').change(function() {
            //clear select
            $('#select_city_parent').empty();
            $("#select_district_parent").empty();
            $("#select_village_parent").empty();
            //set id
            let provinceID = $(this).val();
            if (provinceID) {
                $('#select_city_parent').select2({
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
                $('#select_city_parent').empty();
                $("#select_district_parent").empty();
                $("#select_village_parent").empty();
            }
        });
        //  Event on change select province:end

        //  Event on change select city:start
        $('#select_city_parent').change(function() {
            //clear select
            $("#select_district_parent").empty();
            $("#select_village_parent").empty();
            //set id
            let cityID = $(this).val();
            if (cityID) {
                $('#select_district_parent').select2({
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
                $("#select_district_parent").empty();
                $("#select_village_parent").empty();
            }
        });
        //  Event on change select city:end

        //  Event on change select district:Start
        $('#select_district_parent').change(function() {
            //clear select
            $("#select_village_parent").empty();
            //set id
            let districtID = $(this).val();
            if (districtID) {
                $('#select_village_parent').select2({
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
        $('#select_province_parent').on('select2:clear', function(e) {
            $("#select_city_parent").select2();
            $("#select_district_parent").select2();
            $("#select_village_parent").select2();
        });

        $('#select_city_parent').on('select2:clear', function(e) {
            $("#select_district_parent").select2();
            $("#select_village_parent").select2();
        });

        $('#select_district_parent').on('select2:clear', function(e) {
            $("#select_village_parent").select2();
        });

        // ---------------------------------------------------- END OF ALAMAT ORANG TUA ---------------------------------------------------- //


        // ---------------------------------------------------- START OF ALAMAT PELAKU ---------------------------------------------------- //
        //  Event on change select province:start
        $('#select_province_perpetrator').change(function() {
            //clear select
            $('#select_city_perpetrator').empty();
            $("#select_district_perpetrator").empty();
            $("#select_village_perpetrator").empty();
            //set id
            let provinceID = $(this).val();
            if (provinceID) {
                $('#select_city_perpetrator').select2({
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
                $('#select_city_perpetrator').empty();
                $("#select_district_perpetrator").empty();
                $("#select_village_perpetrator").empty();
            }
        });
        //  Event on change select province:end

        //  Event on change select city:start
        $('#select_city_perpetrator').change(function() {
            //clear select
            $("#select_district_perpetrator").empty();
            $("#select_village_perpetrator").empty();
            //set id
            let cityID = $(this).val();
            if (cityID) {
                $('#select_district_perpetrator').select2({
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
                $("#select_district_perpetrator").empty();
                $("#select_village_perpetrator").empty();
            }
        });
        //  Event on change select city:end

        //  Event on change select district:Start
        $('#select_district_perpetrator').change(function() {
            //clear select
            $("#select_village_perpetrator").empty();
            //set id
            let districtID = $(this).val();
            if (districtID) {
                $('#select_village_perpetrator').select2({
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
        $('#select_province_perpetrator').on('select2:clear', function(e) {
            $("#select_city_perpetrator").select2();
            $("#select_district_perpetrator").select2();
            $("#select_village_perpetrator").select2();
        });

        $('#select_city_perpetrator').on('select2:clear', function(e) {
            $("#select_district_perpetrator").select2();
            $("#select_village_perpetrator").select2();
        });

        $('#select_district_perpetrator').on('select2:clear', function(e) {
            $("#select_village_perpetrator").select2();
        });

        // ---------------------------------------------------- END OF ALAMAT PELAKU ---------------------------------------------------- //



    });
</script>