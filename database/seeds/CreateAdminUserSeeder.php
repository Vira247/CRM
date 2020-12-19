<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
	public function run()
	{
		$user = User::create([
			'name' => 'Shraddha chauhan',
			'email' => 'shraddha.chauhan@virtualheight.com',
			'password' => bcrypt('shraddha')
		]);
		$role = Role::create(['name' => 'Super Admin']);
		$permissions = Permission::pluck('id','id')->all();
		$role->syncPermissions($permissions);
		$user->assignRole([$role->id]);
	}
}