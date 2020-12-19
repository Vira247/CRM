<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class OrderItemDetail extends Authenticatable{
    use Notifiable;
    protected $table = 'order_item_detail';
    protected $fillable = ['order_id','vendor_id','producttype','product_id','quantity','price','amount',
    'created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag','itemunit'];
}