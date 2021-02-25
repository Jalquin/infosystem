<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $all)
 */
class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'note'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class);
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class);
    }
}
