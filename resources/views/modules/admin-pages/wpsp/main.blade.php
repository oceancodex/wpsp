@extends('modules.admin-pages.layout')

@section('navigation')
    @include('modules.admin-pages.wpsp.navigation')
@endsection

@section('content')
    @if(isset($requestParams['tab']) && $requestParams['tab'] == 'license')
        @include('modules.admin-pages.wpsp.license')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'database')
        @include('modules.admin-pages.wpsp.database')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'settings')
        @include('modules.admin-pages.wpsp.settings')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'tools')
        @include('modules.admin-pages.wpsp.tools')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'table')
        @include('modules.admin-pages.wpsp.table')
    @else
        @include('modules.admin-pages.wpsp.dashboard')
    @endif
@endsection