<div id="poststuff">
    <div id="post-body" class="columns-2">
        <div id="postbox-container-1" class="postbox-container">
            <div id="side-sortables" class="meta-box-sortables ui-sortable">
                @foreach($metaboxes['side'] as $metabox)
                    @if($metabox) @include($metabox) @endif
                @endforeach
            </div>
        </div>
        <div id="postbox-container-2" class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable" style="min-height: 200px;">
                @foreach($metaboxes['normal'] as $metabox)
                    @if($metabox) @include($metabox) @endif
                @endforeach
            </div>
        </div>
    </div>
</div>