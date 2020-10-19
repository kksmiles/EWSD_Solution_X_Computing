@extends('template')
@section('content')

<section class="container">
    
    <h1>Title : {{ $contribution->title }}</h1>
    <p>Description : {{ $contribution->description }}</p>
    <p>Contributor : {{ $contribution->student->fullname }}</p>
    <p>Associated Issue : {{ $contribution->magazineIssue->title }}</p>
    <a href="{{asset('storage/contributions/'.$contribution->file)}}" download="{{$contribution->file}}">
        <button>Download Files</button>
    </a>
    @foreach($contribution->comments as $comment)
        <li>
            {{ $comment->user->fullname }} :
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
                    @csrf @method('DELETE') <button type="submit">Delete</button>
                </form>
            @endif
        </li>
    @endforeach
    @if($contribution->allowComment())
        <form action="{{ route('contribution.comment.store', $contribution->id) }}" method="POST">
            @csrf
            <textarea name="comment" cols="50" rows="5"></textarea>
            <button type="submit">Add comment</button>
        </form>
    @endif

    @if(session()->has('comment_not_allowed'))
        {{ session('comment_not_allowed') }}
    @endif
    
    @if ($message = Session::get('success'))
        <strong>{{ $message }}</strong>
    @endif 

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
            <form action="{{ route('coordinator.contributions.publish',$contribution->id) }}" method="POST">
                @csrf
                <button>Publish</button>
            </form>
            <form action="{{ route('coordinator.contributions.reject',$contribution->id) }}" method="POST">
                @csrf
                <button style="margin-left:10px;">Reject</button>
            </form>
            @else
                @if( $contribution->is_published == '1')
                    <span style="background: green; color: #fff;">Published</span>
                @else
                    <span style="background: red; color: #fff;">Rejected Manually</span>
                @endif
            @endif
    @endif
</section>
@endsection