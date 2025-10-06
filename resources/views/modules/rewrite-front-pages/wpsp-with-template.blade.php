@extends('modules.rewrite-front-pages.layout.main-without-skeleton')

@section('content')
    Front page with template.
    @php
        echo '<pre>'; print_r($user ? $user->toArray() : []); echo '</pre>';
    @endphp
@endsection