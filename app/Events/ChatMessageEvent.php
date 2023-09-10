<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userObject;
    public $otherUserId;
    public $otherUserObj;
    public $messageObj;
    public $roomId;
    
  
    /**
     * Create a new event instance.
     */ 
    public function __construct($userObject, $otherUserId, $otherUserObj, $messageObj, $roomId)
    {
        $this->userObject = $userObject ? $userObject->only('id','firstname','lastname','email','photo') : 'Anonymous';
        $this->otherUserId = $otherUserId;
        $this->messageObj = $messageObj;
        $this->roomId = $roomId;
        $this->otherUserObj = $otherUserObj;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        //return new Channel('public.chat.' . $this->roomId);
        return new PrivateChannel('private.chat.' . $this->roomId);
    }

    public function broadcastAs()
    {
        return 'chat-message';
    }

    public function broadcastWith()
    {
        return [
            'messageObj' => $this->messageObj,
            'user' => $this->userObject,
            'otherUserId' => $this->otherUserId,
        ];
    }
}
