@foreach ($users as $user)
    Nome {{$user->name}} <br>
    Avatar {{$user->avatar['path']}}  <br>
    {{-- @dd($user->posts) --}}
    @foreach ($user->posts as $post)
        Post Title{{$post->title}} <br>
    @endforeach
    <br>
 @endforeach