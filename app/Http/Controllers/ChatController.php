<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getRooms()
    {
        return ChatRoom::all();
    }

    public function getRoom($roomId)
    {
        return ChatRoom::find($roomId);
    }

    public function getMessages(Request $request, $roomId)
    {
        return ChatMessage::where('chat_room_id', $roomId)->with('user')->orderBy('created_at', 'ASC')->get();
    }

    public function newMessage(Request $request, $roomId)
    {
        $newChatMessage = ChatMessage::create([
            "chat_room_id" => $roomId,
            "user_id" => Auth::id(),
            "chat_message" => $request->message
        ]);
        broadcast(new NewChatMessage($newChatMessage))->toOthers();
        return $newChatMessage;
    }
}
