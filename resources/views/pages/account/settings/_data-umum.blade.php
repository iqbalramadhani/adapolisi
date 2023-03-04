<!--begin::Basic info-->
<div class="card {{ $class }}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'others/step-data-umum.png') }}" class="center" style="display:block; height:20%; width:80%; margin-top:20px; margin-left:auto; margin-right:auto; margin-bottom:25px;">
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                        <input type="text" name="nik" class="form-control form-control-lg form-control-solid @error('nik') is-invalid @enderror" placeholder="Masukkan NIK KTP/KK " value="{{ old('nik') }}" />
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
                        <input type="text" name="name" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" placeholder="Nama Lengkap Pelaku" value="{{ old('name') }}" />
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
                        <span class="required">{{ __('Tanggal Lahir') }}</span>

                    </label>
                    <!--end::Label-->

                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="date" name="dob" class="form-control form-control-lg form-control-solid @error('dob') is-invalid @enderror" value="{{ old('dob') }}" />
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
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
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
                        <select name="job_id" aria-label="{{ __('Pilih Pekerjaan') }}" data-control="select2" data-placeholder="{{ __('Pilih Pekerjaan..') }}" class="form-select form-select-solid form-select-lg @error('gender') is-invalid @enderror">
                            <option value="">{{ __('Pilih Pekerjaan..') }}</option>
                            @foreach($jobs as $value)
                            <option value="{{ $value->id }}" {{ old('job_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
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
                        <input type="text" name="phone_number" class="form-control form-control-lg form-control-solid" placeholder="Masukkan No Handphone" value="{{ old('phone_number') }}" />
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
                        <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Email" value="{{ old('email') }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-white btn-active-light-primary me-2">{{ __('Reset') }}</button>

                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
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