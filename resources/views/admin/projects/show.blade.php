@extends('layouts.app')

@section('title',$project->name)

@section('content')

<header class="py-5">
    <h1 class="text-center text-white">{{ucfirst($project->name)}}</h1>
</header>

<div class="row row-cols-2 bg-dark text-white py-5 rounded border border-warning">
  <div class="col d-flex justify-content-center align-items-center">
  <img src="{{$project->image}}" alt="$project->name">
</div>
  <div class="col">
    <p>{{$project->description}}</p>

</div>
</div>

<div class="button-box d-flex justify-content-end mt-3">
    <a href="{{ route('admin.projects.edit',$project->id)}}"class="btn btn-warning"><i class="fa-solid fa-pencil"></i> Edit</a>
   <form action="{{ route('admin.projects.destroy' , $project->id)}}" method="POST">
    @method('DELETE')
    @csrf
    <button  type="submit" class="btn btn-danger mx-2"><i class="fa-solid fa-trash"></i> Delete</button>
   </form>
    <a href="{{ route('admin.projects.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back </a>

</div>



@endsection