<?php

namespace App\Listeners\Bitrix;

use App\Events\Bitrix\OnAddLead;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Curl;

class AddLeadListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OnAddLead  $event
     * @return void
     */
    public function handle(OnAddLead $event)
    {
        // send request to bitrix and add a new lead
       $responce = Curl::to($event->getUrl())
            ->withOption('RETURNTRANSFER',true)
            ->withData($event->getQueryData())->post();

    }
}
