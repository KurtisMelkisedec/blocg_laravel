<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', "user")->latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("posts.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        $imageName  = $request->image->store("posts");
        Post::create(
            [
                'title' => $request->title,
                'content' => $request->content,
                "image" => $imageName
            ]
        );

        return redirect()->route("dashboard")->with("success", "Votre poste a été créé");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        if (! Gate::allows('update-post', $post)) {
            abort(403);
        }
        $categories = Category::all();

        return view("posts.edit", compact("post", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        //

        $data  = [
            'title' => $request->title,
            "content" => $request->title,
        ];
        if ($request->image != null) {
            $imageName  = $request->image->store("posts");
            array_merge($data, ["image" => $imageName]);
        }
        $post->update($data);
        return redirect()->route("dashboard")->with("success", "Votre poste a été modifié");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        if (! Gate::allows('destroy-post', $post)) {
            abort(403);
        }
        $post->delete();
        return redirect()->route("dashboard")->with("success", "Votre poste a été supprimé");
    }
}
