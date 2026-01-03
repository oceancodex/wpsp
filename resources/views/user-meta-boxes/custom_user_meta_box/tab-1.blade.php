@section('content')
    <div class="input-group mt-2">
        <label for="phone">
            Phone:
            <input type="text" id="phone" name="phone" class="w-100 mt-1" value="{{ get_user_meta($user->ID, 'phone', true) }}"/>
        </label>
    </div>
@endsection