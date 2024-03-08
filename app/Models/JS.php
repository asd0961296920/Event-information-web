<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class JS extends Authenticatable
{
    use HasFactory;
    protected $table = 'js';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

    ];

    protected $guarded = [];

    protected $casts = [
       
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


}
