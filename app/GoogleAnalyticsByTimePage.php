<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class GoogleAnalyticsByTimePage extends Authenticatable{
    use Notifiable;
    public $timestamps = false;
    protected $table = 'google_analytics_by_time_page';
    protected $fillable = ['name','date','page_view','page_path'];
}