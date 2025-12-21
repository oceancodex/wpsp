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
        @yield('content')
    </div>

    @yield('after-admin-page-content')

</div>

@yield('after-wrap')