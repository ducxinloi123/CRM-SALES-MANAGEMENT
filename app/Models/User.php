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
    'sex',              // 0: nam, 1: nu
    'part_id',
    'position_id',
    'type_work',        // 0: fulltime, 1: parttime
    'team_id',
    'phone',
    'address',
    'status',           // 0: Dang Lam, 1: Nghi Viec
    'start_day',
    'end_day',
    'type_account_id',
])]
#[Hidden(['password', 'remember_token'])]

class User extends Authenticatable
{
    /**
     * Mối quan hệ với bảng Parts (Phòng ban/Bộ phận)
     */
    public function part()
    {
        // Giả sử Model của bạn tên là Part
        return $this->belongsTo(Part::class, 'part_id', 'id');
    }

    /**
     * Mối quan hệ với bảng Positions (Chức vụ)
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    /**
     * Mối quan hệ với bảng Teams (Đội/Nhóm)
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * Mối quan hệ với bảng TypeAccounts (Loại tài khoản)
     */
    public function typeAccount()
    {
        // Tên method viết theo kiểu camelCase, Laravel sẽ tự hiểu
        return $this->belongsTo(TypeAccount::class, 'type_account_id', 'id');
    }
    /** @use HasFactory<UserFactory> */
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
