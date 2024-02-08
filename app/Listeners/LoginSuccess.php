<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Auth\Events\Login as LoginEvent;

use App\Models\Login;
use Auth, Log;

class LoginSuccess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoginEvent $event): void
    {
        //
        Login::create([
            'user_id' => $event->user->id,
            'ip_address' => request()->ip(),
        ]);

        Log::info('Le user '.$event->user->name. ' vient de se connecter depuis l\'adresse ip: '.request()->ip());
    }
}
