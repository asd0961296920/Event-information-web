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
        'name',
        'title_filter',
        'body_filter',
        'imager1_filter',
        'imager2_filter',
        'imager3_filter',
        'url',
        'area_id',
        'connect_url',
        'post_filter',
        'table_page',
        'page_bool',
        'page',
        'enble',
        'imager_url',
        'imager_bool',
        'event_date_filter',
    ];

    protected $guarded = [];

    protected $casts = [
        'enble' => 'boolean',
        'page_bool' => 'boolean',
        'imager_bool' => 'boolean',
    ];

    protected $hidden = [
    ];
    public function area(){
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

}
