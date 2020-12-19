<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class OrderLog extends Authenticatable{
    use Notifiable;
    public $timestamps = false;
    protected $table = 'order_log';
    protected $fillable = ['order_id','user_id','message','old_data','new_data','created_at'];
}