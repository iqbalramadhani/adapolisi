<!--begin::Header-->
<div id="kt_header" style="background-image: url({{ asset(theme()->getMediaUrlPath() . 'misc/login-screens.png') }});background-size:cover;" class="header {{ theme()->printHtmlClasses('header', false) }} py-6 py-lg-0" {{ theme()->printHtmlAttributes('header') }}
	@if (theme()->getOption('layout', 'header/fixed/desktop') === true &&  theme()->getOption('layout', 'header/fixed/tablet-and-mobile') === true)
		data-kt-sticky="true"
		data-kt-sticky-name="header"
		data-kt-sticky-offset="{lg: '300px'}"
	@endif

	@if (theme()->getOption('layout', 'header/fixed/desktop') === true && theme()->getOption('layout', 'header/fixed/tablet-and-mobile') === false)
		data-kt-sticky="true"
		data-kt-sticky-name="header"
		data-kt-sticky-offset="{lg: '300px'}"
	@endif
>
	<!--begin::Container-->
	<div class="header-container {{ theme()->printHtmlClasses('header-container', false) }}">
        {{ theme()->getView('layout/_page-title') }}

        <!--begin::Wrapper-->
        <div class="d-flex align-items-center flex-wrap">

            <!--begin::Action-->
            <div class="d-flex align-items-center py-3 py-lg-0">
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
                <div class="me-3">
                    <span class="text-white" style="float: right;">
                        <b>{{ auth()->user()->name }}</b>
                    </span><br>
                    <span class="text-white" style="float: right;">
                    {{ auth()->user()->role_id == 1 ? 'Superadmin' : 'Admin'}} Polda
                    </span>
                </div>
                <div class="me-3">
                    <a href="#" class="btn btn-icon btn-custom btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        {!! theme()->getSvgIcon("icons/duotune/communication/com013.svg", "svg-icon-1 svg-icon-white") !!}
                    </a>
                    {{ theme()->getView('partials/topbar/_user-menu', array('language-menu-placement' => 'right-start', 'subscription-menu-placement' => 'right-start')) }}
                </div>

                <!-- <a href="#" class="btn btn-primary" data-bs-target="#kt_modal_create_app" data-bs-toggle="modal">New Goal</a> -->
                @endif
            </div>
            <!--end::Action-->
        </div>
        <!--end::Wrapper-->
	</div>
	<!--end::Container-->

    <div class="header-offset"></div>
</div>
<!--end::Header-->


