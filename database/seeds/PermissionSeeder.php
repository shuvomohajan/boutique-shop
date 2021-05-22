<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $permissions = [
        ['name' => 'admin'],

        ['name' => 'user.all'],
        ['name' => 'user.add'],
        ['name' => 'user.edit'],
        ['name' => 'user.view'],
        ['name' => 'user.delete'],

        ['name' => 'product.all'],
        ['name' => 'product.add'],
        ['name' => 'product.edit'],
        ['name' => 'product.view'],
        ['name' => 'product.delete'],

        ['name' => 'coupon.all'],
        ['name' => 'coupon.add'],
        ['name' => 'coupon.edit'],
        ['name' => 'coupon.view'],
        ['name' => 'coupon.delete'],

        ['name' => 'stock.all'],
        ['name' => 'stock.add'],
        ['name' => 'stock.edit'],
        ['name' => 'stock.view'],
        ['name' => 'stock.delete'],

        ['name' => 'settings.all'],
        ['name' => 'settings.add'],
        ['name' => 'settings.edit'],
        ['name' => 'settings.view'],
        ['name' => 'settings.delete'],

        ['name' => 'category.all'],
        ['name' => 'category.add'],
        ['name' => 'category.edit'],
        ['name' => 'category.view'],
        ['name' => 'category.delete'],

        ['name' => 'tag.all'],
        ['name' => 'tag.add'],
        ['name' => 'tag.edit'],
        ['name' => 'tag.view'],
        ['name' => 'tag.delete'],

        ['name' => 'order.all'],
        ['name' => 'order.add'],
        ['name' => 'order.edit'],
        ['name' => 'order.view'],
        ['name' => 'order.delete'],

        ['name' => 'customer_support.all'],
        ['name' => 'customer_support.view'],
        ['name' => 'customer_support.delete'],
      ];
      foreach ($permissions as $permission) {

        Permission::create([
          'name' => $permission["name"]
        ]);
      };
    }
}
