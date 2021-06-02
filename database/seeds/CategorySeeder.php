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
        'category'    => 'Pakhistani Dress',
        'subcategory' => [
          'Pakhistani Lawn',
          'Pakhistani Slik',
          'Pakhistani Cotton',
          'Pakhistani jamdani',
          'Pakhistani  kurti',
        ]
      ], [
        'category'    => 'Indian Dress',
        'subcategory' => [
          'Indian Lawn',
          'Indian Slik',
          'Jamdani, Cotton and Katan',
          'Kurti',
        ]
      ], [
        'category'    => 'Lakhno ',
        'subcategory' => [
          'Lakhno Gown',
          'Lakhno Cotton',
        ]
      ], [
        'category'    => 'Party Dress',
        'subcategory' => [
          'Party Sequence Dress',
          'Slik',
          'Cotton',
          'Benaroshi ',
        ]
      ], [
        'category'    => 'Boutiques Dress',
        'subcategory' => [
          'Boutique Cotton',
          'Boutique Jamdani',
          'Boutique Embroidery',
        ]
      ], [
        'category' => 'Sawrvaski Slik',
        'subcategory' => []
      ], [
        'category'    => 'Chiken Dress',
        'subcategory' => [
          'Chiken Cotton',
          'Chiken Slik',
        ]
      ], [
        'category'    => 'Embroidery Dress',
        'subcategory' => [
          'Embroidery Cotton',
          'Embroidery Slik',
        ]
      ], [
        'category' => 'Moslin Dress',
        'subcategory' => []
      ], [
        'category' => 'Kashmiri Dress',
        'subcategory' => []
      ], [
        'category' => 'New Churni Dress',
        'subcategory' => []
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
