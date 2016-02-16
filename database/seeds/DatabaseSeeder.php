<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();
        $this->call(UserTableSeeder::class);
        //$this->call('PostTableSeeder');
        $this->call('ArchivesTableSeeder');
    }
}

class PostTableSeeder extends Seeder
{
    public function run()
    {
        App\Post::truncate();
        factory(App\Post::class, 20)->create();
    }
}
class ArchivesTableSeeder extends Seeder
{
    public function run()
    {
        App\Archive::truncate();
        factory(App\Archive::class,1)->create();
    }
}
class UserTableSeeder extends Seeder
{
    public function run()
    {
        App\User::truncate();
        factory(App\User::class,1)->create();
    }
}
