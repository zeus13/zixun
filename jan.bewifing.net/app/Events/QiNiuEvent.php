<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QiNiuEvent extends Event
{
    use SerializesModels;

    /**
     * [__construct description]
     * @param [type] $url  []
     * @param [type] $type [上传图片类型] 1聊天，2头像
     */
    public function __construct($url,$type)
    {
        $this->url = $url;
        $this->type = $type;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
