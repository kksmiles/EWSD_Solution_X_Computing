@extends('template')
@section('content')
    <section class='container'>
        <h5 class="bg-white d-inline-block py-2 font-weight-bold rounded-lg text-primary">
          Magazine Issues {{ Session::get('header') }}
        </h5>
       <div class="row">
         
        @foreach($magazine_issues as $magazine_issue)
         <!-- Card -->
         <div class="col-3 p-2">
            <div class="card col-12 border-bottom-primary shadow p-1">
                <!-- Card image -->
                <div class="card-img-top">
                <img class="card-img-top rounded-0" src="{{ $magazine_issue->getImageURL() }}" alt="Card image cap">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>

                <!-- Card content -->
                <div class="card-body">         

                    @if(Gate::allows('isStudent'))
                          <h5 class="card-title font-weight-bold ">
                            <a href="{{ route('student.magazine-issues.show', $magazine_issue->id) }}">
                                {{ $magazine_issue->title }}
                            </a>
                          </h5>
                      @elseif(Gate::allows('isMarketingCoordinator'))
                       
                          <h5 class="card-title">
                            <a class="card-link font-weight-bold" href="{{ route('coordinator.magazine-issues.show', $magazine_issue->id) }}">
                                {{ $magazine_issue->title }}
                            </a>
                          </h5>
                        
                             <!-- Text -->
                          <p class="card-text text-justify"> {{ Str::limit($magazine_issue->description,20,"....") }}</p>
                         
                          <!-- Button -->
                          <a href="{{ route('coordinator.magazine-issues.edit', $magazine_issue->id) }}">
                            <i class="fas fa-pen float-right text-primary p-1 my-1"title="Edit"></i>
                          </a>

                          <form action="{{ route('coordinator.magazine-issues.destroy', $magazine_issue->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" onclick="return confirm('Are you sure to delete this issue?')" class='btn btn-link float-right text-danger p-1 my-1 mr-3'>
                                <i class="fa fa-trash-alt"></i>
                              </button>   
                          </form>

                          <i class="fas fa-download text-success float-right p-1 my-1 mr-3" title="Download File"></i>
                     
                      @else


                        <h5 class="card-title">
                          <a class="card-link font-weight-bold" href="{{ route('magazine-issues.show', $magazine_issue->id) }}">
                              {{ $magazine_issue->title }}
                          </a>
                        </h5>
                        
                           <!-- Text -->
                        <p class="card-text text-justify d-block h-25"> {{ Str::limit($magazine_issue->description,80,"...") }}</p>
                       
                        <!-- Button -->
                        <a href="{{ route('magazine-issues.edit', $magazine_issue->id) }}">
                          <i class="fas fa-pen float-right text-primary p-1 my-1"title="Edit"></i>
                        </a>

                        <form action="{{ route('magazine-issues.destroy', $magazine_issue->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure to delete this issue?')" class='btn btn-link float-right text-danger p-1 my-1 mr-3'>
                              <i class="fa fa-trash-alt"></i>
                            </button>   
                        </form>

                        <i class="fas fa-download text-success float-right p-1 my-1 mr-3" title="Download File"></i>


                      @endif




                  </div>

                </div>
                <!-- Card -->
         </div>
       

        @endforeach
       </div>
       



        @if(Gate::allows('isMarketingCoordinator'))
        <br>
            <a href="{{ route('coordinator.magazine-issues.create') }}" class='btn btn-primary'>Create</a>
        <br>
        @endif
        @if ($message = Session::get('success'))
            <strong>{{ $message }}</strong>
        @endif    
    </section>
@endsection