@extends('layouts.layout')
@section('header')
@if (session('errors'))
    <div class="alert alert-success">
        {{ session('errors') }}
    </div>
@endif
 {{-- @dd($users, $posts, $title) --}}
    <div class="col-12">
      <h1>{{$title}}</h1>
    </div>
@endsection
@section('main')
  <form action="{{route('photos.store')}}" method="post">
       @csrf
      @method('POST')
        <div class="form-group">
          <label for="path">Path</label>
          <input type="text" name="path" class="form-control" value="{{ old('path') }}">
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
          <label for="user_id">User</label>
          <select name="user_id" id="user_id" class="form-control">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="post_id">Post</label>
          <select name="post_id" id="post_id" class="form-control">
            @foreach ($posts as $post)
                <option value="{{$post->id}}"> {{$post->user->name}} - {{$post->title}} </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Salva</button>
        </div>
    </form>
@endsection
@section('footer')
    
@endsection