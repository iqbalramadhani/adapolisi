<x-base-layout>
    @if((new \Jenssegers\Agent\Agent())->isDesktop())
    @include('sweetalert::alert')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body p-9">
            <div class="d-flex justify-content-between">
                <form action="" id="form-filter" method="GET">
                    <div class="d-flex">
                        <input type="text" name="search" placeholder="cari data target" class="form-control" style="margin-right: 5px;">
                        <select name="step_filter" id="step_filter" class="form-control filter" style="margin-right: 5px;">
                            <option value="">-Pilih Data-</option>
                            <option value="fullfill">Data Profil Lengkap</option>
                            <option value="nofullfill">Data Profil Tidak Lengkap</option>
                            <option value="fulloffrenders">Data Kasus Lengkap</option>
                            <option value="nofulloffrenders">Data Kasus Tidak Lengkap</option>
                        </select>
                        <select name="motif" id="motif" class="form-control filter" style="margin-right: 5px;">
                            <option value="">-Pilih Motif-</option>
                            @foreach($motive as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                        <select name="event_time" id="event-time" class="form-control filter" style="margin-right: 5px;">
                            <option value="">-Pilih Waktu Kejadian-</option>
                            @foreach($time_event as $te)
                            <option value="{{ $te->id }}">{{ $te->name }}</option>
                            @endforeach
                        </select>
                        <select name="alat" id="alat" class="form-control filter" style="margin-right: 5px;">
                            <option value="">-Pilih Alat-</option>
                            @foreach($tool as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                        <select name="sarana" id="sarana" class="form-control filter" style="margin-right: 5px;">
                            <option value="">-Pilih Sarana-</option>
                            @foreach($mean as $m)
                            <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <button type="submit" class="btn btn-primary" id="createNewProduct">
                    @include('partials.general._button-indicator', ['label' => __('Buat Data Baru')])
                </button>
            </div>
        </div>
        <div class="card-body pt-6">
            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                <thead class="thead-light">
                    <tr>
                        <th><strong>NIK</strong></th>
                        <th><strong>Name</strong></th>
                        <th><strong>Jenis Kelamin</strong></th>
                        <th><strong>Usia</strong></th>
                        <th><strong>Kasus Aktif</strong></th>
                        <th><strong>Kasus Ditutup</strong></th>
                        <th><strong>No. Handphone</strong></th>
                        <th><strong>Created by</strong></th>
                        <th><strong>Polres</strong></th>
                        <th width="15%"><strong>Action</strong></th>
                    </tr>
                </thead>
                @if ( count($perpetrators) == 0 )
                <tr>
                    <td colspan="4" align="center">No Data Found</td>
                </tr>
                @else
                @foreach($perpetrators as $perpetrator)
                <tbody>
                    <tr>
                        <td>{{$perpetrator->nik}}</td>
                        <td>{{$perpetrator->name}}</td>
                        <td>{{$perpetrator->gender_formatted}}</td>
                        <td>{{$perpetrator->age}}</td>
                        <td>{{$perpetrator->kasus_aktif}}</td>
                        <td>{{$perpetrator->kasus_ditutup}}</td>
                        <td>{{$perpetrator->phone_number}}</td>
                        <td>{{$perpetrator->admin_name}}</td>
                        <td>{{$perpetrator->polres_name}}</td>
                        <td>
                            <a href="{{ route('perpetrator.detail', ['id' => $perpetrator->id]) }}" class="btn btn-sm btn-light btn-active-light-primary">{{ __('Detail') }}</a>
                            <button type="button" data-url="{{ route('log.deletePerpetrator',['id' => $perpetrator->id]) }}" class="btn btn-sm btn-light btn-light-danger delete" style="margin-left: 10px;">{{ __('Delete') }}</button>
                        </td>
                    </tr>
                </tbody>
                @endforeach
                @endif
            </table>
            {{ $perpetrators->appends(request()->query())->links() }}
        </div>

        <!--end::Card body-->
    </div>
    <!--end::Card-->

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <!--begin::Input group-->
                        <div class="row mb-6">

                            <!--begin::Col-->
                            <div class="col-lg-12">
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-12 fv-row">
                                        <label class="col-lg-12 col-form-label fw-bold fs-6">{{ __('Pilih jenis kasus berdasarkan target') }}</label>
                                        <select name="offender_type" aria-label="{{ __('Pilih Sarana') }}" data-control="select" data-placeholder="{{ __('Pilih..') }}" class="form-select form-select-solid form-select-lg">
                                            <option value="">{{ __('Pilih..') }}</option>
                                            <option value="1">Target Berpotensi</option>
                                            <option value="2">Target Pelaku</option>
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

                        <div class="card-footer d-flex justify-content-end py-6">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Lanjut
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#createNewProduct').click(function() {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Buat Data Baru");
                $('#ajaxModel').modal('show');
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('offender.create') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        window.location = data.url;
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('.delete').click(function() {
                const url = $(this).data('url');
                Swal.fire({
                    icon: 'info',
                    title: 'Apakah Anda yakin akan menghapus data ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Yakin',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });

            $('.filter').change(function() {
                $('#form-filter').submit();
            });

        });
    </script>

    @else

    <div class="card" style="margin-top: -30px;">
        <div class="card-body" style="min-height: 600px;">
            @if ( count($perpetrators) == 0 )
            <div class="text-center" style="margin-top: 250px;">
                <div class="">
                    <div>
                        <svg width="97" height="109" viewBox="0 0 97 109" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect y="0.679199" width="97" height="107.374" fill="url(#pattern0)" />
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_10041_28538" transform="translate(-0.0534759) scale(0.00216202 0.00195312)" />
                                </pattern>
                                <image id="image0_10041_28538" width="512" height="512" xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>
                        <h5>Data kasus belum tersedia</h5>
                    </div>
                </div>
            </div>
            @else
            <form action="" method="GET" style="width:150px;">
                <input type="text" name="search" value="{{ old('search') }}" placeholder="cari nama" class="form-control">
            </form>
            <div id="data-content">
                @foreach($perpetrators as $p)
                <div class="card shadow mt-5">
                    <div class="card-body">
                        <a href="{{ route('perpetrator.detail', ['id' => $p->id]) }}" style="text-decoration:none;color: inherit;">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="p-3 flex-fill">
                                        <img class="rounded" width="60px" src="{{ asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }}" alt="gambar">
                                    </div>
                                    <div>
                                        <p>{{ $p->nik }}</p>
                                        <h3>{{ $p->name }}</h3>
                                        <p>{{ $p->gender_formatted }} {{ $p->age }} tahun</p>
                                        @if(($p->kasus_aktif + $p->kasus_ditutup) == 0)
                                        <span class="badge py-3 px-4 fs-7 badge-light-warning">Data belum lengkap</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <p class="text-center">{{ date('d/m/Y',strtotime($p->date_of_birth)) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center" id="loading" style="margin-top: 50px;" style="display: none;">
                <div class="spinner-grow text-center" role="status"><span class=" visually-hidden">Loading...</span></div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            const baseUrl = `{{ URL::to('/') }}`;
            const lastPage = `{{ $perpetrators->lastPage() }}`;
            var page = 1;
            $(window).scroll(function() {
                if (page < lastPage && lastPage > 1) {
                    if (($(window).scrollTop() + $(window).height()) >= $(document).height() - 100) {
                        page++;
                        loadMoreData(page);
                    }
                }
            });


            function loadMoreData(page) {
                $.ajax({
                        url: '?page=' + page,
                        type: "get",
                        beforeSend: function() {
                            $('#loading').show();
                        },
                    })
                    .done(function(data) {
                        let detailData = ``;
                        data.data.map((el, i) => {
                            detailData += `<div class="card shadow mt-5">
                                <div class="card-body">
                                    <a href="${baseUrl+`/account/perpetrator/`+el.id}" style="text-decoration:none;color: inherit;">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <div class="p-3 flex-fill">
                                                    <img class="rounded" width="60px" src="{{ asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }}" alt="gambar">
                                                </div>
                                                <div>
                                                    <p>${ el.nik }</p>
                                                    <h3>${ el.name }</h3>
                                                    <p>${ el.gender_formatted } ${ el.age } tahun</p>
                                                </div>
                                            </div>
                                            <p>${formatDate(el.date_of_birth)}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>`;
                        });
                        $("#data-content").append(detailData);
                        $('#loading').hide();
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert('server not responding...');
                    });
            }

            function formatDate(date) {
                const today = new Date(date);
                const yyyy = today.getFullYear();
                let mm = today.getMonth() + 1; // Months start at 0!
                let dd = today.getDate();

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                return dd + '/' + mm + '/' + yyyy;
            }
        });
    </script>
    @endif



</x-base-layout>