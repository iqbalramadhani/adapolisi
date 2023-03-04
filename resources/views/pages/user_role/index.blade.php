<x-base-layout>

    <style>
        .label-aktif {
            width: 81px;
            height: 26px;
            background: #C9F7F5;
            border-radius: 6px;
            padding-top: 6px;
            box-shadow: 2px;


            font-family: 'Roboto';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 14px;
            /* identical to box height */

            text-align: center;

            color: #1BC5BD;
        }

        .label-non-aktif {
            width: 81px;
            height: 26px;
            background: #FFF4DE;
            border-radius: 6px;
            padding-top: 6px;
            box-shadow: 2px;


            font-family: 'Roboto';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 14px;
            /* identical to box height */

            text-align: center;

            color: #FFA800;
        }
    </style>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body p-9">
            <div style="display: flex; justify-content: space-between; ">
                <div>
                    <div class="input-group input-group-solid mb-5">
                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <form action="" method="get">
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2" />
                        </form>
                    </div>
                </div>
                <div>
                    <a href="{{ route('user_role.create') }}" class="btn btn-warning">Tambah User Baru</a>
                </div>
            </div>
        </div>
        <div class="card-body pt-6">
            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                <thead class="thead-light">
                    <tr>
                        <th><strong>NRP</strong></th>
                        <th><strong>Nama</strong></th>
                        <th><strong>Role</strong></th>
                        <th><strong>Email</strong></th>
                        <th><strong>No. Telepon</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $u)
                    <tr>
                        <td>{{ $u->nomor_registrasi_pokok }}</td>
                        <td>{{ $u->full_name }}</td>
                        <td>{{ $u->role->name ?? '' }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->no_telepon }}</td>
                        <td>
                            <div class="{{ $u->status ? 'label-aktif' : 'label-non-aktif' }}">{{ $u->status ? 'Aktif' : 'Non-Aktif' }}</div>
                        </td>
                        <td>
                            <a href="{{ route('user_role.edit',['user_role'=>$u->id]) }}" class="btn btn-light-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button data-url="{{ route('user_role.delete',['id'=>$u->id]) }}" class="delete btn btn-light-primary btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $user->appends(request()->query())->links() }}
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
        });
    </script>

</x-base-layout>