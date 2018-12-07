<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'access_backend',
                'created_at' => '2017-01-08 23:25:26',
                'updated_at' => '2017-01-08 23:25:26',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'edit_games',
                'created_at' => '2017-01-09 17:12:28',
                'updated_at' => '2017-01-09 17:12:28',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'edit_listings',
                'created_at' => '2017-01-09 17:12:35',
                'updated_at' => '2017-01-09 17:12:35',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'edit_platforms',
                'created_at' => '2017-01-09 17:12:43',
                'updated_at' => '2017-01-16 22:31:25',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'edit_users',
                'created_at' => '2017-01-09 17:12:59',
                'updated_at' => '2017-01-09 17:12:59',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'edit_ratings',
                'created_at' => '2017-01-16 22:33:47',
                'updated_at' => '2017-01-16 22:33:47',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'edit_settings',
                'created_at' => '2017-01-16 22:39:43',
                'updated_at' => '2017-01-16 22:39:43',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'edit_translations',
                'created_at' => '2017-01-16 22:39:52',
                'updated_at' => '2017-01-16 22:39:52',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'edit_offers',
                'created_at' => '2017-01-19 20:22:15',
                'updated_at' => '2017-01-19 20:22:15',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'edit_pages',
                'created_at' => '2017-01-21 23:13:30',
                'updated_at' => '2017-01-21 23:13:30',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'edit_comments',
                'created_at' => '2017-01-21 23:14:30',
                'updated_at' => '2017-01-21 23:14:30',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'edit_payments',
                'created_at' => '2017-01-21 23:15:30',
                'updated_at' => '2017-01-21 23:15:30',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'edit_articles',
                'created_at' => '2017-01-21 23:16:30',
                'updated_at' => '2017-01-21 23:16:30',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'edit_emotical',
                'created_at' => '2017-01-21 23:17:30',
                'updated_at' => '2017-01-21 23:17:30',
            ),
        ));


    }
}
