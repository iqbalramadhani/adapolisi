<x-auth-layout>
    <style>
        .field-icon {
            float: right;
            margin-right: 10px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }
    </style>

    <!--begin::Signin Form-->
    <form class="form w-100 " novalidate="novalidate" id="kt_sign_in_form" action="{{ theme()->getPageUrl('login') }}">
        @csrf
        <!--begin::Heading-->
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <div class="text-center mb-11">
            <!--begin::Title-->
            <a href="/" class="mb-12">
                <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'logos/ada-polisi.png') }}" class="h-75px">
            </a><br>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6"></div>
            <!--end::Subtitle=-->
        </div>
        @endif
        <!--begin::Heading-->
        <!--begin::Login options-->
        <div class="row g-3 mb-9">
            <!--begin::Col-->
            <!-- <div class="col-md-6"> -->
            <!--begin::Google link=-->
            <!-- <a href="{{ url('/auth/redirect/google') }}?redirect_uri={{ url()->previous() }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                    <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'svg/brand-logos/google-icon.svg') }}" class="h-15px me-3">Sign in with Google</a> -->
            <!--end::Google link=-->
            <!-- </div> -->
            <!--end::Col-->
            <!--begin::Col-->
            <!-- <div class="col-md-6"> -->
            <!--begin::Google link=-->
            <!-- <a href="{{ url('/auth/redirect/apple') }}?redirect_uri={{ url()->previous() }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                    <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'svg/brand-logos/apple-black.svg') }}" class="theme-light-show h-15px me-3">
                    <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'svg/brand-logos/apple-black-dark.svg') }}" class="theme-dark-show h-15px me-3">Sign in with Apple</a> -->
            <!--end::Google link=-->
            <!-- </div> -->
            <!--end::Col-->
        </div>
        <!--end::Login options-->
        <!--begin::Separator-->
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <div class="separator separator-content my-14">
            <span class="w-125px">
                <h1>Login</h1>
            </span>
        </div>
        @else
        <h1 class="mb-5">Login</h1>
        @endif
        <!--end::Separator-->
        <!--begin::Input group=-->
        <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <!--begin::Email-->
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
            <input type="text" placeholder="Nomor registrasi pokok" name="nomor_registrasi_pokok" autocomplete="off" class="form-control bg-transparent" value="" required autofocus>
            @else
            <label>NRP Nomor Registrasi Pokok</label>
            <input type="text" placeholder="Masukkan Nomor Registrasi Pokok" name="nomor_registrasi_pokok" autocomplete="off" class="form-control bg-transparent border-0" style="background-color: #F5F8FA !important;" value="" required autofocus>
            @endif
            <!--end::Email-->
        </div>
        <!--end::Input group=-->

        <!--begin::Input group=-->
        <!-- <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid"> -->
        <!--begin::Email-->
        <!-- <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value="{{ old('email', 'demo@demo.com') }}" required autofocus> -->
        <!--end::Email-->
        <!-- </div> -->
        <!--end::Input group=-->
        <div class="fv-row mb-3 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <!--begin::Password-->
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
            <input type="password" id="password-field" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent">
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            @else
            <label>Password</label>
            <input type="password" id="password-field" placeholder="Masukkan Passowrd" name="password" autocomplete="off" class="form-control bg-transparent border-0" style="background-color: #F5F8FA !important;" value="" required autofocus>
            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            @endif
            <!--end::Password-->
        </div>
        <!--end::Input group=-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            @if (Route::has('password.request'))
            <!--begin::Link-->
            <a href="{{ theme()->getPageUrl('password.request') }}" class="link-primary">Forgot Password ?</a>
            <!--end::Link-->
            @endif
        </div>
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials.general._button-indicator', ['label' => __('Continue')])
            </button>
            @else
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary" style="background-color: #07315B;">
                @include('partials.general._button-indicator', ['label' => __('Login')])
            </button>
            @endif
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
            <a href="{{ theme()->getPageUrl('register') }}" class="link-primary">Aktivasi Akun</a>
        </div>
        <!--end::Sign up-->
        <div></div>
    </form>
    <!--end::Signin Form-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $()
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

</x-auth-layout>