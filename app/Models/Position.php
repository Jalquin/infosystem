<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(mixed $position_id)
 * @method static create(array $all)
 */
class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
