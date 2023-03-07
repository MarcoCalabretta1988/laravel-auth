@extends('layouts.app')

@section('title','Projects')

@section('content')

<section id="projects">
   <header>
    <h1 class="my-5">Projects:</h1>
   </header>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Create At</th>
            <th scope="col">Update At</th>
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
                <a href="{{route('admin.projects.show',$project->id)}}" class="btn btn-small btn-primary"><i class="fa-sharp fa-solid fa-eye"></i></a>
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
</section>
@endsection