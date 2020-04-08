@extends('layouts.layout')
@section('header')
    <div class="col-12">
      <h1>{{$title}}</h1>
    </div>
@endsection
@section('main')
    <table class="table table-striped">
      <thead class="thead-dark ">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Path</th>
          <th>User Name</th>
          <th>Post Title</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($photos as $photo)
          <tr>
            <td>{{$photo->id}}</td>
            <td>{{$photo->title}}</td>
            <td>{{$photo->path}}</td>
            <td><a href="{{route('users.show', $photo->user->id)}}">{{$photo->user->name}}</a></td>
            <td>{{$photo->post->title}}</td>
          <td><a href="{{route('photos.show', $photo->id)}}" class="btn btn-primary">View</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    
@endsection
@section('footer')
    
@endsection