<?php

namespace App\Http\Controllers;

use App\Notifications\LikedPost;
use App\Post;
use App\Reputation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReputationController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $receiving_user = User::find($request->receiving_id);
        $post = Post::find($request->post_id);

        if (Reputation::where('sending_user_id', $request->sending_id)->where('post_id', $request->post_id)->first() == null) {
            $rep = new Reputation;

            $post->user->notify(new LikedPost($post, $request->score));

            $rep->post_id = $request->receiving_id;
            $rep->receiving_user_id = $request->receiving_id;
            $rep->sending_user_id = $request->sending_id;
            $rep->score = $request->score;

            $post->reputations()->save($rep);
            $post->rep = $post->rep + $request->score;
            $post->save();

            $receiving_user->rep = $receiving_user->rep + $request->score;
            $receiving_user->save();

            return redirect('/posts')->with('Success', "Reputation granted.");
        } else {

            $rep = Reputation::where('sending_user_id', $request->sending_id)->first();
            if ($request->score == $rep->score) {
                $rep->score = 0;
                $receiving_user->rep -= $request->score;
                $post->rep -= $request->score;
            } else if ($request->score == 1) {
                $rep->score = 1;
                $receiving_user->rep += $request->score;
                $post->rep += $request->score;
            } else if ($request->score == -1) {
                $rep->score = -1;
                $receiving_user->rep += $request->score;
                $post->rep += $request->score;
            }

            $post->reputations()->save($rep);

            $post->save();

            $receiving_user->save();

            return redirect('/posts')->with('Success', "Reputation granted.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $currentLike = Reputation::where('sending_user_id', $request->sending_id)->where('post_id', $request->post_id)->first();
        if ($currentLike) {
            return $currentLike->score;
        }

    }
}
