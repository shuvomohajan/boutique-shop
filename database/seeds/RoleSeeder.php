<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $role = Role::create([
      'name' => 'supper admin'
    ]);
    $permission = Permission::find(1);
    $role->syncPermissions($permission);
    $admin = User::find(1);
    $admin->syncRoles($role);
  }
}
