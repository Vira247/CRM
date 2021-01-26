<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class InquiryData extends Authenticatable{
    use Notifiable;
    protected $table = 'inquiry_data';
    protected $fillable = ['inquiry_id','description','follow_up_date','created_at','created_by','attachment','updated_at','deleted_by','deleted_at','delete_flag'];
}