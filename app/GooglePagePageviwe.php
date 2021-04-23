<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GooglePagePageviwe extends Authenticatable {

    use Notifiable;
public $timestamps = false;
    protected $table = 'page_pageviwe';
    protected $fillable = ['id','path','originpath','pageviwe','date'];

}

?>   