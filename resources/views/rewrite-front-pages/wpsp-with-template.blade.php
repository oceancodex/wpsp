@extends('rewrite-front-pages.layout.main-without-skeleton')

@section('content')
    Front page with template.
    @php
        echo '<pre>'; print_r($current_user ? $current_user->toArray() : []); echo '</pre>';
    @endphp
@endsection