<?php

use Illuminate\Database\Seeder;

class PostTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_tags')->insert([
            'name'          =>  'Fútbol',
            'slug'          =>  'futbol',
            'publish'       =>  1,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);

        DB::table('post_tags')->insert([
            'name'          =>  'Local',
            'slug'          =>  'local',
            'publish'       =>  1,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);

        DB::table('post_tags')->insert([
            'name'          =>  'Desarrollo',
            'slug'          =>  'desarrollo',
            'publish'       =>  1,
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);
    }
}
