<?php

use App\Models\User;
use App\Support\FirstTrainConfetti;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('marks the user after celebrating once', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    FirstTrainConfetti::celebrateIfEligible();

    expect($user->fresh()->first_train_confetti_shown_at)->not->toBeNull();
});

it('does not celebrate again after the first train', function () {
    $user = User::factory()->create([
        'first_train_confetti_shown_at' => now()->subDay(),
    ]);

    $this->actingAs($user);

    FirstTrainConfetti::celebrateIfEligible();

    expect($user->fresh()->first_train_confetti_shown_at->toDateString())
        ->toBe(now()->subDay()->toDateString());
});
