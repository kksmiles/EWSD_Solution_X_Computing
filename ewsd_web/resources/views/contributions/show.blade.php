<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Edit
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form style="display: inline;" action="{{ route('comment.delete', $comment->id) }}" method="POST">
                    @csrf @method('DELETE') <button type="submit">Delete</button>
                </form>
            @endif
        </li>
    @endforeach

    <form action="{{ route('contribution.comment.store', $contribution->id) }}" method="POST">
        @csrf
        <textarea name="comment" cols="50" rows="5"></textarea>
        <button type="submit">Add comment</button>
    </form>

    @if ($message = Session::get('success'))
        <strong>{{ $message }}</strong>
    @endif 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>