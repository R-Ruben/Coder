<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Notifications\RepliedToPost;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            'body' => 'required',
        ]);


        // Create comment
        $post = Post::find($request->post_id);
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->body = $request->input('body');
        $comment->rep = 0;
        $post->comments()->save($comment);

        $post->user->notify(new RepliedToPost($post));
    
        return redirect('/posts/'.$request->post_id)->with('success','Comment placed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show')->with('comment', $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);

        // Authenticate user
        if(auth()->user()->id !== $comment->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }
        return view('comments.edit')->with('comment', $comment);
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
            'body' => 'required',
        ]);


        // Create comment
        $comment = Comment::find($id);
        $comment->body = $request->input('body');
        $comment->save();


        return redirect('/posts/'.$comment->post_id)->with('success','Comment edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        // Check user authorization
        if(auth()->user()->id !== $comment->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        $comment->delete();
        return redirect('/posts/'.$comment->post_id)->with('success','Comment deleted.');    }
}
