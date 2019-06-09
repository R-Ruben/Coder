<?php

namespace App\Http\Controllers;

use App\Post;
use App\ProgrammingLanguage;
use App\Reputation;
use App\User;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'top_category' => 'nullable',
        ]);

        $body = $request->input('body');

        // Create post
        $post = new Post;

        $post->title = $request->input('title');
        $post->body = $body;
        $post->user_id = auth()->user()->id;
        $post->rep = 0;

        //Set category
        $top_category_id = $request->input('top_category');
        if ($top_category_id == null) {
            $post->top_category_id = 3;
        } else {
            $post->top_category_id = $top_category_id;
        }
        
        $post->save();

        AppHelper::instance()->AssignProgrammingLanguages($body, $post);

        return redirect('/posts')->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Authenticate user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'top_category' => 'nullable',
        ]);


        //Create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        //Set category
        $top_category_id = $request->input('top_category');
        if ($top_category_id == null) {
            $post->top_category_id = 3;
        } else {
            $post->top_category_id = $top_category_id;
        }

        $post->save();


        AppHelper::instance()->AssignProgrammingLanguages($post->body, $post);


        return redirect('/posts')->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check user authorization
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        if ($post->cover_image != 'noimage.jpg') {
            //Delete image
            Storage::delete('public/files/' . $post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }


    

}



