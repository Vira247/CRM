<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Product extends Authenticatable{
    use Notifiable;
    protected $table = 'product';
    protected $fillable = ['name','sku','vendor_id','created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag','product_type'];
}