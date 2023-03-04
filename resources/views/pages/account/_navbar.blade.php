@php
$nav = array(
array('title' => 'Riwayat Kasus', 'view' => 'account/overview'),
// array('title' => 'Edit Profil', 'view' => 'account/settings'),
// array('title' => 'Security', 'view' => ''),
);
@endphp

<!--begin::Navbar-->
<div class="card {{ $class }}">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <!--begin: Pic-->
            <div class="me-12 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ $image ? url('uploads') .'/'. $image->file_path : asset(theme()->getMediaUrlPath().'avatars/blank.png') }}" alt="image" width="150px" height="150px" class="rounded gambar" data-gambar="{{ $image ? url('uploads') .'/'. $image->file_path : asset(theme()->getMediaUrlPath().'avatars/blank.png') }}" />
                    <!-- <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div> -->
                </div>
                <br><br>

                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $active_offenders }}">0</div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-bold fs-6 text-gray-400">{{ __('Kasus Aktif') }}</div>
                    <!--end::Label-->
                </div>

                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $closed_offenders }}">0</div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-bold fs-6 text-gray-400">{{ __('Kasus Ditutup') }}</div>
                    <!--end::Label-->
                </div>

            </div>
            <!--end::Pic-->

            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <h1 class="text-gray-800 text-hover-primary fw-bolder me-1"><u>{{ $perpetrator->name ?? '' }}</u></h1>
                        </div>
                        <!--end::Name-->

                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="row col-lg-6">
                            <!--begin::Label-->
                            <label class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ __('NIK') }}</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ $perpetrator->nik ?? '-' }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="row col-lg-6">
                            <!--begin::Label-->
                            <label class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ __('Tanggal Lahir') }}</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ $perpetrator->date_of_birth ? date('d-m-Y',strtotime($perpetrator->date_of_birth)) : '-' }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="row col-lg-6">
                            <!--begin::Label-->
                            <label class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ __('Jenis Kelamin') }}</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ $perpetrator->gender_formatted ?? '-' }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="row col-lg-6">
                            <!--begin::Label-->
                            <label class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ __('Pekerjaan') }}</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ $perpetrator->job_formatted ?? '-' }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="row col-lg-6">
                            <!--begin::Label-->
                            <label class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ __('No. Handphone') }}</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ $perpetrator->phone_number ?? '-' }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->

                <!--begin::Stats-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="row col-lg-6">
                            <!--begin::Label-->
                            <label class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ __('PIC Sambang') }}</span>
                            </label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-6 col-form-label fw-bold fs-6">
                                <span>{{ count($offenders) > 0 ? $offenders[count($offenders)-1]->offenderInternalVisit->pic_name ?? $offenders[count($offenders)-1]->offenderExternalVisit->pic_name ?? '-' : '-' }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Stats-->

            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->

        <!--begin::Navs-->
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="{{ route('perpetrator.detail', ['id' => request()->segment(3)]) }}">
                        Riwayat Kasus
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" href="{{ route('perpetrator.editProfile', ['id' => request()->segment(3)]) }}">
                        Edit Profile
                    </a>
                </li>
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->

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
            console.log('gambar');
            $('#modal-gambar').attr('src', $(this).data('gambar'));
            $('#staticBackdrop').modal('show');
        });

    });
</script>