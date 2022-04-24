<?php

namespace Database\Seeders;

use App\Models\product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        product::factory(20)->create();
        $products = [

            // [
            //     'name' => 'Gucci Bag',
            //     'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, corrupti.',
            //     'slug' =>  'Gucci-bag' ,
            //     'price' => 12.56,
            //     'sale_price' => 7.56,
            //     'product_img' => 'https://via.placeholder.com/150',
            //     'category_id' => 1,
            // ],
            // [
            //     'name' => 'Gucci Shoe',
            //     'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde, corrupti.',
            //     'slug' =>  'Gucci-shoe' ,
            //     'price' => 20.56,
            //     'sale_price' => 15.56,
            //     'product_img' => 'https://via.placeholder.com/150',
            //     'category_id' => 1,
            // ]
            ];

            // foreach($products as $key => $value){
            //     product::create($value);
            // }
    }
}
