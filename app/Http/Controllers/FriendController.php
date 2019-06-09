<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('friends.index')->with([
            'friends' => json_decode(AppHelper::instance()->getFriends(auth()->user()->id)),
            'friendRequests' => AppHelper::instance()->getFriendRequests()]);
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
            'user_id' => 'required',
            'receiving_user_id' => 'required',
        ]);

        //Check if friend request already sent
        if(!Friend::where('user_id',auth()->user()->id)->where('receiving_user_id',$request->receving_user_id)->first()) {
        //Check if new friend request or accept if already requested
        if(!Friend::where('receiving_user_id',auth()->user()->id)->where('user_id',$request->receving_user_id)->first()) {
        $friendship = new Friend;
        $friendship->user_id = $request->user_id;
        $friendship->receiving_user_id = $request->receiving_user_id;
        $friendship->accepted = 0;
        $friendship->save();
        } else {
            $friendship = Friend::where('receiving_user_id',auth()->user()->id)->where('user_id',$request->receving_user_id)->first();
            $friendship->accepted = 1;
            $friendship->save();
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $friendship = Friend::where('receiving_user_id',auth()->user()->id)->where('user_id',$request->correspondent_id)->first();
        $friendship->accepted = $request->accepted;
        $friendship->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }
}
