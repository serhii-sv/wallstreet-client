<?php

namespace App\Http\Controllers;

use App\Events\PrivateChat;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Ramsey\Uuid\Uuid;

class ChatController extends Controller
{
    //
    
    public function index($chat_id = null) {
        if ($chat_id !== null && Uuid::isValid($chat_id)) {
            $chat = Chat::where('id', $chat_id)->first();
            if ($chat->checkUser(Auth::user()->id)){
                $companion = $chat->getCompanion();
                $companionAvatar = $companion->avatar ? route('accountPanel.profile.get.avatar',$companion->id) : asset('accountPanel/images/user/16.png');
                $chat_messages = ChatMessage::where('chat_id', $chat->id)->orderBy('created_at', 'asc')->get();
            }else {
                $chat = false;
                $companion = false;
                $companionAvatar = false;
                $chat_messages = false;
            }
        } else {
            $chat = false;
            $companion = false;
            $companionAvatar = false;
            $chat_messages = false;
        }
        $myAvatar = Auth()->user()->avatar ? route('accountPanel.profile.get.avatar',Auth()->user()->id) : asset('accountPanel/images/user/16.png');
        return view('accountPanel.chat.index', [
            'chat_id' => $chat_id,
            'chat' => $chat,
            'companion' => $companion,
            'myAvatar' =>$myAvatar,
            'companionAvatar' => $companionAvatar,
            'chat_messages' => $chat_messages,
        ]);
    }
  
}
