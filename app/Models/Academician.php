<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academician extends Model
{
    //use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'college',
        'department',
        'position',
        'staff_number',
        'user_id'
    ];
    public function ledGrants()
    {
        return $this->hasMany(Grant::class, 'leader_id');  // One to many (Academician -> Grants)
    }
    public function grants()
    {
        return $this->belongsToMany(Grant::class, 'academician_grants')
            ->withPivot('role')
            ->withTimestamps();
    }
}
