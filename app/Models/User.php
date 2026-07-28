<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name', 
    'email', 
    'password',
    'birthday',
    'part_id',
    'position_id',
    'type_work',        
    'team_id',
    'phone',
    'address',
    'status',           
    'start_day',
    'end_day',
    'type_account_id',
])]
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable
{
    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }


    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

 
    public function typeAccount()
    {
       
        return $this->belongsTo(TypeAccount::class, 'type_account_id', 'id');
    }
   
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
