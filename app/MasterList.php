<?php
namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterList extends Authenticatable
{
    use Notifiable;
    protected $table = 'master_list';
    protected $fillable = ['type','value','created_by','created_at','updated_by','updated_at','deleted_by','deleted_at','delete_flag'];
}