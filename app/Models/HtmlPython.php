<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;


class HtmlPython extends Authenticatable
{
    use HasFactory;
    protected $table = 'html_python';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

    ];

    protected $guarded = [];

    protected $casts = [
        'enble' => 'boolean',
        'page_bool' => 'boolean',
        'imager_bool' => 'boolean',
    ];

    protected $hidden = [
    ];


}
