<?php

namespace App\Services;

use App\Events\NotifyWinningUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class WinnerSelector
{
    public function selectWinnerIfAvailable(): Model | null
    {
        if ($this->enoughUsersRegistered()) {
            return $this->selectWinner();
        }
        return null;
    }

    private function enoughUsersRegistered(): bool
    {
        return User::countRegisteredUsers() >= 5;
    }

    private function selectWinner(): Model
    {
        $user = User::getAllExceptAdmin()->random();

        $this->markAsWinner($user);
        $this->notifyWiinner($user);

        return $user;
    }

    private function markAsWinner(User $user): void
    {
        $user->update(['is_winner' => 1]);
    }

    private function notifyWiinner(User $user): void
    {
        event(new NotifyWinningUser($user));
    }
}
