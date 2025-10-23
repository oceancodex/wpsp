@yield('before-meta-box')
@stack('styles')
<div id="poststuff">
    <div class="postbox-container">
        <div class="meta-box-sortables">
            <div id="{{ $id }}" class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle">{{ $title ?? 'Custom meta box: ' . $id }}</h2>
                    @include('modules.user-meta-boxes.handle-actions')
                </div>
                @yield('after-meta-box-header')
                <div class="inside form-table w-auto">
                    @yield('content')
                </div>
                @yield('after-content')
            </div>
        </div>
    </div>
</div>
@stack('scripts')
@yield('after-meta-box')