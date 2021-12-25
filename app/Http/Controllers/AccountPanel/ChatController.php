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
    /**
     * @param null $chat_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function index($chat_id = null) {
        $user = \auth()->user();
        if ($chat_id !== null && Uuid::isValid($chat_id)) {
            $chat = Chat::where('id', $chat_id)->first();
            if ($chat->checkUser(Auth::user()->id)) {
                if ($chat->getUnreadMessagesCount(Auth::user()->id) > 0) {
                    foreach ($chat->getUnreadMessages(Auth::user()->id) as $item) {
                        $item->update(['is_read' => true]);
                    }
                }
                //PrivateChat::dispatch("Пользователь ". Auth::user()->login ." вошёл в чат", $chat_id, Auth::user()->id);
                $companion = $chat->getCompanion();
                $companionAvatar = $companion->avatar ? route('accountPanel.profile.get.avatar', $companion->id) : asset('accountPanel/images/user/16.png');
                $chat_messages = ChatMessage::where('chat_id', $chat->id)->orderBy('created_at', 'asc')->get();
            } else {
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

        $filteredReferrals = [];
        $activeCats = [];
        if (is_null(\request()->login)) {
            $activeCats = Chat::with('userReferral')->whereHas('chatMessages')->where(function ($q) use ($user) {
                $q->where('user_partner', $user->id);
            })->get();
        } else {
            $filteredReferrals = $user->referrals()->where('login', 'like', '%' . \request()->login . '%')->get();
        }

        $myAvatar = Auth()->user()->avatar ? route('accountPanel.profile.get.avatar', auth()->user()->id) : asset('accountPanel/images/user/user.png');
        return view('accountPanel.chat.index', [
            'chat_id' => $chat_id,
            'chat' => $chat,
            'companion' => $companion,
            'myAvatar' => $myAvatar,
            'companionAvatar' => $companionAvatar,
            'chat_messages' => $chat_messages,
            'activeChats' => $activeCats,
            'login' => \request()->login,
            'filteredReferrals' => $filteredReferrals
        ]);
    }

    /**
     * @param Request $request
     */
    public function sendMessage(Request $request) {
        if ($request->post('type') == 'message') {
            $chat_id = $request->post('chat_id');
            $msg = $request->post('message');
            if (strlen($msg) > 0) {
                $chat = Chat::where('id', $chat_id)->first();
                if (!empty($chat)) {
                    $message = new ChatMessage();
                    $message->chat_id = $chat_id;
                    $message->user_id = $request->post('user');
                    $message->message = $msg;
                    $message->is_read = false;
                    $message->save();
                    broadcast(new PrivateChat($request->post('user'), $message->id));
                    $notification_data = [
                        'notification_name' => 'Новое сообщение',
                        'user' => $chat->user_partner == $request->post('user') ? User::where('id', $chat->user_referral)->first() : User::where('id', $chat->user_partner)->first(),
                        'from_user' => $request->post('user'),
                    ];
                    Notification::sendNotification($notification_data, 'new_message');
                } else {
                    $message = false;
                }

            }
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function readMessage(Request $request) {
        $user_id = $request->post('user');
        $message_id = $request->post('message_id');
        $message = ChatMessage::where('id', $message_id)->firstOrFail();
        if ($message->user !== $user_id) {
            $message->update(['is_read' => true]);
            return 'upd';
        }
        return 'not upd';
    }

}
