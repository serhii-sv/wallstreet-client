<?php

namespace App\Events;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivateChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public $message_id;
    public $user;
    public $chat_id;
    public $time;
    
    public function __construct($user, $message_id) {
        $chatMessage = ChatMessage::find($message_id);
        $this->chat_id = $chatMessage->chat_id;
        $this->user = $chatMessage->user_id;
        $this->message = $chatMessage->message;
        $this->message_id = $chatMessage->id;
        $this->time = $chatMessage->created_at->format('d.M H:i:s');
    }
    
    public function broadcastOn() {
        return new PrivateChannel('chat.' . $this->chat_id);
    }
    
    public function broadcastWith() {
        return [
            'user' => $this->user,
            'chat_id' => $this->chat_id,
            'message' => $this->message,
            'time' => $this->time,
            'message_id' => $this->message_id,
        ];
    }
}
