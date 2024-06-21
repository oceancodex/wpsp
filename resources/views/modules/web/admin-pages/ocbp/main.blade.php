@extends('modules.web.admin-pages.layout')

@section('navigation')
    @include('modules.web.admin-pages.ocbp.navigation')
@endsection

@section('content')
    @if(isset($requestParams['tab']) && $requestParams['tab'] == 'license')
        @include('modules.web.admin-pages.ocbp.license')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'database')
        @include('modules.web.admin-pages.ocbp.database')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'settings')
        @include('modules.web.admin-pages.ocbp.settings')
    @elseif(isset($requestParams['tab']) && $requestParams['tab'] == 'tools')
        @include('modules.web.admin-pages.ocbp.tools')
    @else
        @include('modules.web.admin-pages.ocbp.dashboard')
    @endif
@endsection