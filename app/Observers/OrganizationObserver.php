<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Organization;
use App\Models\Slug;

class OrganizationObserver
{
    /**
     * Handle the Organization "created" event.
     */
    public function created(Organization $organization): void
    {
        $organization->account()->create([
            'type' => Account\Type::Organization,
        ]);

        $organization->slug()->create([
            'slug' => $organization->slug,
            'type' => Slug\Type::Organization,
        ]);
    }
}
