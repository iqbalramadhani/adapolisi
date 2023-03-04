<x-base-layout>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body p-9">
            <a href="{{ route('user_role.index') }}" class="btn btn-default"><img src="{{ asset('storage/icon/button-back.png') }}" width="25px" alt=""> Data Pengguna</a>

        </div>
        <div class="card-body pt-6">
            <form action="{{ route('user_role.store') }}" id="form-store" method="post">
                @csrf
                <input type="hidden" name="id_user" value="{{ isset($detail) ? $detail->id : '' }}">
                <h1>Akun</h1>
                <div class="row mb-5">
                    <div class="col-6">
                        <div class="form-group row mb-5">
                            <label class="col-2 col-form-label required ">Role</label>
                            <div class="col-10">
                                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                    <option value="">Pilih Role Akun</option>
                                    @foreach($role as $r)
                                    <option value="{{ $r->id }}" {{ isset($detail) && $detail->role_id == $r->id ? 'selected' : (old('role_id') == $r->id ? 'selected' : '') }}>{{ $r->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="" class="col-2 col-form-label required ">Status</label>
                            <div class="col-10">
                                <select name="status" class="form-control">
                                    <option value="0" {{ isset($detail) && $detail->status == '0' ? 'selected' : (old('status') == '0' ? 'selected' : '') }}>Non-aktif</option>
                                    <option value="1" {{ isset($detail) && $detail->status == '1' ? 'selected' : (old('status') == '1' ? 'selected' : '') }}>Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-6 mr-auto mb-5">
                        <div class="form-group row">
                            <label for="" class="col-2 col-form-label required">Email</label>
                            <div class="col-10">
                                @if(isset($detail))
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $detail->email }}">
                                @else
                                <input type="email" placeholder="Masukkan Email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($detail) ? $detail->email : old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @php
                if(!isset($detail)){
                @endphp
                <div class="row mb-5">
                    <div class="col-6">
                        <div class="form-group row">
                            <label class="col-2 col-form-label required ">Password</label>
                            <div class="col-10">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan Password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="" class="col-3 col-form-label required">Konfirm Password</label>
                            <div class="col-9">
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" required placeholder="Konfirmasi Password">
                            </div>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                @php
                }
                @endphp

                <h1>Detail Akun</h1>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row mb-5">
                            <label class="col-3 col-form-label required">Nomor Registrasi Pokok</label>
                            <div class="col-9">
                                @if(isset($detail))
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $detail->nomor_registrasi_pokok }}">
                                @else
                                <input type="text" name="nomor_registrasi_pokok" value="{{ isset($detail) ? $detail->nomor_registrasi_pokok : old('nomor_registrasi_pokok')}}" placeholder="Masukkan Nomor Registrasi Pokok" class="form-control @error('nomor_registrasi_pokok') is-invalid @enderror" required>
                                @error('nomor_registrasi_pokok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="" class="col-3 col-form-label required">Nama Lengkap</label>
                            <div class="col-9">
                                <input type="text" name="full_name" placeholder="Masukkan Nama Lengkap" value="{{ isset($detail) ? $detail->full_name : old('full_name')}}" class="form-control @error('full_name') is-invalid @enderror" required>
                                @error('full_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Polres</label>
                            <div class="col-10">
                                <select name="polres_code" id="polres_code" class="form-control">
                                    <option value="">Pilih Polres</option>
                                    @foreach($polres as $pls)
                                    <option value="{{ $pls->id }}" {{ isset($detail) && $detail->polres_code == $pls->id ? 'selected' : '' }}>{{ $pls->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-5">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Polsek</label>
                            <div class="col-10">
                                <select name="polsek_code" id="polsek_code" class="form-control">
                                    <option value="">Pilih Polsek</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="" class="col-1 col-form-label required">Jabatan</label>
                            <div class="col-11">
                                <input type="text" name="jabatan" placeholder="Masukkan Jabatan" value="{{ isset($detail) ? $detail->jabatan : old('jabatan')}}" class="form-control @error('jabatan') is-invalid @enderror">
                                @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="" class="col-2 col-form-label required">No Telepon</label>
                            <div class="col-10">
                                <input type="number" name="no_telepon" placeholder="Masukkan No Telepon yang dapat dihubungi" value="{{ isset($detail) ? $detail->no_telepon : old('no_telepon')}}" class="form-control  @error('no_telepon') is-invalid @enderror">
                                @error('no_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <input type="hidden" name="old_no_telepon" value="{{ isset($detail) ? $detail->no_telepon : ''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: flex;justify-content:flex-end;">
                    <button type="button" id="submit-akun" class="btn btn-secondary">{{ isset($detail) ? 'Simpan' : 'Buat Akun' }}</button>
                </div>
            </form>
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

            const polres = `{{ isset($detail) ? $detail->polres_code : '' }}`;
            const polsek = `{{ isset($detail) ? $detail->polsek_code : '' }}`;

            if (polres !== '') {
                load_polsek(polres, polsek);
            }

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

            $('#polres_code').change(function() {
                let id = $(this).val();
                load_polsek(id);
            });

            $('#submit-akun').click(function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Apakah Anda yakin data sudah benar?',
                    showCancelButton: true,
                    confirmButtonText: 'Yakin',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('#form-store').submit();
                    }
                });
            });

            function load_polsek(id, polsek = '') {
                $.ajax({
                    url: `{{ route('user_role.polsek') }}`,
                    type: "POST",
                    data: {
                        id: id,
                        polsek: polsek,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#polsek_code').html(response);
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }


        });
    </script>

</x-base-layout>