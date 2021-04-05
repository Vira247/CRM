<?php

namespace App;



use Illuminate\Support\Facades\DB;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;



class MasterType extends Authenticatable

{

    use Notifiable;

    protected $table = 'master_type';

    protected $fillable = ['type','created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag'];


	public static function getPluckData(){
		$getData = MasterType::where('delete_flag','N')->pluck('type')->all();
		return $getData;
	}
}