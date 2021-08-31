<?php

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//Broadcast::channel('private-chat', function ($user, $chat_id) {
//    return true;
//});
Broadcast::channel('chat.{chat_id}', function ($user, $chat_id) {
    $chat = Chat::where('id', $chat_id)->first();
    if ($chat->checkUser($user->id)) {
        return true;
    }
});