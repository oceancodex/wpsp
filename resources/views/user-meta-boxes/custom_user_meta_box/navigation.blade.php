<div class="nav-tab-wrapper">
    <a href="{{$edit_user_url}}&custom_user_meta_box-tab=tab-1" class="nav-tab {{ !isset($requestParams['custom_user_meta_box-tab']) || $requestParams['custom_user_meta_box-tab'] == 'tab-1' ? 'nav-tab-active' : '' }}">Tab 1</a>
    <a href="{{$edit_user_url}}&custom_user_meta_box-tab=tab-2" class="nav-tab {{ isset($requestParams['custom_user_meta_box-tab']) && $requestParams['custom_user_meta_box-tab'] == 'tab-2' ? 'nav-tab-active' : '' }}">Tab 2</a>
</div>