<?php

use Illuminate\Database\Seeder;

class SocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_networks')->insert([
            'name'          => 'Correo',
            'icon'          => 'fa fa-envelope',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        DB::table('social_networks')->insert([
            'name'          => 'Facebook',
            'icon'          => 'fa fa-facebook-f',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        DB::table('social_networks')->insert([
            'name'          => 'Instagram',
            'icon'          => 'fa fa-instagram',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        DB::table('social_networks')->insert([
            'name'          => 'Linkedin',
            'icon'          => 'fa fa-linkedin',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        DB::table('social_networks')->insert([
            'name'          => 'Sitio web',
            'icon'          => 'fa fa-at',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        DB::table('social_networks')->insert([
            'name'          => 'Twitter',
            'icon'          => 'fa fa-twitter',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        DB::table('social_networks')->insert([
            'name'          => 'You Tube',
            'icon'          => 'fa fa-youtube-play',
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
