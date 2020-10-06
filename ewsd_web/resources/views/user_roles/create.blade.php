@extends('template')
@section('content')
    <section class='container'> 
        <form action="{{ route('user_roles.store') }}" method="POST">
            @csrf
            Role : <input type="text" class='form-control' name="roles" required>
            <br>
            <button type="submit" class='btn btn-primary'>Save</button>
        </form>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </section>
@endsection