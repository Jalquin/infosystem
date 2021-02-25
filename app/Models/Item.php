<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static where(string $string, int $int)
 * @method static create(array $array)
 * @method static findOrFail($id)
 */
class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'amount',
        'min_amount',
        'is_enough',
        'price'];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class);
    }
}
