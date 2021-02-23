<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Order extends Authenticatable{
    use Notifiable;
    protected $table = 'order_master';
    protected $fillable = ['site','platform','order_date','order_id','order_status','sample_order','order_amount','vat_tax_amount','comission_other_charges','customer_name','phone_number','email',
    'shipping_address_line_1','shipping_address_line_2','shipping_city','shipping_state','shipping_zip_code','shipping_country',
    'billing_address_line_1','billing_address_line_2','billing_city','billing_state','billing_zip_code','billing_country',
    'payment_method','transaction_id','broker','carrier','bol_number','pick_up_zip_code','delevery_zip_code','total_weight','shipment','shipping_cost','shipping_paid_cost','shipping_paid_via','tracking_number',
    'invoice_number','vendor','vendor_pick_up_reference','vendor_invoice_amount','vendor_sales_tax','vendor_sales_tax_amount','vendor_invoice_paid','vendor_paid_via',
    'created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag','refund_amount','claim_refund',
    'claim_against','vendor_claim','vendor_claim','shipping_claim','shipping_claim_amount','claim_status','discount','flag','extranote'];
}