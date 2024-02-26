<?php

namespace App\Models\Tabsquare;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Post extends Authenticatable
{
    use HasFactory;
    protected $table = 'post';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'post_text',
        'post_url',
        'post_tab',
        'website_name',
        'website_url',
        'imager_title',
        'imager1',
        'imager2',
        'imager3',
        'area_id',
    ];

    protected $guarded = [];

    protected $casts = [
       
    ];

    protected $hidden = [
    ];


}
