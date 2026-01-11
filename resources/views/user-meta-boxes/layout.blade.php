@yield('before-meta-box')
@stack('before-meta-box-stack')
<div id="poststuff">
    <div id="post-body" class="metabox-holder columns-1">
        <div class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                <div id="{{ $id }}" class="postbox">
                    <div class="postbox-header">
                        <h2 class="hndle">{{ $title ?? 'Custom meta box: ' . $id }}</h2>
{{--                        @include('user-meta-boxes.handle-actions')--}}
                    </div>
                    @yield('after-meta-box-header')
                    @stack('after-meta-box-header-stack')
                    <div class="inside form-table w-auto">
                        @yield('content')
                        @stack('content-stack')
                    </div>
                    @yield('after-content')
                    @stack('after-content-stack')
                </div>
            </div>
        </div>
    </div>
</div>
@yield('after-meta-box')
@stack('after-meta-box-stack')