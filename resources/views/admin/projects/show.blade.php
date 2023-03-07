@extends('layouts.app')

@section('title',$project->name)

@section('content')
<header>{{$project->name}}</header>
<img src="{{$project->image}}" alt="$project->name">
<p>{{$project->description}}</p>
@endsection