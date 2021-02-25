<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static whereIn(string $string, mixed $categories)
 * @method static create(array $all)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }
}
