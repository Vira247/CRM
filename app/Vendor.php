<?php

namespace App;



use Illuminate\Support\Facades\DB;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;



class Vendor extends Authenticatable

{

    use Notifiable;

    protected $table = 'vendor';

    protected $fillable = ['name','created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag','contact_person_name','contact_email_address','head_office_address','warehouse_address'];

}