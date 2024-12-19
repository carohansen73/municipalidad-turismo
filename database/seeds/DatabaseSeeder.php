<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PostCategoriesTableSeeder::class);
        $this->call(PostTagsTableSeeder::class);
        $this->call(SocialNetworksTableSeeder::class);
        // $this->call(PostsTableSeeder::class);
        // $this->call(BannersTableSeeder::class);
        // $this->call(EventsTableSeeder::class);
        // $this->call(TeamsTableSeeder::class);
        // $this->call(PostGaleryImagesTableSeeder::class);
        // $this->call(SiteSocialNetworksTableSeeder::class);
        $this->call(SiteConfigurationsTableSeeder::class);
        // $this->call(PlacesTableSeeder::class);

    }
}
