@extends('template')

@section('css')
.status td
{
    font-size: 15px;
}

.bg-1
{
    background-color: #f8f8f8 !important;
    margin-bottom: 0;
    padding-top: 5%;
    padding-bottom: 6%;
    padding-left: 10%;
    padding-right: 10%;
    font-family: 'Montserrat';
}

.bg-2
{
    background-color: #e0ecf1 !important;
    margin-bottom: 100%;
    padding-top: 5%;
    padding-left: 6%;
    padding-right: 6%;
    padding-bottom: 100%;
    font-family: 'Montserrat';
}


h5.head
{
    font-weight: 900;
}

@media screen and (min-width: 601px) {
  div.example {
    font-size: 17px;
  }
}

@media screen and (max-width: 600px) {
  div.example {
    font-size: 10px;
  }
}

#module #collapseExample.collapse:not(.show) {
  display: block;
  height: 3rem;
  overflow: hidden;
}

#module #collapseExample.collapsing {
  height: 3rem;
}

#module a.collapsed:after {
  content: ' read more..';
}

#module a:not(.collapsed):after {
  content: ' read less';
}
@endsection
 

@section('content')

<section class="container">
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <div class="bg-1">
            <div class="container card p-3 rounded-lg">
              <div class="contri">
                <a href="{{ route('student.magazine-issues.show', $contribution->magazineIssue->id) }}">
                  <h5 class="head" align="center">{{ $contribution->magazineIssue->title }}</h5>
                </a> 
                <br />
                <p class="para">
                  {{ $contribution->magazineIssue->description }}
                </p>
                <br />
                <span class="badge badge-primary">
                  Start Date : {{ date('jS F Y', strtotime($contribution->magazineIssue->created_at)) }}
                  </span>&nbsp;&nbsp;
                <span class="badge badge-danger"
                  >Submission Deadline : {{ date('jS F Y', strtotime($contribution->magazineIssue->submission_closure_date)) }}</span
                >&nbsp;&nbsp;
                <span class="badge badge-success">Modify Deadline : {{ date('jS F Y', strtotime($contribution->magazineIssue->modification_closure_date)) }}</span
                >&nbsp;&nbsp;
              </div>
            </div>
            <br /><br />
            <div class="status">
              <h5 class="head">Status</h5>
              
              <br />
              <table class="table">
                <tr>
                  <td>Status</td>
                  <td>
                    @switch($contribution->is_published)
                    @case(0)
                        <span class="text-secondary"> Pending </span>
                        @break
                    @case(1)
                      <span class="text-primary"> Published </span>
                        @break
                    @default
                        <span class="text-danger"> Rejected </span>
                  @endswitch    
                  </td>
                </tr>
      
                <tr>
                  <td>Title</td>
                  <td>{{ $contribution->title }}</td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>{{ $contribution->description }}</td>
                </tr>
                <tr>
                  <td>Days Remaining</td>
                  <td>
                    @php
                        $now = time();
                        $closure_date = strtotime($contribution->magazineIssue->modification_closure_date);
                        $datediff = round(($closure_date - $now) / (60 * 60 * 24));  
                    @endphp
                    {{ $datediff }} Days Remaining
                  </td>
                </tr>
                <td>Last modified</td>
                <td>{{ date('jS F Y h:i a', strtotime($contribution->updated_at)) }}</td>
                <tr>
                  <td>File</td>
                  <td>
                    <a href="{{ $contribution->file }}">
                      <button class="btn btn-success">Download Files</button>
                    </a>
                  </td>
                </tr>
              </table>
              <br />
              {{-- Check whether today is past modification closure date or not --}}
              @if(strtotime($contribution->magazineIssue->modification_closure_date) > $now )
                <div class="col-12">
                    <a href="{{ route('contribution.student.edit', $contribution->id) }}">
                        <button class="btn btn-primary button">
                            Edit
                        </button>
                    </a>
                </div>
              @endif

            </div>
          </div>

          <div class="bg-2">
<h5 class="head">Give a Comment </h5><hr><br>

    @if ($message = Session::get('success'))
      <strong>{{ $message }}</strong>
    @endif 
    @if($contribution->allowComment())
        <form action="{{ route('contribution.comment.store', $contribution->id) }}" method="POST" class="col-md-6 col-xs-12">
            @csrf
            <textarea class="form-control border-dark" name="comment" cols="50" rows="5"></textarea>
            <button type="submit" class=" mt-4 ml-4 btn btn-primary button">Add comment</button>
        </form>
    @else
      Please wait for coordinator response
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

               @if(!($contribution->isOpen()))
            <div class="card text-white bg-danger mb-3">
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
            @endif
            </div>
          </div>

</div>
        </div>
      </div>    
</section>

@endsection