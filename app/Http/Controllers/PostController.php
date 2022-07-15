<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ::with('category') permet de charger les catégories associées aux posts en même temps que les posts (1 requête)
        $posts = Post::with('category', 'user')->latest()->get();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        // php artisan make:request StorePostRequest
        // file .env put FILESYSTEM_DISK to public for create folder
        // php artisan storage:link

        $imageName = $request->image->store('posts');

        Post::create([
            'title'     => $request->title,
            'content'   => $request->content,
            'image'     => $imageName,
        ]);

        return redirect()->route('dashboard')->with('success', 'L\'article a bien été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Gate définie dans app/Providers/AuthServiceProvider.php
        if(Gate::denies('update-post', $post)) {
            abort(403);
        }

        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        $arrayUpdate = [
            'title'     => $request->title,
            'content'   => $request->content,
            'category_id' => $request->category,
        ];

        if($request->image !== null){ // Si j'ai modifié l'image
            $imageName = $request->image->store('posts');
            $arrayUpdate = array_merge($arrayUpdate, ['image' => $imageName]); // Fusion de deux tableaux
        }
        
        $post->update($arrayUpdate);

        return redirect()->route('dashboard')->with('success', 'Votre article a bien été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::denies('destroy-post', $post)) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Votre article a bien été supprimé !');

    }
}
