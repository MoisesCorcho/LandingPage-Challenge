<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\NotifyWinningUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WinnerUserNotification;

class SendNotification
{
    private $user;
    /**
     * Create the event listener.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     */
    public function handle(NotifyWinningUser $event): void
    {
        $winner = User::where('is_winner', true)->first();
        Notification::send($winner, new WinnerUserNotification($winner));

        // $moises = User::where('name', 'Moises')->first();
        // Notification::send($moises, new WinnerUserNotification($moises));
    }
}
