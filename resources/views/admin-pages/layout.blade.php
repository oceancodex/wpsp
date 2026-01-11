@yield('before-wrap')

<div class="wrap">

    @yield('before-title')

    <h1 class="wp-heading-inline">@yield('title')</h1>

    @yield('after-title')

    <hr class="wp-header-end">

    {!! $notice ?? '' !!}

    @yield('after-notice')

    @yield('before-admin-page-content')

    <div class="wpsp-admin-page-content">
	    <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
	    <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
        @yield('content')
    </div>

    @yield('after-admin-page-content')

</div>

@yield('after-wrap')