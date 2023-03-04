<!--begin::Header tablet and mobile-->
<div class="header-mobile py-3">
    <!--begin::Container-->
    <div class="container d-flex flex-stack">
        <!--begin::Mobile logo-->

        @php
        $isWebView = false;
        if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) :
            $isWebView = true;
        elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) :
            $isWebView = true;
        endif;
        @endphp

        @if(!$isWebView)
        <button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle">
            {!! theme()->getSvgIcon("icons/duotune/abstract/abs015.svg", "svg-icon-2x me-n1") !!}
        </button>
        @endif

        <div class="d-flex align-items-center justify-content-between flex-grow-1 flex-lg-grow-0">
            <a href="{{ theme()->getPageUrl('') }}">
                <img src="{{ asset(theme()->getMediaUrlPath() . 'others/logo-polda-metro-jaya.png') }}" class="h-40px" style="margin-right: 5px;" alt="image" />
                <img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'logos/ada-polisi.png') }}" class="h-35px" />
            </a>
            <div>
                <a href="#" data-action="{{ route('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true" class="button-ajax btn btn-icon">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="32" rx="16" fill="#EEEEEE" />
                        <path d="M14 22H11.3333C10.9797 22 10.6406 21.8595 10.3905 21.6095C10.1405 21.3594 10 21.0203 10 20.6667V11.3333C10 10.9797 10.1405 10.6406 10.3905 10.3905C10.6406 10.1405 10.9797 10 11.3333 10H14" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18.6667 19.3334L22.0001 16.0001L18.6667 12.6667" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 16H14" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
        <!--end::Mobile logo-->

        <!--begin::Aside toggle-->
        <!-- <button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle"> -->
        <!-- </button> -->
        <!--end::Aside toggle-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header tablet and mobile-->