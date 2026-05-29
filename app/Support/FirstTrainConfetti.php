<?php

namespace App\Support;

use AlexSyvolap\FilamentConfetti\Confetti;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FirstTrainConfetti
{
    public static function celebrateIfEligible(): void
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            return;
        }

        if ($user->first_train_confetti_shown_at !== null) {
            return;
        }

        $user->forceFill([
            'first_train_confetti_shown_at' => now(),
        ])->save();

        Confetti::realistic()->shoot();
    }
}
