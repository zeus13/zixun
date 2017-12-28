<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DateUpdate extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $date;

    public function __construct()
    {
        $this->date = array(
            'stauts' => 0,
            'player' => array(
                [1,2],
                [3,4]
                )
            );
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['date-channel'];
    }
}
