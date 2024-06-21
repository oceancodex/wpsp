@yield('before-wrap')

<div class="wrap">
    <h1>@yield('title')</h1>
    {!! $notice ?? '' !!}
    @yield('navigation')
    <div class="wpsp-admin-page-content">
        @yield('content')
    </div>
</div>

@yield('after-wrap')