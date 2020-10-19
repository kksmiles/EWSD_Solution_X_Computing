@extends('template')
@section('content')
 <section class='container'>

    <div class="card shadow border-left-primary p-3 col-md-6 col-12">
        <div class="card-header">
            <span class="font-weight-bold text-primary">Academic year list</span>
        </div>
        <div class="card-body">
            <table class="table d-table table-responsive text-center">
                <thead class="bg-dark-primary text-white">
                    <tr class="">
                        <th>No.</th>
                        <th>Title</th>
                        <th colspan="1" class="text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($academic_years as $key => $academic_year)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td class="font-weight-bold text-dark">{{ $academic_year->title }}</td>
                        <td class="row">
                           <div class='col-md-3 col-2'>
                              <a href="{{ route('academic-years.edit', $academic_year->id) }}" class='btn btn-sm btn-circle btn-outline-primary float-md-right'><i class="fas fa-pen"></i></a>
                            </div>
                            <div class='col-md-1 offset-2 offset-md-0 col-2'>
                               <form action="{{ route('academic-years.destroy', $academic_year->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class='btn float-md-left btn-sm btn-circle btn-outline-danger'>
                                        <i class="fas fa-trash"></i>
                                    </button>   
                                </form>
                            </div>  
                        </td>
                    </tr>
                @endforeach
                </tbody>
                
            </table>
        </div>
    
    <a href="{{ route('academic-years.create') }}" class='btn btn-primary mt-md-2'>Create</a>
    <br>
    @if ($message = Session::get('success'))
        <strong>{{ $message }}</strong>
    @endif    
 </section>
@endsection