<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'note'
    ];

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }
}
