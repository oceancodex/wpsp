@extends('modules.admin-pages.layout')

@section('before-admin-page-content')
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
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'roles')
        @include('modules.admin-pages.wpsp.roles')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'permissions')
        @include('modules.admin-pages.wpsp.permissions')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'users')
        @include('modules.admin-pages.wpsp.users')
    @else
        @include('modules.admin-pages.wpsp.dashboard')
    @endif
@endsection