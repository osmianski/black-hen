<?php

use App\Models\Organization;
use App\Models\User;
use App\Models\Account;

it('creates accounts for new users', function() {
    $user = User::factory()->create();

    $this->assertDatabaseHas('accounts', [
        'type' => Account\Type::User,
        'user_id' => $user->id,
    ]);
});

it('creates accounts for new organizations', function() {
    $organization = Organization::factory()->create();

    $this->assertDatabaseHas('accounts', [
        'type' => Account\Type::Organization,
        'organization_id' => $organization->id,
    ]);
});
