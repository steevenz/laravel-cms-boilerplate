<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Posts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Posts::factory(10)->create();
    }
}
