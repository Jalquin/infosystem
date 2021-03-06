<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $all)
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
