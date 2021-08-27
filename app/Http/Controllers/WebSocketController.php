<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class WebSocketController implements MessageComponentInterface
{
    protected $clients;
    public    $users;
    private   $chats;
    
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
        $this->chats = [];
    }
    
    
    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $this->users[$conn->resourceId] = [
            'conn' => $conn,
            'user' => null,
            'chat_id' => null,
        ];
        
        echo "Новое соединение! {{$conn->resourceId}}\n";
    }
    
    public function onMessage(ConnectionInterface $conn, $msg) {
        $data = json_decode($msg);
        if (isset($data->status)) {
            switch ($data->status) {
                case "check":
                    $this->users[$conn->resourceId] = [
                        'conn' => $conn,
                        'user' => $data->current_user,
                        'user_partner' => $data->user_partner,
                        'user_referral' => $data->user_referral,
                        'chat_id' => $data->chat,
                    ];
                    break;
                case "message":
                    echo sprintf("Connection-%d отправило сообщение %s " . "\n", $conn->resourceId, $msg);
                    $chat_id = $data->chat;
                    $msg = json_decode($msg, true);
                    if (strlen($msg['message']) > 0) {
                        $chat = Chat::where('id', $chat_id)->first();
                        if (!empty($chat)) {
                            $message = new ChatMessage();
                            $message->chat_id = $chat_id;
                            $message->user_id = $data->user;
                            $message->message = $data->message;
                            $message->save();
                            $notification_data = [
                                'notification_name' => 'Новое сообщение',
                                'user' => $chat->user_partner == $data->user ? User::where('id',$chat->user_referral)->first() :User::where('id',$chat->user_partner)->first(),
                                'from_user'=> $data->user,
                            ];
                            Notification::sendNotification($notification_data, 'new_message');
                        } else {
                            $message = false;
                        }
                        foreach ($this->users as $resource_id => $item) {
                            if ($conn !== $item['conn'] && $chat_id == $item['chat_id']) {
                                if ($chat->user_partner == $item['user_partner'] && $chat->user_referral == $item['user_referral']) {
                                    if ($message) {
                                        echo 'Сообщение отправлено для ' . $item['user'] . '\n';
                                        $msg['message'] = htmlspecialchars($msg['message']);
                                        $msg['time'] = $message->created_at->format('d.M H:i:s');
                                        $item['conn']->send(json_encode($msg));
                                    }
                                }
                            }
                        }
                    }
                    break;
            }
        }
    }
    
    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Соединение {$conn->resourceId} закрыто!\n";
        unset($this->users[$conn->resourceId]);
    }
    
    
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
    
    
}
