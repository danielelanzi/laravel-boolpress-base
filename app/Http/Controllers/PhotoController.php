<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\User;
use App\Post;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        $data = [
            'photos' => $photos,
            'title' => 'Tutte le fotografie'
        ];

        return view('photos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $posts = Post::orderBy('user_id', 'asc')->get();
        $data = [
            'title' => 'Crea una foto',
            'users' => $users,
            'posts' => $posts
        ];

        return view('photos.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // qui validiamo i dati controllando che user e post esistano nel db
        $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'required|string',
            'user_id' => 'required|numeric|exists:users,id',
            'post_id' => 'required|numeric|exists:posts,id',
        ]);


        $data = $request->all();

        //abbiamo controllato se il post è  veramebnte di quell'utente
        //cerco per utente
        //prendo tutti i post di quell'uyetnte gazie alla relazione has many
        //filtriamo per id  post passato dal form
        $post = User::find($data['user_id'])
            ->posts()
            ->where('id', $data['post_id'])->first();

        //se il risultato e' null allora torno indietro con errori e riempiendo i campi giusti
        if (empty($post)) {
            return back()->withInput()->with('errors', 'Il post non è dell\'utente che hai selezionato');
        }

        //creiamo un nuovo record con fill
        $newPhoto = new Photo;
        $newPhoto->fill($data);
        $saved = $newPhoto->save();

        //se tutto e' andato bene torno su index
        if ($saved) {
            return redirect()->route('photos.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);
        // dd($photo);
        if (empty($photo) == true) {
            abort('404');
        }

        $data = [
            'photo' => $photo,
            'title' => 'Dettaglio fotografia'
        ];

        return view('photos.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        if (empty($photo)) {
            abort('404');
        }

        $user_id = $photo->user_id;

        $posts = Post::where('user_id', $user_id)->get();

        $data = [
            'title' => 'Modifica una foto',
            'photo' => $photo,
            'posts' => $posts
        ];

        return view('photos.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
