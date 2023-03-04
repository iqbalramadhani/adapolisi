<x-base-layout>

    <!--begin::Row-->
    <div class="card card-flush mb-5 mb-xl-10">
        <!--begin::Card body-->
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <div class="me-11 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ asset(theme()->getMediaUrlPath() . 'others/logo-polda-metro-jaya.png') }}" alt="image" style="display: block; margin-left: auto; width: 100%; margin-right: auto;" />
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
                            <div class="d-flex align-items-center mb-15">
                                <h1>POLDA METRO JAYA</h1>
                                <!-- <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1"></a> -->
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
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $total_indikasi_individu }}">0</div>
                                    </div>
                                    <!--end::Number-->

                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('Total Indikasi Individu') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->

                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $total_pelaku_individu }}">0</div>
                                    </div>
                                    <!--end::Number-->

                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('Total Pelaku Individu') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->

                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="{{ $total_pelaku_kelompok }}">0</div>
                                    </div>
                                    <!--end::Number-->

                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('Total Pelaku Kelompok') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
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
                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" href="/">
                            Statistik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" href="/rangkuman">
                            Data Rangkuman
                        </a>
                    </li>
                    <!--end::Nav item-->
                </ul>
            </div>
            <!--begin::Navs-->
        </div>
    </div>

    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('Kasus Tertinggi') }}</h3><br>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->

        <!--begin::Card body-->
        <div class="card-body p-9">
                <!--begin::Table container-->
                <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="border-0">
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-110px"></th>
                                <th class="p-0 min-w-50px"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            
                            <tbody>
                            @php($i = 1)
                            @foreach($sorted_data as $data)
                                <tr>
                                    <td>
                                        <div class="symbol symbol-45px me-2">
                                            <span class="symbol-label">
                                                {{ $i }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $data['polsek'] }}</a>
                                        <span class="text-muted fw-bold d-block">Pola waktu {{ $data['waktu'] }}</span>
                                        <span class="text-muted fw-bold d-block">Wilayah: {{ $data['subdistrict']['subdistrict_name']['name'] }}</span>
                                    </td>
                                    <td class="text-end text-muted fw-bold"></td>
                                    <td class="text-end"></td>
                                    <td class="text-end text-muted fw-bold">
                                        {{ $data['value'] }} Kasus
                                    </td>
                                    
                                </tr>
                            @php($i++)
                            @endforeach
                            </tbody>
                            
                            <!--end::Table body-->
                        </table>
                </div>
                <!--end::Table-->

        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

</x-base-layout>