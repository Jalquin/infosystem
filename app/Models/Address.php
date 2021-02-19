<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'zip',
        'city'
    ];

    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
