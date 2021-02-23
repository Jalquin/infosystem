<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
