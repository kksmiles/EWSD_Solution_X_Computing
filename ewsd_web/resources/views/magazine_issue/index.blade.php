@extends('template')
@section('content')
    <section class='container'>
        @foreach($magazine_issues as $magazine_issue)
            <div class='row border p-2 m-1'>
                <div class='col-3'>
                    <a href="{{ route('magazine-issues.show', $magazine_issue->id) }}" >{{ $magazine_issue->title }}</a>
                </div>
                <div class='col-3'>
                    <a href="{{ route('magazine-issues.edit', $magazine_issue->id) }}" class='btn btn-primary'>Edit</a>
                </div>
                <div class='col-3'>
                    <form action="{{ route('magazine-issues.destroy', $magazine_issue->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class='btn btn-danger'>Delete</button>   
                    </form>
                </div>
            </div>
        @endforeach
        <br>
        <a href="{{ route('magazine-issues.create') }}" class='btn btn-primary'>Create</a>
        <br>
        @if ($message = Session::get('success'))
            <strong>{{ $message }}</strong>
        @endif    
    </section>
@endsection