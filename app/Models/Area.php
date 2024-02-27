<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Area extends Authenticatable
{
    use HasFactory;
    protected $table = 'area';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nation',
        'city',
        'village',
    ];

    protected $guarded = [];

    protected $casts = [
       
    ];

    protected $hidden = [
    ];


}
