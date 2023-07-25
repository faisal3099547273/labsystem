<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Maatwebsite\Excel\Concerns\ToModel;
class Customer extends Model
{
    use HasFactory;

    use  HasFactory, Notifiable;

  

    protected $guarded = [];
    protected $table = 'customers';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'customer_users','user_id','customer_id');
    }
}
