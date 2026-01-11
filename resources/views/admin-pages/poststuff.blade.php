<div id="poststuff">
    <div id="post-body" class="metabox-holder columns-{{ $screen_columns ?? 2  }}">
        <div id="postbox-container-1" class="postbox-container">
                <div id="side-sortables" class="meta-box-sortables ui-sortable">
                    @foreach($admin_page_meta_boxes['side'] as $admin_page_meta_box)
                        @if($admin_page_meta_box && isset($admin_page_meta_box['view']))
                            @include($admin_page_meta_box['view'])
                        @endif
                    @endforeach
                </div>
            </div>
        <div id="postbox-container-2" class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                @foreach($admin_page_meta_boxes['normal'] as $admin_page_meta_box)
                    @if($admin_page_meta_box && isset($admin_page_meta_box['view']))
                        @include($admin_page_meta_box['view'])
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>