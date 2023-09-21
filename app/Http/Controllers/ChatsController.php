<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }


    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $userid = $user->id;
        $teammembers = TeamMember::where('user_id', $userid)->get();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message, $teammembers[0]->team_id))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
