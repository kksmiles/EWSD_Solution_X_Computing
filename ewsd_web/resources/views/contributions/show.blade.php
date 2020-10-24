@extends('template')

@section('css')

@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="app.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href="{{ URL::asset('css/hpmcss.css')}}" rel="stylesheet">
    <title>Edit Contribution</title>
  
</head>
<body id="page-top">
 <!-- Page Wrapper -->
 <div id="wrapper">

<div id="content-wrapper" class="d-flex flex-column">
    @can('isMarketingManager')
        <div id="content">
            <div class="bg-1 container">
                <div class="container card shadow p-3 rounded-lg m-2">
                    <div class="contri">
                        <h5 class="head" align="center">"{{ strtoupper($contribution->title) }}"</h5><br>
                        <p class="para">Title: {{ $contribution->title }}</p>
                        <p class="para">Description: {{ $contribution->description }}</p>
                        <span class="badge badge-primary">Contributor : {{ $contribution->student->fullname }}</span>&nbsp;&nbsp;
                        <span class="badge badge-danger">Associated Issue : {{ $contribution->magazineIssue->title }}</span>&nbsp;
                        <div class="mt-3 row ml-2">
                            <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}" class="btn btn-primary button mr-4">
                                Download Files
                            </a>
                            <a href="{{ route('manager.faculty.contributions.index',$contribution->faculty()->id)}}" class="btn btn-primary button ">
                                Back 
                            </a>
                        </div>
                    
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
    @elsecan('isGuest')
        <div id="content">
            <div class="bg-1 container">
                <div class="container card shadow p-3 rounded-lg m-2">
                    <div class="contri">
                        <h5 class="head" align="center">"{{ strtoupper($contribution->title) }}"</h5><br>
                        <p class="para">Title: {{ $contribution->title }}</p>
                        <p class="para">Description: {{ $contribution->description }}</p>
                        <span class="badge badge-primary">Contributor : {{ $contribution->student->fullname }}</span>&nbsp;&nbsp;
                        <span class="badge badge-danger">Associated Issue : {{ $contribution->magazineIssue->title }}</span>&nbsp;
                        <div class="mt-3 row ml-2">
                            <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}" class="btn btn-primary button mr-4">
                                Download Files
                            </a>
                        </div>
                    
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(session()->has('comment_not_allowed'))
            <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                            <strong> {{ session('comment_not_allowed') }}</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
            </div>
        @endif
        @if($message = Session::get('success'))
            <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                            <strong>{{ $message }}</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
            </div>
        @endif

        <!-- Main Content -->
        <div id="content">
            <div class="bg-1 container">
                <div class="container card shadow p-3 rounded-lg m-2">
                    <div class="contri">
                        <h5 class="head" align="center">"{{ strtoupper($contribution->title) }}"</h5><br>
                        <p class="para">Title: {{ $contribution->title }}</p>
                        <p class="para">Description: {{ $contribution->description }}</p>
                        <span class="badge badge-primary">Contributor : {{ $contribution->student->fullname }}</span>&nbsp;&nbsp;
                        <span class="badge badge-danger">Associated Issue : {{ $contribution->magazineIssue->title }}</span>&nbsp;
                        <div class="mt-3 row ml-2">
                            <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}" class="btn btn-primary button mr-4">
                                Download Files
                            </a>
                            <a href="{{ route('coordinator.contributions.index')}}" class="btn btn-primary button ">
                                Back
                            </a>
                        </div>
                        @if(!($contribution->isOpen()))
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-body">
                                <h5 class="card-title">
                                    The contributions is closed because 
                                    @if(session()->has('closed'))
                                        {{ session('closed') }}
                                    @endif
                                </h5>
                                <p class="card-text"></p>
                                </div>
                            </div>
                        @elseif((Gate::allows('isMarketingCoordinator')))
                            @if($contribution->is_published == '0')
                                <div class="row mt-4 ml-2">
                                    <form action="{{ route('coordinator.contributions.publish',$contribution->id) }}" method="POST" class="mr-4">
                                        @csrf
                                        <button class="btn btn-success button">Publish</button>
                                    </form>
                                    <form action="{{ route('coordinator.contributions.reject',$contribution->id) }}" method="POST" class="">
                                        @csrf
                                        <button class="btn btn-danger button">Reject</button>
                                    </form>
                                </div>
                                @else
                                    @if( $contribution->is_published == '1')
                                    <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                                        <strong>Published</strong> 
                                    </div>
                                    @else
                                    <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                                        <strong>Rejected Manually</strong> 
                                    </div>
                                    @endif
                                @endif
                        @endif
                    </div>
                </div>
                <br>

            <div class="bg-2">
                <h5 class="head">Give a Comment </h5><hr><br>
                @if($contribution->allowComment())
                    <form action="{{ route('contribution.comment.store', $contribution->id) }}" method="POST" class="col-md-6 col-xs-12">
                        @csrf
                        <textarea class="form-control border-dark" name="comment" cols="50" rows="5"></textarea>
                        <button type="submit" class=" mt-4 ml-4 btn btn-primary button">Add comment</button>
                    </form>
                @endif
                <div class="container card m-2 mb-5 pb-5">
                <br>
                <h6 class="font-weight-bold p-2" align="center">Comments</h6><br>
                <div class="row col-12">
                @foreach($contribution->comments as $comment)
                <div class="col-12">
                    <div class="card row col-12">
                    <div id="module" class="container">
                    <div class="row">
                        <div class="col-1 p-2 mt-2">
                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Food/full page/2.jpg" alt="" width="80px" height="80px" class="img img-profile rounded-circle">
                        </div>
                        <div class="col-8 p-2 ml-2">
                        <span class="font-weight-bold" style="font-size: 20px;">{{ $comment->user->fullname }}</span>
                        <span class="px-4 small font-weight-bold" style="font-size: 12px;">[{{\App\User::where('id',$comment->user_id)->first()->role->roles}}]</span><br>
                        <div class="example">
                        {{ $comment->comment }}
                            @if($comment->user_id == Auth::id())
                                {{-- Calls the modal --}}
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$comment->id}}">
                                        Edit
                                    </button>
                                {{-- Calls the modal --}}

                                {{-- The modal --}}
                                    <div class="modal fade" id="Modal{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <div class="modal-body">
                                                        <textarea name="comment" id="" cols="50" rows="5">{{ $comment->comment }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="Submit" class="btn btn-primary">Save</button>              
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                {{-- The modal --}}
                                    <form style="display: inline;" action="{{ route('comment.delete', $comment->id) }}" method="POST">
                                        @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            <a role="button" class="collapsed" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        </a>
                        </div>
                        </div>

                        </div>
                    </div>

                    </div>
                </div>

                @endforeach
                </div>
            </div>

            </div>

            </div>
            </div>
    @endcan
   
</div>
</body>

@endsection