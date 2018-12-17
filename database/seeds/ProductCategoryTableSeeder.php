<?php

use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_categories')->delete();

        \DB::table('product_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Gift',
                'icon' => 'gift',
                'description' => 'Gift',
                'color' => '#f4ee42',
                'acronym' => 'gift',
                'cover_position' => 'center',
                'created_at' => '2018-12-17 16:15:32',
                'updated_at' => '2018-12-17 16:15:32',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Software',
                'icon' => 'desktop',
                'description' => 'Software',
                'color' => '#41f4c4',
                'acronym' => 'sft',
                'cover_position' => 'left',
                'created_at' => '2018-12-17 17:30:41',
                'updated_at' => '2018-12-17 17:30:41',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Hardware',
                'icon' => 'hdd',
                'description' => 'Hardware',
                'color' => '#f47c41',
                'acronym' => 'hdd',
                'cover_position' => 'right',
                'created_at' => '2018-12-17 18:32:21',
                'updated_at' => '2018-12-17 18:32:21',
            ),
        ));

    }
}