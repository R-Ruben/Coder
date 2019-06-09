<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Helpers\AppHelper;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = AppHelper::instance()->getFriends(auth()->user()->id);
        return view('chats.index')->with('friends', $friends);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $correspondent = User::find($id);

        $data = [
            'correspondent' => $correspondent,
            'friends' => AppHelper::instance()->getFriends(auth()->user()->id),
        ];

        return view('chats.show')->with($data);
    }

    /**
     * Get messages for current chat
     *
     * @param Request $request
     * @return Messages
     */
    public function getMessages(Request $request)
    {
        $client = auth()->user()->id;
        $correspondent = $request->correspondent;

        $messages = Message::where(function ($query) use ($client, $correspondent) {
            $query->where('user_id', $client)
                ->where('receiving_user_id', $correspondent);
        })->orWhere(function ($query) use ($client, $correspondent) {
            $query->where('user_id', $correspondent)
                ->where('receiving_user_id', $client);
        })->with('user')->get();

        return $messages;

    }

    /**
     * Send message to correspondent
     *
     * @param Request $request
     * @return void
     */
    public function sendMessage(Request $request)
    {

        $message = new Message;
        $message->user_id = auth()->user()->id;
        $message->receiving_user_id = $request->correspondent;
        $message->message = $request->message;
        $message->save();

        event(new MessageSent($message->load('user')));

        return ['status' => 'success'];

    }

}
