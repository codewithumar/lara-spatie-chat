<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**x
     * Create a new event instance.
     */

    public $user;
    public $message;
    public $team;

    public function __construct(User $user, Message $message,  $team)
    {
        $this->user = $user;
        $this->message = $message;
        $this->team = $team;
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return
            new PrivateChannel('chat-' . $this->team);
    }
    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'chat';
    }

    public function broadcastWith(): array
    {
        return [
            'user' => $this->user,
            'message' => $this->message,
            'team' => $this->team,
        ];
    }
}
