<?php

use App\Model\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'bangla',
        ]);
        Language::create([
            'name' => 'English',
        ]);
        Language::create([
            'name' => 'Hindi',
        ]);
    }
}
