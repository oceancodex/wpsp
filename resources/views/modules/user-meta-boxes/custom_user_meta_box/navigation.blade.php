<div class="nav-tab-wrapper">
    <a href="{{$edit_user_url}}&tab=tab-1" class="nav-tab {{ !isset($requestParams['tab']) || $requestParams['tab'] == 'tab-1' ? 'nav-tab-active' : '' }}">Tab 1</a>
    <a href="{{$edit_user_url}}&tab=tab-2" class="nav-tab {{ isset($requestParams['tab']) && $requestParams['tab'] == 'tab-2' ? 'nav-tab-active' : '' }}">Tab 2</a>
</div>