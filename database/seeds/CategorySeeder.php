<?php

use App\Model\Category;
use App\Model\Subcategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      [
        'category'    => 'Commerce',
        'subcategory' => [
          'Business Studies',
          'Entrepreneurship',
          'Marketing',
          'E-Commerce',
          'Management',
        ]
      ], [
        'category'    => 'Humanities',
        'subcategory' => [
          'Archeology',
          'History',
          'Theater, Music and Dance',
          'Folklore',
          'Literature',
        ]
      ], [
        'category'    => 'Sciences',
        'subcategory' => [
          'Astronomy',
          'Chemistry',
          'Physics',
          'Biology',
          'Computer Science',
        ]
      ], [
        'category'    => 'Social Studies',
        'subcategory' => [
          'Anthropology',
          'Geography and Environment',
          'Sociology',
          'Economics',
          'Political Science',
        ]
      ], [
        'category'    => 'Others',
        'subcategory' => [
          'Agriculture',
          'Current Affairs',
          'My Country',
          'Biography',
          'Health and Fitness',
        ]
      ]
    ];

    foreach ($data as $item) {
      $category = Category::create([
        'name'   => $item['category'],
        'status' => true,
      ]);

      foreach ($item['subcategory'] as $subcategory) {
        Subcategory::create([
          'category_id' => $category->id,
          'name'        => $subcategory,
          'status'      => true,
        ]);
      }
    }
  }
}
