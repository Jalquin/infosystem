<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'note'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
