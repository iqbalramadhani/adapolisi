<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">{{ __('Riwayat Kasus') }}</h3>
        </div>
        <!--end::Card title-->

        <!--begin::Action-->
        <a class="btn btn-warning align-self-center" id="createNewOffender">{{ __('Tambah Kasus') }}</a>
        <!--end::Action-->
    </div>
    <!--begin::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-9">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                <!--begin::Table head-->
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="p-0 pb-3 min-w-100px text-center">Tanggal</th>
                        <th class="p-0 pb-3 min-w-100px text-center">Kejahatan</th>
                        <th class="p-0 pb-3 min-w-100px text-center">Alat</th>
                        <th class="p-0 pb-3 min-w-100px text-center">Motif</th>
                        <th class="p-0 pb-3 min-w-100px text-center">Jenis</th>
                        <th class="p-0 pb-3 min-w-100px text-center">STATUS</th>
                        <th class="p-0 pb-3 min-w-100px text-center">Sambang Internal</th>
                        <th class="p-0 pb-3 min-w-100px text-center">Sambang Eksternal</th>
                        <th class="p-0 pb-3 w-50px text-center">Action</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                @foreach($offenders as $offender)
                <tbody>
                    <tr>
                        <td class="text-center">{{$offender->created_at_formatted}}</td>
                        <td class="text-center">{{$offender->offenderCrimeIndication ? $offender->offenderCrimeIndication->crime_formatted : '-'}}</td>
                        <td class="text-center">{{$offender->offenderCrimeIndication ? ($offender->offenderCrimeIndication->equipment->name ?? '-' ) : '-'}}</td>
                        <td class="text-center">{{$offender->offenderCrimeIndication ? ($offender->offenderCrimeIndication->motive->name ?? '-') : '-'}}</td>
                        <td class="text-center">{{$offender->type_formatted}}</td>
                        <td class="text-center">
                            @if ($offender->status == 1)
                            <span class="badge py-3 px-4 fs-7 badge-light-primary">Pendataan</span>
                            @elseif ($offender->status == 2)
                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Tindakan</span>
                            @else
                            <span class="badge py-3 px-4 fs-7 badge-light-success">Ditutup</span>
                            @endif
                        </td>
                        <td class="text-center">{{$offender->offenderInternalVisit ? $offender->offenderInternalVisit->date_visit : '-'}}</td>
                        <td class="text-center">{{$offender->offenderInternalVisit ? $offender->offenderExternalVisit->date_visit : '-'}}</td>
                        <td>
                            <div class="d-flex">
                                @if ($offender->offenderCrimeIndication)
                                <a href="{{ route('perpetrator.editOffender', ['id' => $offender->id]) }}" class="btn btn-sm btn-light btn-active-light-primary">{{ __('Edit') }}</a>
                                @else
                                <a class="btn btn-sm btn-light btn-active-light-primary" disabled>{{ __('Edit') }}</a>
                                @endif
                                <button type="button" data-url="{{ route('perpetrator.deleteOffender',['id' => $offender->id]) }}" class="btn btn-sm btn-light btn-light-danger delete" style="margin-left: 10px;">{{ __('Delete') }}</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach

                <!--end::Table body-->
            </table>
        </div>
        <!--end::Table-->

    </div>
    <!--end::Card body-->
</div>
<!--end::details View-->

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="perpetrator_id" id="product_id" value="{{ request()->segment(3) }}">

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
        $('#createNewOffender').click(function() {
            $('#saveBtn').val("create-product");
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Buat Data Baru");
            $('#ajaxModel').modal('show');
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('perpetrator.addOffender') }}",
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
    });
</script>