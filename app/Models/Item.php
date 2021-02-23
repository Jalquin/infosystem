<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
