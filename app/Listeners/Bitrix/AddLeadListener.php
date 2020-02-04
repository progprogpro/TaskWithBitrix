<?php

namespace App\Listeners\Bitrix;

use App\Events\Bitrix\OnAddLead;
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
        Curl::to($event->getUrl())
            ->withOption('RETURNTRANSFER', true)
            ->withData($event->getQueryData())->post();
    }
}
