<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
