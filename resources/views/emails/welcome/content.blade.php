@extends('emails.layouts.litmus')

@section('content')

    <p>
        {{ $messageBody }}
    </p>

    <p style="text-align:center;">
        <a href="#"
           style="background:#539be2;color:#ffffff;padding:12px 24px;border-radius:4px;text-decoration:none;display:inline-block;font-family:Arial,serif;">
            Login Now
        </a>
    </p>

    <p>
        If you need help, just reply to this email.
    </p>

@endsection
