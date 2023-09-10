<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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


// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


// Broadcast::channel('private.chat.{roomId}', function ($user, $roomId) {
    
//     $roomId = (int) $roomId;
//     $ChatObj1 = Chat::where('roomId', $roomId)->latest()->get();
//     $userId = $ChatObj1[0]->userId;
//     $otherUserId = $ChatObj1[0]->otherUserId;

//     if($user->id == $userId || $user->id == $otherUserId) {
//         return true;
//     } else {
//         return false;
//     }
    
// });



