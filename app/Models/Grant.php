<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'grant_amount',
        'grant_provider',
        'project_description',
        'start_date',
        'end_date',
        'duration',
        'leader_id', // Ensure this is included
    ];

    /**
     * A grant belongs to one project leader.
     */
    public function leader()
    {
        return $this->belongsTo(Academician::class, 'leader_id'); // Correctly link to Academician model
        // return $this->academicians()->wherePivot('role', 'leader')->first(); //
    }
    public function members()
    {
        return $this->academicians()->wherePivot('role', 'member');
    }
    public function academicians()
    {
        return $this->belongsToMany(Academician::class,'academician_grants') // Use pivot table name 'academician_grants'
                    ->withPivot('role')
                    ->withTimestamps();
    }
    /**
     * A grant can have many milestones.
     */
    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}


/*namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grant extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'grant_amount',
        'grant_provider',
        'project_description',
        'start_date',
        'end_date',
        'duration',
        'leader_id',
    ];

    public function academicians()
    {
        return $this->belongsToMany(Academician::class, 'academician_grants')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function leader()
    {
        return $this->academicians()->wherePivot('role', 'leader')->first();
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}
*/


