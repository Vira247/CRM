<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class InquiryProduct extends Authenticatable{
    use Notifiable;
    protected $table = 'inquiry_product';
    protected $fillable = ['inquiry_id','product_id','delete_flag','created_by','created_at','updated_by','updated_at','deleted_by','deleted_at'];
}