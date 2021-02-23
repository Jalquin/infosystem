<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
