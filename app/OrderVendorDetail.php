<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class OrderVendorDetail extends Authenticatable{
    use Notifiable;
    protected $table = 'order_vendor_detail';
    protected $fillable = ['order_id','vendor_id','invoice_number','vendor_pick_up_reference','vendor_invoice_amount','vendor_sales_tax_amount',
    'vendor_invoice_paid','vendor_invoice_paid','vendor_paid_via','broker','carrier','bol_number','pick_up_zip_code','delevery_zip_code',
    'total_weight','shipment','shipping_cost','shipping_paid_cost','shipping_paid_via','tracking_number',
    'created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag','vendor_replacement','delivery_remark','distance'];
}