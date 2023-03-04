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
        <form id="kt_input_data_kejadian_form" class="form" method="POST" action="{{ route('perpetrator.updateProfile') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="perpetrator_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ request()->segment(4) }}" />
            <!--begin::Card body-->
            <div class="card-body p-9">

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">{{ __('NIK') }}</span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="nik" class="form-control form-control-lg form-control-solid @error('nik') is-invalid @enderror" placeholder="Masukkan NIK KTP/KK " value="{{ old('nik', $perpetrator_info->nik ?? '') }}" />
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">{{ __('Nama Lengkap') }}</span>
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="name" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" placeholder="Nama Lengkap Pelaku" value="{{ old('name', $perpetrator_info->name ?? '' ) }}" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">{{ __('Tanggal Lahir') }}</span>

                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="date" name="dob" class="form-control form-control-lg form-control-solid @error('dob') is-invalid @enderror" value="{{ old('dob', $perpetrator_info->date_of_birth ?? '' ) }}" />
                        @error('dob')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span class="required">{{ __('Jenis Kelamin') }}</span>
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select name="gender" aria-label="{{ __('Pilih jenis kelamin') }}" data-control="select2" data-placeholder="{{ __('Pilih jenis kelamin...') }}" class="form-select form-select-solid form-select-lg fw-bold @error('gender') is-invalid @enderror">
                            <option value="">{{ __('Pilih Jenis Kelamin') }}</option>
                            <option value="P" {{ old('gender', $perpetrator_info->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            <option value="L" {{ old('gender', $perpetrator_info->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Pekerjaan') }}</label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select name="job_id" aria-label="{{ __('Pilih Pekerjaan') }}" data-control="select2" data-placeholder="{{ __('Pilih Pekerjaan..') }}" class="form-select form-select-solid form-select-lg @error('job_id') is-invalid @enderror">
                            <option value="">{{ __('Pilih Pekerjaan..') }}</option>
                            @foreach($jobs as $value)
                            <option value="{{ $value->id }}" {{ old('job_id', $perpetrator_info->job_id ?? '' ) == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('job_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span>{{ __('No. Handphone') }}</span>

                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Phone number must be active') }}"></i>
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="phone_number" class="form-control form-control-lg form-control-solid" placeholder="Masukkan No Handphone" value="{{ old('phone_number', $perpetrator_info->phone_number ?? '') }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                        <span>{{ __('Email') }}</span>
                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Email" value="{{ old('email', $perpetrator_info->email ?? '') }}" />
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
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Nama Ayah') }}</label>
                                <input type="text" name="father_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('father_name') is-invalid @enderror" placeholder="" value="{{ old('father_name', $perpetrator_info->perpetratorPersonalInfo->father_name ?? '') }}" />
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
                                    <option value="{{ $value->id }}" {{ old('father_job', $perpetrator_info->perpetratorPersonalInfo->father_job ?? '' ) == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
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

                                <input type="text" name="mother_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('mother_name') is-invalid @enderror" placeholder="" value="{{ old('mother_name', $perpetrator_info->perpetratorPersonalInfo->mother_name ?? '') }}" />
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
                                    <option value="{{ $value->id }}" {{ old('mother_job', $perpetrator_info->perpetratorPersonalInfo->mother_job ?? '' ) == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
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
                                <input type="text" name="guardian_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('guardian_name', $perpetrator_info->perpetratorPersonalInfo->guardian_name ?? '') }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Pekerjaan Wali') }}</label>
                                <select name="guardian_job" aria-label="{{ __('Pilih Pekerjaan') }}" data-control="select2" data-placeholder="{{ __('Pilih Pekerjaan..') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="">{{ __('Pilih Pekerjaan..') }}</option>
                                    @foreach($jobs as $value)
                                    <option value="{{ $value->id }}" {{ old('guardian_job', $perpetrator_info->perpetratorPersonalInfo->guardian_job ?? '' ) == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
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
                                <input type="text" id="parent_address" name="parent_address" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('parent_address') is-invalid @enderror" placeholder="" value="{{ old('parent_address', $parent_address->address ?? '') }}" />
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
                                <input type="text" id="parent_rt" name="parent_rt" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('parent_rt', $parent_address->rt ?? '') }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('RW') }}</label>
                                <input type="text" id="parent_rw" name="parent_rw" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 @error('parent_rw') is-invalid @enderror" placeholder="" value="{{ old('parent_rw', $parent_address->rw ?? '') }}" />
                                @error('parent_rw')
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
                                    <option value="{{ $value->code }}" {{ $value->code == @$selected_province_parent->code ? 'selected' :'' }}>{{ $value->name }}</option>
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
                                <select id="select_city_parent" name="city_parent" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg @error('city_parent') is-invalid @enderror">
                                    <option value="{{ @$selected_city_parent->code }}" selected>{{ @$selected_city_parent->name }}</option>
                                </select>
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
                                <select id="select_district_parent" name="district_parent" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg @error('district_parent') is-invalid @enderror">
                                    <option value="{{ @$selected_district_parent->code }}" selected>{{ @$selected_district_parent->name }}</option>
                                </select>
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
                                <select id="select_village_parent" name="village_parent" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg @error('village_parent') is-invalid @enderror">
                                    <option value="{{ @$selected_village_parent->code }}" selected>{{ @$selected_village_parent->name }}</option>
                                </select>
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
                <!-- <div class="row mb-0"> -->
                <!--begin::Label-->
                <!-- <label class="col-lg-4 col-form-label fw-bold fs-6" style="margin-top: 20px; margin-bottom: 25px;">{{ __('Alamat tinggal sama dengan orang tua ') }}</label> -->
                <!--begin::Label-->

                <!--begin::Label-->
                <!-- <div class="col-lg-8 d-flex align-items-center">
                        <div class="form-check form-check-solid form-check-custom form-switch fv-row"> -->
                <!-- <input type="hidden" name="marketing" value="0"> -->
                <!-- <input class="form-check-input w-45px h-30px" type="checkbox" id="isSameAddress" name="isSameAddress" value="1" /> -->
                <!-- </div>
                    </div> -->
                <!--begin::Label-->
                <!-- </div> -->
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

                                <input type="text" id="perpetrator_address" name="perpetrator_address" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('perpetrator_address', $perpetrator_address->address ?? '') }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('RT') }}</label>
                                <input type="text" id="perpetrator_rt" name="perpetrator_rt" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('perpetrator_rt', $perpetrator_address->rt ?? '') }}" />
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('RW') }}</label>
                                <input type="text" id="perpetrator_rw" name="perpetrator_rw" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ old('perpetrator_rt', $perpetrator_address->rw ?? '') }}" />
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
                                    <option value="{{ $value->code }}" {{ $value->code == @$selected_province_perpetrator->code ? 'selected' :'' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kota') }}</label>

                                <select id="select_city_perpetrator" name="city_perpetrator" aria-label="{{ __('Pilih Kota') }}" data-control="select2" data-placeholder="{{ __('Pilih Kota') }}" class="form-select form-select-solid form-select-lg">
                                    <option value="{{ @$selected_city_perpetrator->code }}" selected>{{ @$selected_city_perpetrator->name }}</option>
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kecamatan') }}</label>
                                <select id="select_district_perpetrator" name="district_perpetrator" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg">
                                    <option value="{{ @$selected_district_perpetrator->code }}" selected>{{ @$selected_district_perpetrator->name }}</option>
                                </select>
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Kelurahan') }}</label>
                                <select id="select_village_perpetrator" name="village_perpetrator" data-control="select2" data-placeholder="Select" class="form-select form-select-solid form-select-lg">
                                    <option value="{{ @$selected_village_perpetrator->code }}" selected>{{ @$selected_village_perpetrator->name }}</option>
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

                <!--begin::Upload photo-->
                <div class="row mb-6">
                    <h1 style="margin-top: 20px;">Upload Foto</h1><br>
                    <p><i>Wajah tampak depan, kanan, kiri, foto KTP, cap sidik jari, kartu pelajar. dsb</i></p>
                </div>

                <div class="field" align="left">
                    <input type="file" id="files" name="files[]" multiple />
                    @foreach($profile_images as $key => $value)
                    <span class="pip">
                        <input type="text" name="old_files[{{$key}}]" style="display:none" value="{{ $value->file_path }}" />
                        <img class="imageThumb gambar" src="{{ url('uploads') .'/'. $value->file_path }}" data-gambar="{{ url('uploads') .'/'. $value->file_path }}" alt="gambar upload" title="" />
                        <span class="removeImage">Delete</span>
                    </span>
                    @endforeach
                </div>
                <!--end::Upload photo-->

                <div style="margin-top: 50px; margin-bottom: 30px;">
                    <hr>
                </div>

                <div class="row mb-6">
                    <h1 style="margin-top: 10px;">Detail Tindak Pidana</h1><br>
                </div>
                <input type="hidden" name="count_detail_tindak_pidana" value="{{ count($perpetrator_criminal_offenses) }}">
                <div id="detail-tindak-pidana">
                    @foreach($perpetrator_criminal_offenses as $key => $pco)
                    <div class="row mb-6" id="dynamicPidanaForm{{ $key }}">
                        <div class="row mb-6">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 fv-row">
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Pengadilan Negeri') }}</label>
                                        <input type="text" name="district_court[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $pco->district_court }}" />
                                    </div>

                                    <div class="col-lg-6 fv-row">
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Polres/Polsek') }}</label>
                                        <input type="text" name="police_station[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $pco->police_station }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6 fv-row">
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jenis Kejahatan') }}</label>
                                        <input type="text" name="crime[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $pco->crime }}" />
                                    </div>

                                    <div class="col-lg-6 fv-row">
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Penyelesaian') }}</label>
                                        <input type="text" name="adjudication[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $pco->adjudication }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12 fv-row">
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Catatan Tambahan') }}</label>
                                        <textarea name="crime_notes[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3">{{ $pco->notes }}</textarea>
                                    </div><br>
                                </div>
                            </div>
                        </div>
                        @if(count($perpetrator_criminal_offenses) != $key+1 || $key !== 0)
                        <hr>
                        @endif
                    </div>
                    @endforeach
                </div>
                @if((new \Jenssegers\Agent\Agent())->isDesktop())
                <div class="row mb-6">
                    <button type="button" name="addpidana" id="addpidana" class="btn btn-success" style="width: 200px; margin-left: 10px;">Tambah Pidana</button>
                    <button type="button" name="removepidana" id="removepidana" class="btn btn-danger" style="width: 200px; margin-left: 10px;">Hapus Pidana</button>
                </div>
                @else
                <div class="d-grid gap-2" style="margin-top: -20px;">
                    <button type="button" name="addpidana" id="addpidana" class="btn btn-success">Tambah Pidana</button>
                    <button type="button" name="removepidana" id="removepidana" class="btn btn-danger">Hapus Pidana</button>
                </div>
                @endif
            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary" id="kt_input_data_kejadian_submit">
                    @include('partials.general._button-indicator', ['label' => __('Simpan')])
                </button>
            </div>
            @else
            <div style="margin-bottom: 150px;"></div>
            <div class="fixed-bottom">
                <div class="shadow-lg rounded-top" style="min-height: 100px;background-color:#FFFFFF;padding:30px;">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" id="kt_input_data_kejadian_submit" style="background: #07315B;">
                            @include('partials.general._button-indicator', ['label' => __('Simpan')])
                        </button>
                        <a href="{{ route('perpetrator.detail', ['id' => request()->segment(4)]) }}" class="btn btn-default">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
            @endif
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <img src="" id="modal-gambar" alt="gambar" width="100%">

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // ---------------------------------------------------- START OF MULTIPLE UPLOAD ---------------------------------------------------- //
        $(".removeImage").click(function() {
            $(this).parent(".pip").remove();
        });

        $('.gambar').click(function() {
            $('#modal-gambar').attr('src', $(this).data('gambar'));
            $('#staticBackdrop').modal('show');
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

        let no_urut = parseInt(`{{ count($perpetrator_criminal_offenses) - 1 }}`);

        $('#addpidana').click(function() {
            no_urut++;
            $('#detail-tindak-pidana').append(`
                <div class="row mb-6" id="dynamicPidanaForm${no_urut}">
                    <div class="row mb-6">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Pengadilan Negeri') }}</label>
                                    <input type="text" name="district_court[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
                                </div>

                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Polres/Polsek') }}</label>
                                    <input type="text" name="police_station[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Jenis Kejahatan') }}</label>
                                    <input type="text" name="crime[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" required />
                                </div>

                                <div class="col-lg-6 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Penyelesaian') }}</label>
                                    <input type="text" name="adjudication[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 fv-row">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Catatan Tambahan') }}</label>
                                    <textarea name="crime_notes[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div><br>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            `);
        });

        $('#removepidana').click(function() {
            $('#dynamicPidanaForm' + no_urut).remove();
            no_urut--;
        });

    });
</script>