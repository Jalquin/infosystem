<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'date',
        'description',
        'invoice_number'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }
}
