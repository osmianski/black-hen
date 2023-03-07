<?php

namespace App\Models\Slug;

use App\Exceptions\NotImplemented;
use App\Http\Controllers\PageController;

enum Type: string
{
    case User = 'user';
    case Organization = 'organization';
}
