<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $all)
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'zip',
        'city'
    ];

    public function addressType(): BelongsTo
    {
        return $this->belongsTo(AddressType::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class);
    }
}
