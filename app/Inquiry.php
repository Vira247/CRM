<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Inquiry extends Authenticatable{
    use Notifiable;
    protected $table = 'inquiry';
    protected $fillable = ['name','phone','email','remark','status','created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag','follow_up_date','product_id','assign_to'];
}