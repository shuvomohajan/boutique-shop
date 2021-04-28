<?php

use App\Model\CompanySetting;
use App\Model\EcommerceSetting;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      CompanySetting::create([
        'name' => 'Ebook'
      ]);
      EcommerceSetting::create([
        'currency' => 'BDT'
      ]);
    }
}
