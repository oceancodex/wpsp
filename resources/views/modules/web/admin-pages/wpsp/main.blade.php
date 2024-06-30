@extends('modules.web.admin-pages.layout')

@section('navigation')
    @include('modules.web.admin-pages.wpsp.navigation')
@endsection

@section('content')
    @if(isset($requestParams['tab']) && $requestParams['tab'] == 'license')
        @include('modules.web.admin-pages.wpsp.license')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'database')
        @include('modules.web.admin-pages.wpsp.database')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'settings')
        @include('modules.web.admin-pages.wpsp.settings')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'tools')
        @include('modules.web.admin-pages.wpsp.tools')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'table')
        @include('modules.web.admin-pages.wpsp.table')
    @else
        @include('modules.web.admin-pages.wpsp.dashboard')
    @endif
@endsection