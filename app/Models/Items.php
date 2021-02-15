<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'amount',
        'min_amount',
        'price'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories');
    }
}
