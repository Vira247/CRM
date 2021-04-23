<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GoogleAnalyticsByTime extends Authenticatable
{

    use Notifiable;
    public $timestamps = false;
    protected $table = 'google_analytics_by_time';
    protected $fillable = ['id', 'date', 'date_time', 'total_session', 'total_pageviews', 'session', 'pageviews'];
}
