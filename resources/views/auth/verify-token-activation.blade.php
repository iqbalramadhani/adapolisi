<x-auth-layout>

    <!--begin::Signup Form-->

    <form class="form w-100 " novalidate="novalidate" id="kt_activation_form" method="POST" enctype="multipart/form-data" action="{{ route('index.activationAccount') }}">
    @csrf
    <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'logos/ada-polisi.png') }}" class="h-75px">
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6"></div>
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        <!--begin::Login options-->
        <div class="row g-3 mb-9">
        </div>
        <!--end::Login options-->
        <!--begin::Separator-->
        <div class="separator separator-content my-14">
            <span class="w-1000px"><h1>Verifikasi Kode Akun</h1></span>
        </div>

        <div class="text-gray-500 text-center fw-semibold fs-6">Klik tombol berikut untuk menyelesaikan proses aktivasi </div>
        <!--end::Separator-->
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
        <!--begin::Input group=-->
        <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <!--begin::Email-->
            <input type="hidden" name="user_token_activation" id="user_token_activation" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{ $user_token }}"/>

            <!-- <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent"> -->
            <!--end::Email-->
        </div>

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary"> 
                @include('partials.general._button-indicator', ['label' => __('Lanjut')])
            </button>
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        <!-- <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
            <a href="{{ theme()->getPageUrl('login') }}" class="link-primary fw-semibold">Login</a></div> -->
        <!--end::Sign up-->
        <div></div>
    </form>
    <!--end::Signup Form-->

</x-auth-layout>
