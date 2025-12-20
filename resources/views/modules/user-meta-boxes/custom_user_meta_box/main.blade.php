@extends('modules.user-meta-boxes.layout')

@section('after-meta-box-header')
    @include('modules.user-meta-boxes.custom_user_meta_box.navigation')
@endsection

@section('content')
    @if(isset($requestParams['custom_user_meta_box-tab']) && $requestParams['custom_user_meta_box-tab'] == 'tab-2')
        @include('modules.user-meta-boxes.custom_user_meta_box.tab-2')
    @else
        @include('modules.user-meta-boxes.custom_user_meta_box.tab-1')
    @endif
@endsection