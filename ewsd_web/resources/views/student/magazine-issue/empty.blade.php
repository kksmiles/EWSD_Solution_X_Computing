@extends('template')

@section('css')

@endsection
 

@section('content')

<section class="container">
    <div>
        <img class="mt-5" src="{{ asset('img/empty-issues.svg') }}" style="display: block; margin-left: auto; margin-right: auto; width: 40%;" alt="">
        <p class="mt-5" style="text-align: center; font-size : 24px;">No active magazine issues</p>
        <button class="btn btn-primary p-3 mt-5" style="display: block; margin-left: auto; margin-right: auto; width: 150px;" onclick="window.history.back()">Go back</button>
    </div>
</section>

@endsection