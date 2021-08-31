<?php

namespace App\Http\Controllers\AccountPanel;

use App\Events\Message;
use App\Events\PrivateChat;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ChatController extends Controller
{
    //
    
    public function index($chat_id = null) {
        if ($chat_id !== null && Uuid::isValid($chat_id)) {
            $chat = Chat::where('id', $chat_id)->first();
            if ($chat->checkUser(Auth::user()->id)){
                //PrivateChat::dispatch("Пользователь ". Auth::user()->login ." вошёл в чат", $chat_id, Auth::user()->id);
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
    
    public function sendMessage(Request $request) {
        if($request->post('type') == 'message'){
            $chat_id = $request->post('chat_id');
            $msg = $request->post('message');
            if (strlen($msg) > 0) {
                $chat = Chat::where('id', $chat_id)->first();
                if (!empty($chat)) {
                    $message = new ChatMessage();
                    $message->chat_id = $chat_id;
                    $message->user_id = $request->post('user');
                    $message->message = $msg;
                    $message->save();
                    broadcast(new PrivateChat($request->post('user'), $message->id));
                    $notification_data = [
                        'notification_name' => 'Новое сообщение',
                        'user' => $chat->user_partner == $request->post('user') ? User::where('id',$chat->user_referral)->first() : User::where('id',$chat->user_partner)->first(),
                        'from_user'=> $request->post('user'),
                    ];
                    Notification::sendNotification($notification_data, 'new_message');
                } else {
                    $message = false;
                }
            
            }
        }
    }
  
}
