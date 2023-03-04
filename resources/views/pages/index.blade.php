<x-base-layout>
    @php
    $userRole = auth()->user();

    $total_indikasi_individus = \App\Models\OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
    ->where('offenders.type', 1)
    ->where('offender_crime_indications.is_gang_crime', 0);

    if(!is_null($userRole->polres_code) || !is_null($userRole->polsek_code)){
    $total_indikasi_individus->where('offenders.polres_id', $userRole->polres_code);
    $total_indikasi_individus->orWhere('offenders.polsek_id', $userRole->polsek_code);
    }

    $total_indikasi_individu = $total_indikasi_individus->count();

    $total_pelaku_individus = \App\Models\OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
    ->where('offenders.type', 2)
    ->where('offender_crime_indications.is_gang_crime', 0);

    if(!is_null($userRole->polres_code) || !is_null($userRole->polsek_code)){
    $total_pelaku_individus->where('offenders.polres_id', $userRole->polres_code);
    $total_pelaku_individus->orWhere('offenders.polsek_id', $userRole->polsek_code);
    }

    $total_pelaku_individu = $total_pelaku_individus->count();

    $total_pelaku_kelompoks = \App\Models\OffenderCrimeIndication::join('offenders', 'offenders.id', '=', 'offender_crime_indications.offender_id')
    ->where('offenders.type', 2)
    ->where('offender_crime_indications.is_gang_crime', 1);

    if(!is_null($userRole->polres_code) || !is_null($userRole->polsek_code)){
    $total_pelaku_kelompoks->where('offenders.polres_id', $userRole->polres_code);
    $total_pelaku_kelompoks->orWhere('offenders.polsek_id', $userRole->polsek_code);
    }

    $total_pelaku_kelompok = $total_pelaku_kelompoks->count();

    @endphp
    @if((new \Jenssegers\Agent\Agent())->isDesktop())
    <!--begin::Row-->
    <div class="card card-flush mb-5 mb-xl-10">
        <!--begin::Card body-->
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <!-- <div class="me-11 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ asset(theme()->getMediaUrlPath() . 'others/logo-polda-metro-jaya.png') }}" alt="image" style="display: block; margin-left: auto; width: 100%; margin-right: auto;" />
                    </div>
                </div> -->
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
                                <!-- <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">POLDA METRO JAYA</a> -->
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
            <div class="d-flex overflow-auto h-55px justify-content-between">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 active" href="/">
                            Statistik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" href="/rangkuman">
                            Data Rangkuman
                        </a>
                    </li>
                    <!--end::Nav item-->
                </ul>
                <form action="" method="get" style="width:300px;">
                    <select name="polsek" id="polsek" class="form-control" data-control="select2">
                        <option value="">-Pilih Polsek-</option>
                    </select>
                </form>
            </div>
            <!--begin::Navs-->
        </div>
    </div>
    <div class="row">
        <!--begin::Col-->
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Pekerjaan Individu</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterIndividuJob" id="filterIndividuJob" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>
                    <!-- <h3>Pekerjaan Individu</h3> -->
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Statistik Alat</h3>
                        </div>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterEquipment" id="filterEquipment" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="equipmentChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Sarana</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterVehicle" id="filterVehicle" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="vehicleChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Jumlah Anggota</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterGangMember" id="filterGangMember" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="gangChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Pekerjaan Orang Tua</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterParentJob" id="filterParentJob" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="parentJobChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Motif</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterMotive" id="filterMotive" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="motiveChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Pola Waktu</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterTimePattern" id="filterTimePattern" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="timePatternChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Usia</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterAge" id="filterAge" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="ageChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Miras</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterAlchocol" id="filterAlchocol" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="alchoholChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5 mb-xl-10">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-6">
                        <!--begin::Title-->
                        <div class="col-lg-6 fv-row">
                            <h3 style="margin-top: 10px;">Narkoba</h3>
                        </div>

                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="col-lg-6 fv-row">
                            <select name="filterDrug" id="filterDrug" aria-label="{{ __('Filter') }}" data-placeholder="{{ __('Filter') }}" class="form-select form-select-solid form-select-lg fw-bold">
                                <option value="">{{ __('Filter') }}</option>
                                <option value="0">Hari Ini</option>
                                <option value="1">Kemarin</option>
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <canvas id="drugChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>



    <!-- <script src="{{ asset('plugin/chart-doughnutkable.js') }}"></script> -->

    <script>
        // $(document).ready(function() {
        const ctx = document.getElementById('myChart');
        const ctxEquipment = document.getElementById('equipmentChart');
        const ctxVehicle = document.getElementById('vehicleChart');
        const ctxGang = document.getElementById('gangChart');
        const ctxParentJob = document.getElementById('parentJobChart');
        const ctxMotive = document.getElementById('motiveChart');
        const pola_waktu = document.getElementById('timePatternChart');

        Chart.register(ChartDataLabels);

        // Filter Pola Waktu
        $('#filterTimePattern').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("timePatternChart")) {
                    Chart.getChart("timePatternChart").destroy();
                }
                const ctxNew = document.getElementById('timePatternChart');

                $.ajax({
                    url: `{{ route('statistic.filterTimePattern') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartPolaWaktu = new Chart(ctxNew, {
                            type: 'doughnut',
                            data: {
                                labels: [data[0].label, data[1].label, data[2].label, data[3].label, data[4].label, data[5].label, data[6].label, data[7].label, data[8].label, data[9].label, data[10].label, data[11].label],
                                datasets: [{
                                    label: '',
                                    data: [data[0].data, data[1].data, data[2].data, data[3].data, data[4].data, data[5].data, data[6].data, data[7].data, data[8].data, data[9].data, data[10].data, data[11].data],
                                    backgroundColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                        '#EE9D23',
                                        '#CB215F',
                                        '#05214D',
                                        '#07312B',
                                        '#5A7622',
                                    ],
                                    borderColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                        '#EE9D23',
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                        '#EE9D23',
                                        '#CB215F',
                                        '#05214D',
                                        '#07312B',
                                        '#5A7622',
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                animation: false,
                                responsive: true,
                                scales: {
                                    x: {
                                        display: false
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'center',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                    doughnutlabel: {
                                        labels: [{
                                            text: '550',
                                            font: {
                                                size: 20,
                                                weight: 'bold'
                                            }
                                        }, {
                                            text: 'total'
                                        }]
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter Usia
        $('#filterAge').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("ageChart")) {
                    Chart.getChart("ageChart").destroy();
                }
                const ctxNew = document.getElementById('ageChart');

                $.ajax({
                    url: `{{ route('statistic.filterAge') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartUsia = new Chart(ctxNew, {
                            type: 'doughnut',
                            data: {
                                labels: [data[0].key, data[1].key, data[2].key, data[3].key, data[4].key, data[5].key],
                                datasets: [{
                                    label: '',
                                    data: [data[0].value, data[1].value, data[2].value, data[3].value, data[4].value, data[5].value],
                                    backgroundColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE'
                                    ],
                                    borderColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                animation: false,
                                responsive: true,
                                scales: {
                                    x: {
                                        display: false
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'center',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                    doughnutlabel: {
                                        labels: [{
                                            text: '550',
                                            font: {
                                                size: 20,
                                                weight: 'bold'
                                            }
                                        }, {
                                            text: 'total'
                                        }]
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter Miras
        $('#filterAlchocol').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("alchoholChart")) {
                    Chart.getChart("alchoholChart").destroy();
                }
                const ctxNew = document.getElementById('alchoholChart');

                $.ajax({
                    url: `{{ route('statistic.filterAlchoholIndicate') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartMiras = new Chart(alchoholChart, {
                            type: 'pie',
                            data: {
                                labels: [data[0].key, data[1].key],
                                datasets: [{
                                    label: 'Miras',
                                    data: [data[0].value, data[1].value],
                                    backgroundColor: [
                                        '#EE9D23',
                                        '#07315B'
                                    ],
                                    borderColor: [
                                        '#EE9D23',
                                        '#07315B'
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'left',
                                        // align: 'end',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter Narkoba
        $('#filterDrug').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("drugChart")) {
                    Chart.getChart("drugChart").destroy();
                }
                const ctxNew = document.getElementById('drugChart');

                $.ajax({
                    url: `{{ route('statistic.filterDrugIndicate') }}?filter=${filterValue&polsek}=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartNarkoba = new Chart(drugChart, {
                            type: 'pie',
                            data: {
                                labels: [data[0].key, data[1].key],
                                datasets: [{
                                    label: 'Narkoba',
                                    data: [data[0].value, data[1].value],
                                    backgroundColor: [
                                        '#EE9D23',
                                        '#07315B',
                                    ],
                                    borderColor: [
                                        '#EE9D23',
                                        '#07315B',
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'left',
                                        // align: 'end',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter Pekerjaan Individu
        $('#filterIndividuJob').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("myChart")) {
                    Chart.getChart("myChart").destroy();
                }
                const ctxNew = document.getElementById('myChart');

                $.ajax({
                    url: `{{ route('statistic.filterIndividuJob') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const myChart = new Chart(ctxNew, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter Alat
        $('#filterEquipment').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("equipmentChart")) {
                    Chart.getChart("equipmentChart").destroy();
                }
                const ctxEquipmentNew = document.getElementById('equipmentChart');

                $.ajax({
                    url: `{{ route('statistic.filterEquipment') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const myChart = new Chart(ctxEquipmentNew, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter sarana
        $('#filterVehicle').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("vehicleChart")) {
                    Chart.getChart("vehicleChart").destroy();
                }
                const ctxEquipmentNew = document.getElementById('vehicleChart');

                $.ajax({
                    url: `{{ route('statistic.filterVehicle') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const myChart = new Chart(ctxEquipmentNew, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter Jumlah Anggota 
        $('#filterGangMember').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("gangChart")) {
                    Chart.getChart("gangChart").destroy();
                }
                const ctxEquipmentNew = document.getElementById('gangChart');

                $.ajax({
                    url: `{{ route('statistic.filterGangMember') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const myChart = new Chart(ctxEquipmentNew, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Filter Jumlah Anggota 
        $('#filterParentJob').change(function() {
            //set id
            let filterValue = $(this).val();
            if (filterValue) {

                if (Chart.getChart("parentJobChart")) {
                    Chart.getChart("parentJobChart").destroy();
                }
                const ctxEquipmentNew = document.getElementById('parentJobChart');

                $.ajax({
                    url: `{{ route('statistic.filterParentJob') }}?filter=${filterValue}&polsek=${$('#polsek').val()}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const myChart = new Chart(ctxEquipmentNew, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        $.ajax({
            url: "{{ route('statistic.filterIndividuJob') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [''],
                        datasets: data,
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        scales: {
                            x: {
                                display: true
                            },
                            y: {
                                display: false,
                            }
                        },
                        plugins: {
                            datalabels: {
                                display: true,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 12,
                                },
                                textAlign: 'center',
                                anchor: 'start',
                                align: 'bottom',
                            },
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                }
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        const ageChart = document.getElementById('ageChart');

        $.ajax({
            url: "{{ route('statistic.filterAge') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const ChartUsia = new Chart(ageChart, {
                    type: 'doughnut',
                    data: {
                        labels: [data[0].key, data[1].key, data[2].key, data[3].key, data[4].key, data[5].key],
                        datasets: [{
                            label: '',
                            data: [data[0].value, data[1].value, data[2].value, data[3].value, data[4].value, data[5].value],
                            backgroundColor: [
                                '#CB212F',
                                '#05213D',
                                '#07315B',
                                '#5A7692',
                                '#ACBAC8',
                                '#CDD6DE',
                                '#D4DAEE'
                            ],
                            borderColor: [
                                '#CB212F',
                                '#05213D',
                                '#07315B',
                                '#5A7692',
                                '#ACBAC8',
                                '#CDD6DE',
                                '#D4DAEE',
                            ],
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        animation: false,
                        responsive: true,
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false,
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    // pointStyleWidth: 5,
                                }
                            },
                            datalabels: {
                                display: true,
                                backgroundColor: '#F3F0F0',
                                borderRadius: 30,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 20,
                                },
                                textAlign: 'center',
                                anchor: 'end',
                                padding: 10,
                            },
                            doughnutlabel: {
                                labels: [{
                                    text: '550',
                                    font: {
                                        size: 20,
                                        weight: 'bold'
                                    }
                                }, {
                                    text: 'total'
                                }]
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            url: "{{ route('statistic.filterTimePattern') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const ChartPolaWaktu = new Chart(pola_waktu, {
                    type: 'doughnut',
                    data: {
                        labels: [data[0].label, data[1].label, data[2].label, data[3].label, data[4].label, data[5].label, data[6].label, data[7].label, data[8].label, data[9].label, data[10].label, data[11].label],
                        datasets: [{
                            label: '',
                            data: [data[0].data, data[1].data, data[2].data, data[3].data, data[4].data, data[5].data, data[6].data, data[7].data, data[8].data, data[9].data, data[10].data, data[11].data],
                            backgroundColor: [
                                '#CB212F',
                                '#05213D',
                                '#07315B',
                                '#5A7692',
                                '#ACBAC8',
                                '#CDD6DE',
                                '#D4DAEE',
                                '#EE9D23',
                                '#CB215F',
                                '#05214D',
                                '#07312B',
                                '#5A7622',
                            ],
                            borderColor: [
                                '#CB212F',
                                '#05213D',
                                '#07315B',
                                '#5A7692',
                                '#ACBAC8',
                                '#CDD6DE',
                                '#D4DAEE',
                                '#EE9D23',
                                '#CB212F',
                                '#05213D',
                                '#07315B',
                                '#5A7692',
                                '#ACBAC8',
                                '#CDD6DE',
                                '#D4DAEE',
                                '#EE9D23',
                                '#CB215F',
                                '#05214D',
                                '#07312B',
                                '#5A7622',
                            ],
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        animation: false,
                        responsive: true,
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false,
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    // pointStyleWidth: 5,
                                }
                            },
                            datalabels: {
                                display: true,
                                backgroundColor: '#F3F0F0',
                                borderRadius: 30,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 20,
                                },
                                textAlign: 'center',
                                anchor: 'end',
                                padding: 10,
                            },
                            doughnutlabel: {
                                labels: [{
                                    text: '550',
                                    font: {
                                        size: 20,
                                        weight: 'bold'
                                    }
                                }, {
                                    text: 'total'
                                }]
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });


        const alchoholChart = document.getElementById('alchoholChart');
        $.ajax({
            url: "{{ route('statistic.filterAlchoholIndicate') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const ChartMiras = new Chart(alchoholChart, {
                    type: 'pie',
                    data: {
                        labels: [data[0].key, data[1].key],
                        datasets: [{
                            label: 'Miras',
                            data: [data[0].value, data[1].value],
                            backgroundColor: [
                                '#EE9D23',
                                '#07315B'
                            ],
                            borderColor: [
                                '#EE9D23',
                                '#07315B'
                            ],
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    // pointStyleWidth: 5,
                                }
                            },
                            datalabels: {
                                display: true,
                                backgroundColor: '#F3F0F0',
                                borderRadius: 30,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 20,
                                },
                                textAlign: 'left',
                                // align: 'end',
                                anchor: 'end',
                                padding: 10,
                            },
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        const drugChart = document.getElementById('drugChart');
        $.ajax({
            url: "{{ route('statistic.filterDrugIndicate') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const ChartNarkoba = new Chart(drugChart, {
                    type: 'pie',
                    data: {
                        labels: [data[0].key, data[1].key],
                        datasets: [{
                            label: 'Narkoba',
                            data: [data[0].value, data[1].value],
                            backgroundColor: [
                                '#EE9D23',
                                '#07315B',
                            ],
                            borderColor: [
                                '#EE9D23',
                                '#07315B',
                            ],
                            borderWidth: 1,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    // pointStyleWidth: 5,
                                }
                            },
                            datalabels: {
                                display: true,
                                backgroundColor: '#F3F0F0',
                                borderRadius: 30,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 20,
                                },
                                textAlign: 'left',
                                // align: 'end',
                                anchor: 'end',
                                padding: 10,
                            },
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            url: "{{ route('statistic.filterEquipment') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const equipmentChart = new Chart(ctxEquipment, {
                    type: 'bar',
                    data: {
                        labels: [''],
                        datasets: data,
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        scales: {
                            x: {
                                display: true
                            },
                            y: {
                                display: false,
                            }
                        },
                        plugins: {
                            datalabels: {
                                display: true,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 12,
                                },
                                textAlign: 'center',
                                anchor: 'start',
                                align: 'bottom',
                            },
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                }
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            url: "{{ route('statistic.filterVehicle') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const vehicleChart = new Chart(ctxVehicle, {
                    type: 'bar',
                    data: {
                        labels: [''],
                        datasets: data,
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        scales: {
                            x: {
                                display: true
                            },
                            y: {
                                display: false,
                            }
                        },
                        plugins: {
                            datalabels: {
                                display: true,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 12,
                                },
                                textAlign: 'center',
                                anchor: 'start',
                                align: 'bottom',
                            },
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                }
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            url: "{{ route('statistic.filterGangMember') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const gangChart = new Chart(ctxGang, {
                    type: 'bar',
                    data: {
                        labels: [''],
                        datasets: data,
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        scales: {
                            x: {
                                display: true
                            },
                            y: {
                                display: false,
                            }
                        },
                        plugins: {
                            datalabels: {
                                display: true,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 12,
                                },
                                textAlign: 'center',
                                anchor: 'start',
                                align: 'bottom',
                            },
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                }
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            url: "{{ route('statistic.filterParentJob') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const parentJobChart = new Chart(ctxParentJob, {
                    type: 'bar',
                    data: {
                        labels: [''],
                        datasets: data,
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        scales: {
                            x: {
                                display: true
                            },
                            y: {
                                display: false,
                            }
                        },
                        plugins: {
                            datalabels: {
                                display: true,
                                font: {
                                    color: 'red',
                                    weight: 'bold',
                                    size: 12,
                                },
                                textAlign: 'center',
                                anchor: 'start',
                                align: 'bottom',
                            },
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                }
                            }
                        }
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        $.ajax({
            url: "{{ route('statistic.filterMotiveCrime') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                const motiveChart = new Chart(ctxMotive, {
                    type: 'bar',
                    data: {
                        labels: [''],
                        datasets: data,
                    },
                    plugins: [ChartDataLabels],
                    options: {
                        indexAxis: 'y',
                        elements: {
                            bar: {
                                // borderSkipped: false,
                                borderWidth: 0.1,
                                borderRadius: 0.5,
                            }
                        },
                        responsive: true,
                        scales: {
                            x: {
                                display: true
                            },
                            y: {
                                display: false,
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    // pointStyleWidth: 5,
                                }
                            }
                        },
                    }
                });
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        // Get List Polsek
        $.ajax({
            url: "{{ route('index.ListPolsek') }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                let polsek = '';
                polsek += `<option value="">-Pilih Polsek-</option>`;
                data.map((el) => {
                    polsek += `<option value="${el.id}">${el.name}</option>`;
                });
                $('#polsek').html(polsek);
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });

        $(document).ready(function() {
            $(document).on('change', '#polsek', function() {

                const polsek = $(this).val();

                // Pekerjaan Individu
                Chart.getChart('myChart').destroy();

                const individu = $('#filterIndividuJob').val();
                $.ajax({
                    url: `{{ route('statistic.filterIndividuJob') }}?filter=${individu}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('ageChart').destroy();
                const filterAge = $('#filterAge').val();

                $.ajax({
                    url: `{{ route('statistic.filterAge') }}?filter=${filterAge}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartUsia = new Chart($('#ageChart'), {
                            type: 'doughnut',
                            data: {
                                labels: [data[0].key, data[1].key, data[2].key, data[3].key, data[4].key, data[5].key],
                                datasets: [{
                                    label: '',
                                    data: [data[0].value, data[1].value, data[2].value, data[3].value, data[4].value, data[5].value],
                                    backgroundColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE'
                                    ],
                                    borderColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                animation: false,
                                responsive: true,
                                scales: {
                                    x: {
                                        display: false
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'center',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                    doughnutlabel: {
                                        labels: [{
                                            text: '550',
                                            font: {
                                                size: 20,
                                                weight: 'bold'
                                            }
                                        }, {
                                            text: 'total'
                                        }]
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('timePatternChart').destroy();
                const filterTimePattern = $('#filterTimePattern').val();

                $.ajax({
                    url: `{{ route('statistic.filterTimePattern') }}?filter=${filterTimePattern}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartPolaWaktu = new Chart(pola_waktu, {
                            type: 'doughnut',
                            data: {
                                labels: [data[0].label, data[1].label, data[2].label, data[3].label, data[4].label, data[5].label, data[6].label, data[7].label, data[8].label, data[9].label, data[10].label, data[11].label],
                                datasets: [{
                                    label: '',
                                    data: [data[0].data, data[1].data, data[2].data, data[3].data, data[4].data, data[5].data, data[6].data, data[7].data, data[8].data, data[9].data, data[10].data, data[11].data],
                                    backgroundColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                        '#EE9D23',
                                        '#CB215F',
                                        '#05214D',
                                        '#07312B',
                                        '#5A7622',
                                    ],
                                    borderColor: [
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                        '#EE9D23',
                                        '#CB212F',
                                        '#05213D',
                                        '#07315B',
                                        '#5A7692',
                                        '#ACBAC8',
                                        '#CDD6DE',
                                        '#D4DAEE',
                                        '#EE9D23',
                                        '#CB215F',
                                        '#05214D',
                                        '#07312B',
                                        '#5A7622',
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                animation: false,
                                responsive: true,
                                scales: {
                                    x: {
                                        display: false
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'center',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                    doughnutlabel: {
                                        labels: [{
                                            text: '550',
                                            font: {
                                                size: 20,
                                                weight: 'bold'
                                            }
                                        }, {
                                            text: 'total'
                                        }]
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('alchoholChart').destroy();
                const filterAlchocol = $('#filterAlchocol').val();
                $.ajax({
                    url: `{{ route('statistic.filterAlchoholIndicate') }}?filter=${filterAlchocol}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartMiras = new Chart($('#alchoholChart'), {
                            type: 'pie',
                            data: {
                                labels: [data[0].key, data[1].key],
                                datasets: [{
                                    label: 'Miras',
                                    data: [data[0].value, data[1].value],
                                    backgroundColor: [
                                        '#EE9D23',
                                        '#07315B'
                                    ],
                                    borderColor: [
                                        '#EE9D23',
                                        '#07315B'
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'left',
                                        // align: 'end',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('drugChart').destroy();
                const filterDrug = $('#filterDrug').val();
                $.ajax({
                    url: `{{ route('statistic.filterDrugIndicate') }}?filter=${filterDrug}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const ChartNarkoba = new Chart($('#drugChart'), {
                            type: 'pie',
                            data: {
                                labels: [data[0].key, data[1].key],
                                datasets: [{
                                    label: 'Narkoba',
                                    data: [data[0].value, data[1].value],
                                    backgroundColor: [
                                        '#EE9D23',
                                        '#07315B',
                                    ],
                                    borderColor: [
                                        '#EE9D23',
                                        '#07315B',
                                    ],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    },
                                    datalabels: {
                                        display: true,
                                        backgroundColor: '#F3F0F0',
                                        borderRadius: 30,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        textAlign: 'left',
                                        // align: 'end',
                                        anchor: 'end',
                                        padding: 10,
                                    },
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('equipmentChart').destroy();
                const filterEquipment = $('#filterEquipment').val();
                $.ajax({
                    url: `{{ route('statistic.filterEquipment') }}?filter=${filterEquipment}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const equipmentChart = new Chart(ctxEquipment, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('vehicleChart').destroy();
                const filterVehicle = $('#filterVehicle').val();
                $.ajax({
                    url: `{{ route('statistic.filterVehicle') }}?filter=${filterVehicle}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const vehicleChart = new Chart(ctxVehicle, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('gangChart').destroy();
                const filterGangMember = $('#filterGangMember').val();
                $.ajax({
                    url: `{{ route('statistic.filterGangMember') }}?filter=${filterGangMember}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const gangChart = new Chart(ctxGang, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('parentJobChart').destroy();
                const filterParentJob = $('#filterParentJob').val();
                $.ajax({
                    url: `{{ route('statistic.filterParentJob') }}?filter=${filterParentJob}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const parentJobChart = new Chart(ctxParentJob, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        display: true,
                                        font: {
                                            color: 'red',
                                            weight: 'bold',
                                            size: 12,
                                        },
                                        textAlign: 'center',
                                        anchor: 'start',
                                        align: 'bottom',
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

                Chart.getChart('motiveChart').destroy();
                const filterMotive = $('#filterMotive').val();
                $.ajax({
                    url: `{{ route('statistic.filterMotiveCrime') }}?filter=${filterMotive}&polsek=${polsek}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        const motiveChart = new Chart(ctxMotive, {
                            type: 'bar',
                            data: {
                                labels: [''],
                                datasets: data,
                            },
                            plugins: [ChartDataLabels],
                            options: {
                                indexAxis: 'y',
                                elements: {
                                    bar: {
                                        // borderSkipped: false,
                                        borderWidth: 0.1,
                                        borderRadius: 0.5,
                                    }
                                },
                                responsive: true,
                                scales: {
                                    x: {
                                        display: true
                                    },
                                    y: {
                                        display: false,
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            // pointStyleWidth: 5,
                                        }
                                    }
                                },
                            }
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });



        // });
    </script>
    @else

    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" style="margin-top: -30px;" id="kt_profile_details_view">
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
        <div class="card-body p-9" style="min-height: 500px;" id="data-content"></div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('index.RangkumanMobile') }}",
                type: "GET",
                dataType: 'json',
                beforeSend: function() {
                    $('#data-content').html(`
                    <div class="text-center" style="margin-top: 100px;">
                        <div class="spinner-grow text-center" role="status"">
                            <span class="visually-hidden">Loading...</span>
                        </div></div>`);
                },
                success: function(data) {
                    let card = `<div class="table-responsive"><table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4"><tbody>`;
                    data.map((el, index) => {
                        card += `<tr>
                            <td>
                                <h1>${index+1}</h1>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">${el.polsek}</a>
                                <span class="text-muted fw-bold d-block">Pola waktu ${el.waktu}</span>
                                <span class="text-muted fw-bold d-block">Wilayah: ${el.subdistrict.subdistrict_name.name}</span>
                            </td>
                            <td class="text-muted fw-bold">
                                ${el.value} Kasus
                            </td>
                        </tr>`;
                    });
                    card += ` </tbody></table></div>`
                    $('#data-content').html(card);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
    @endif


</x-base-layout>