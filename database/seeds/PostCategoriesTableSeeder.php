<?php

use Illuminate\Database\Seeder;

class PostCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_categories')->insert([
            'name'          =>  'Politica',
            'slug'          =>  'politica',
            'publish'       =>  1,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);

        DB::table('post_categories')->insert([
            'name'          =>  'Deportes',
            'slug'          =>  'deportes',
            'publish'       =>  1,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);

        DB::table('post_categories')->insert([
            'name'          =>  'Tecnología',
            'slug'          =>  'tecnologia',
            'publish'       =>  1,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);
    }
}
