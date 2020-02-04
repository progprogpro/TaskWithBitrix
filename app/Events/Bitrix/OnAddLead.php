<?php

namespace App\Events\Bitrix;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OnAddLead
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $data;
    private $queryData;

    private $url;
    private $method;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = $data;
        $this->method = config('api.bitrix.methods.addLead');
        $this->url = str_replace('profile', $this->method, config('api.bitrix.incomeHookUrl'));


        $this->setQueryData([
            'fields' => [
                "TITLE" => $this->data['title'],
                "NAME" => $this->data['name'],
                "STATUS_ID" => "NEW",
                "OPENED" => "Y",
                "PHONE" => [["VALUE" => $this->data['phone'], "VALUE_TYPE" => "WORK" ]],
                "EMAIL" => [["VALUE" => $this->data['email'], "VALUE_TYPE" => "WORK" ]],
            ],
            'params' => ["REGISTER_SONET_EVENT" => "Y"]
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }

    /**
     * @return mixed
     */
    public function getQueryData()
    {
        return $this->queryData;
    }

    /**
     * @param mixed $queryData
     */
    public function setQueryData($queryData): void
    {
        $this->queryData = $queryData;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}
