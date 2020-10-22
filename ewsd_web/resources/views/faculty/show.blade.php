@extends('template')
@section('content')
    <section class='container'>
      <div class="card border-left-primary p-3">
        <div class="card-header text-primary font-weight-bold">
          {{$faculty->name}}
        </div>
        <div class="card-body">
          <p class="text-justify text-dark" style=" text-indent: 50px;">{{$faculty->description}}</p>
        </div>

        <div class="card-footer text-right">
          @can('isMarketingCoordinator')
          <a class="btn btn-sm btn-primary" href="{{route('coordinator.faculty.users.show',$faculty->id)}}">
            <i class="fas fa-users"></i> Check Students</a>
          <a class="btn btn-sm btn-primary" href="{{ route('coordinator.magazine-issues.index') }}">
            <i class="fas fa-file"></i> Check Issues </a>
          <a class="btn btn-sm btn-primary" href="{{ route('coordinator.contributions.index') }}">
            <i class="fa fa-file-alt"></i> Check Contributions </a>
            @endcan
            @can('isAdmin')
              <a class="btn btn-sm btn-primary" href="{{route('faculty.users.show',$faculty->id)}}">
              <i class="fas fa-users"></i> Check Students</a>
              <a class="btn btn-sm btn-primary" href="{{ route('magazine-issues.index') }}">
                <i class="fas fa-file"></i> Check Issues </a>
              <a class="btn btn-sm btn-primary" href="{{ route('faculty.index') }}">
              <i class="fa fa-file-alt"></i> Check Contributions </a>
            @endcan
        </div>
      </div>
    </section>
@endsection
