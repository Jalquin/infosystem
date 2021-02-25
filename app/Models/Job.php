<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $all)
 * @method static whereIn(string $string, int[] $array)
 */
class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'date',
        'description',
        'tender_number',
        'invoice_number'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class);
    }

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }
}
