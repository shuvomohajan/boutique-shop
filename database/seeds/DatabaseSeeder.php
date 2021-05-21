<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
//        $this->call(TagSeeder::class);
//        $this->call(FormatSeeder::class);
//        $this->call(LanguageSeeder::class);
//        $this->call(CategorySeeder::class);
//        $this->call(SubjectSeeder::class);
//        $this->call(ProductSeeder::class);
        $this->call(CompanySettingSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
