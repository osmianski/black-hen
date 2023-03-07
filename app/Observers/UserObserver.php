<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\User;
use App\Models\Slug;

class UserObserver
{
    public function created(User $user): void
    {
        $user->account()->create([
            'type' => Account\Type::User,
        ]);

        $user->slug()->create([
            'slug' => $user->slug,
            'type' => Slug\Type::User,
        ]);
    }
}
