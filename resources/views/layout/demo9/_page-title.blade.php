@php
    $breadcrumb = bootstrap()->getBreadcrumb();
@endphp

<!--begin::Page title-->
<div
    class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 py-3 py-lg-0 me-3">

    <!--begin::Heading-->
    <h1 class="d-flex flex-column text-dark fw-bolder my-1">
        <span class="text-white fs-1">
            {{ theme()->getOption('page', 'title') }}
        </span>

        @if (theme()->getOption('layout', 'page-title/description') && theme()->hasOption('page', 'description'))
            <small class="text-gray-600 fs-6 fw-normal pt-2">{{ theme()->getOption('page', 'description') }}</small>
        @endif
    </h1>
    <!--end::Heading-->
</div>
<!--end::Page title--->
