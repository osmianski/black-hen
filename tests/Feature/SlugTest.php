<?php

use App\Models\Organization;
use App\Models\User;
use App\Models\Slug;

it('creates slugs for new users', function() {
    $user = User::factory()->create();

    $this->assertDatabaseHas('slugs', [
        'slug' => $user->slug,
        'type' => Slug\Type::User,
        'user_id' => $user->id,
    ]);
});

it('creates slugs for new organizations', function() {
    $organization = Organization::factory()->create();

    $this->assertDatabaseHas('slugs', [
        'slug' => $organization->slug,
        'type' => Slug\Type::Organization,
        'organization_id' => $organization->id,
    ]);
});
