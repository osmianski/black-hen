<?php

namespace App\Models;

use App\Models\Slug\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Slug
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|Slug newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slug newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slug query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereControllerClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereUpdatedAt($value)
 * @property Type $type
 * @property int|null $organization_id
 * @property int|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slug whereUserId($value)
 * @mixin \Eloquent
 */
class Slug extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'type',
    ];

    protected $casts = [
        'type' => Type::class,
    ];
}
