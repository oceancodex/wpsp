@extends('admin-pages.layout')

@section('before-admin-page-content')
    @include('admin-pages.wpsp.navigation')
@endsection

@section('content')
    @if(isset($requestParams['tab']) && $requestParams['tab'] == 'license')
        @include('admin-pages.wpsp.license')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'database')
        @include('admin-pages.wpsp.database')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'settings')
        @include('admin-pages.wpsp.settings')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'tools')
        @include('admin-pages.wpsp.tools')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'table')
        @include('admin-pages.wpsp.table')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'roles')
        @include('admin-pages.wpsp.roles')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'permissions')
        @include('admin-pages.wpsp.permissions')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'users')
        @include('admin-pages.wpsp.users')
    @else
        @include('admin-pages.wpsp.dashboard')
    @endif
@endsection