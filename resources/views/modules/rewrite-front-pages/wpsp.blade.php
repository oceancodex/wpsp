@extends('modules.rewrite-front-pages.layout.main')

@section('title')
    wpsp
@endsection

@section('content')
    Front page without template.
    <br/>
    <br/>
    <form method="POST">
        <input type="text" name="input_1" value="Test value"/>
        <input type="submit" value="Test submit"/>
    </form>
    Submited value: <mark>@php echo $_POST['input_1'] ?? '...' @endphp</mark>
@endsection