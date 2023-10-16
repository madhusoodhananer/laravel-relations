<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function carOwner()
    {
        return $this->hasOneThrough(
            Owner::class, 
            Car::class,
            'mechanic_id', // foreign key on cars table
            'car_id', // foreign key on owners table
            'id', // local key on mechanics table
            'id' // local key on cars table
        )->withDefault([
            'name' => 'Anonymous',
            'car_id' => null
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
