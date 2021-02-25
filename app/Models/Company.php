<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $all)
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'note'
    ];

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class);
    }
}
