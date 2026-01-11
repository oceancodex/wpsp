@yield('before-wrap')
@stack('before-wrap-stack')

<div class="wrap">

    @yield('before-title')
    @stack('before-title-stack')

    <h1 class="wp-heading-inline">
        @yield('title')
        @stack('title-stack')
    </h1>

    @yield('after-title')
    @stack('after-title-stack')

    <hr class="wp-header-end">

    {!! $notice ?? '' !!}

    @yield('after-notice')
    @stack('after-notice-stack')

    @yield('before-admin-page-content')
    @stack('before-admin-page-content-stack')

    <div class="mt-2">
    @stack('breadcrumbs-stack')
    </div>

    <div class="wpsp-admin-page-content">
	    <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
	    <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
        @yield('content')
        @stack('content-stack')
    </div>

    @yield('after-admin-page-content')
    @stack('after-admin-page-content-stack')

</div>

@yield('after-wrap')
@stack('after-wrap-stack')

@stack('scripts')