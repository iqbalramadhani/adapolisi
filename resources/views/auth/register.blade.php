<x-auth-layout>

    <!--begin::Signup Form-->
    <form class="form w-100 " novalidate="novalidate" id="kt_sign_up_form" action="{{ theme()->getPageUrl('register') }}">
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
            <span class="w-125px"><h1>Aktivasi Akun</h1></span>
        </div>
        <!--end::Separator-->
        @if($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
        <!--begin::Input group=-->
        <div class="fv-row mb-8 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <!--begin::Email-->
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent">
            <!--end::Email-->
        </div>
        <!--begin::Input group-->
        <div class="fv-row mb-8 fv-plugins-icon-container">
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off">
                </div>
                <!--end::Input wrapper-->
            </div>
        </div>
        <!--end::Input group=-->
        <!--end::Input group=-->
        <div class="fv-row mb-8 fv-plugins-icon-container">
            <!--begin::Repeat Password-->
            <input placeholder="Repeat Password" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent">
            <!--end::Repeat Password-->
        </div>
        <!--end::Input group=-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                @include('partials.general._button-indicator')
            </button>
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
            <a href="{{ theme()->getPageUrl('login') }}" class="link-primary fw-semibold">Login</a></div>
        <!--end::Sign up-->
        <div></div>
    </form>
    <!--end::Signup Form-->

</x-auth-layout>
