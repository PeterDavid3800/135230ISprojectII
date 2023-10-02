<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
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
         \App\Models\User::factory(5)->create();

         Listing:: factory(5)->create();
         //Listing::create([
           //'title' => 'Laravel Senior Developer',
           //'tags' => 'Laravel, Javascript',
           //'company' => 'Acme Corp',
           //'location' => 'Boston, MA',
           //'email' => 'email@email.com',
           //'website' => 'https://www.acme.com',
           //'description' => 'Blah blah blah blah blah
           //blah'

         //]);
         //Listing::create([
           //'title' => 'Full Stack Engineer',
           //'tags' => 'Laravel,backend, API',
           //'company' => 'Stark Industries',
           //'location' => 'NewYork, NY',
           //'email' => 'email2@email.com',
           //'website' => 'https://www.starkindustries.com',
           //'description' => 'Blah blah blah blah blah
           //blah'
         //]);

        // \App\Models\User::factory()->create([
        //    'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}