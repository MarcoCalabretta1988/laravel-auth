@extends('layouts.app')

@section('title','Projects')

@section('content')

<section id="projects" >
   <header class="d-flex justify-content-between align-items-center py-5">
    <h1 class="text-white">Projects:</h1>
    <a href="{{ route('admin.projects.create')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add</a>
   </header>
    <table class="table table-dark table-striped ">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Create At</th>
            <th scope="col">Update At</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>    
            <th scope="row">{{$project->id}}</th>
            <td>{{$project->name}}</td>
            <td>{{$project->created_at}}</td>
            <td>{{$project->updated_at}}</td>
            <td>
              <div class="button-box d-flex justify-content-end">
                  <a href="{{route('admin.projects.show',$project->id)}}" class="btn btn-sm btn-primary"><i class="fa-sharp fa-solid fa-eye"></i></a>
                  <a href="{{ route('admin.projects.edit',$project->id)}}"class="btn btn-warning  btn-sm mx-2"><i class="fa-solid fa-pencil"></i></a>
                 <form action="{{ route('admin.projects.destroy' , $project->id)}}" method="POST" class="delete-form">
                  @method('DELETE')
                  @csrf
                  <button  type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                 </form>
              </div>
              </td>
          </tr>
            @endforeach
        </tbody>
      </table>
</section>
@endsection