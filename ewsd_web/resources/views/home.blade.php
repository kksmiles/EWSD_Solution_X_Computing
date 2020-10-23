@extends('template')

@section('content')
    @can('isStudent')
    
    <div class="container-fluid">
        @if(isset($datas))
    
    <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="{{ route('student.faculty') }}">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Associated Faculties</div>
                        </a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $datas['facultiesCount'] }}</div>
                      </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <a href="{{route('student.magazine-issues')}}">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Magazine Issues</div>
                      </a>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $datas['magazineIssuesCount'] }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <a href="{{route('contribution.student.all')}}">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">My Contributions</div>
                      </a>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $datas['contributionsCount'] }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <a href="{{route('contribution.student.all')}}">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Published Contributions</div>
                      </a>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $datas['publishedContributionsCount'] }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
    @endcan
    @can('isMarketingCoordinator')
        <div class="container-fluid">
        
        @if(isset($datas))
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Magazine Issues</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$datas['magazineIssueCount']}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">My Faculty's Students</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$datas['studentCount']}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">All Contributions</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$datas['contributionsCount']}}</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Published Contributions</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$datas['contriPublishCount']}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>
    @endcan

    @can('isAdmin')
        <div class="container-fluid">
        
        @if(isset($datas))
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $datas['students']}}</div>
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Students</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $datas['faculties']}}</div>
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Faculties</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ $datas['cooridinators']}}</div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Coordinator</div>
                       </div>
                      <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $datas['managers']}}</div>
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mangaer</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-12 card p-4 border-left-primary shadow">
            <h5 class="font-weight-light">Latest User List</h5>
            <table class="table table-striped">
              <thead>
                <tr>
                  <td>No</td>
                  <td>Username</td>
                  <td class="d-md-block d-none">Email</td>
                </tr>
              </thead>
              <tbody>
                @php $no=1 @endphp
                @foreach($new_users as $user)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td><a class="text-decoration-none" href="{{route('users.show',$user->id)}}">{{ $user->username }}</a></td>
                  <td class="d-md-block d-none">{{ $user->email }}</td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>

          @endif
        </div>
    @endcan


@endsection