<!--begin::Basic info-->
<div class="card {{ $class }}" style="@if(!(new \Jenssegers\Agent\Agent())->isDesktop()) margin-top: -30px; @endif">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'others/step-data-umum.png') }}" class="center" style="display:block; height:20%; width:80%; margin-top:20px; margin-left:auto; margin-right:auto; margin-bottom:25px;">
        @else
        <svg width="100%" height="100%" viewBox="0 0 299 28" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 20px;>
            <path d="M14.2231 14H149.223" stroke="#1D99B4" stroke-width="2" />
            <rect x="0.223145" width="28" height="28" rx="14" fill="#1D99B4" />
            <path d="M15.5566 7.33325H10.2232C9.8696 7.33325 9.53047 7.47373 9.28042 7.72378C9.03037 7.97382 8.88989 8.31296 8.88989 8.66659V19.3333C8.88989 19.6869 9.03037 20.026 9.28042 20.2761C9.53047 20.5261 9.8696 20.6666 10.2232 20.6666H18.2232C18.5768 20.6666 18.916 20.5261 19.166 20.2761C19.4161 20.026 19.5566 19.6869 19.5566 19.3333V11.3333L15.5566 7.33325Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M15.5564 7.33325V11.3333H19.5564" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M16.8897 14.6667H11.5564" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M16.8897 17.3333H11.5564" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12.8897 12H12.2231H11.5564" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M149.223 14H284.223" stroke="#AFAFAF" stroke-width="2" stroke-dasharray="4 4" />
            <circle cx="149.223" cy="14" r="6" fill="#AFAFAF" />
            <circle cx="284.223" cy="14" r="6" fill="#AFAFAF" />
        </svg>
        <h3 class="mt-5" style="color: #232F6B;">Data Umum</h3>
        @endif
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ route('settings.updateDataUmum') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--begin::Card body-->
            <input type="hidden" name="offender_id" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ request()->segment(4) }}" />
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
                        <input type="text" name="name" class="form-control form-control-lg form-control-solid  @error('name') is-invalid @enderror" placeholder="Nama Lengkap Pelaku" value="{{ old('name') }}" />
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
                        <input type="date" name="dob" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" value="{{ old('dob') }}" />
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
                            <option value="P" {{ old('gender') }}>Perempuan</option>
                            <option value="L">Laki-laki</option>
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
                        <select name="job_id" aria-label="{{ __('Pilih Pekerjaan') }}" data-control="select2" data-placeholder="{{ __('Pilih Pekerjaan..') }}" class="form-select form-select-solid form-select-lg fw-bold @error('job_id') is-invalid @enderror">
                            <option value="">{{ __('Pilih Pekerjaan..') }}</option>
                            @foreach($jobs as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                        <input type="text" name="phone_number" class="form-control form-control-lg form-control-solid" placeholder="Masukkan No Handphone" value="" />
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
                        <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="Masukkan Email" value="" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

            </div>
            <!--end::Card body-->

            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('log.system.index') }}" class="btn btn-light btn-active-light-primary" style="margin-right: 10px;">{{ __('Kembali') }}</a>

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