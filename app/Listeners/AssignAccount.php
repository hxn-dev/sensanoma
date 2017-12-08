<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Account;

class AssignAccount
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $account = Account::create(['name' => $event->user->name]);
        $event->user->update(['account_id' => $account->id]);
    }
}
