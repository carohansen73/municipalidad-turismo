<?php

use Illuminate\Database\Seeder;

class SiteConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_configurations')->insert([
            'title_place'       =>  'Conoce nuestros lugares destacados',
            'subtitle_place'    =>  'Tres arroyos y la zona.',
            'title_news'        =>  'Últimas noticias',
            'subtitle_news'     =>  'Entérate de todas nuestras últimas noticias.',
            'title_events'      =>  'Últimos eventos',
            'subtitle_events'   =>  'Entérate de todos nuestros últimos eventos.',
            'title_team'        =>  'Nuestro equipo.',
            'subtitle_team'     =>  'Esté es nuestro equipo que hace todo posible.',
            'description_team'  =>  '“El compromiso individual con un esfuerzo colectivo es lo que hace que un equipo, una empresa o una sociedad funcionen”. Vince Lombardi',
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);
    }
}
