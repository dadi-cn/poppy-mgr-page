<?php

namespace Poppy\Area\Database\Seeds;

use Illuminate\Database\Seeder;

class AreaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $this->call([
            AreaContentSeeder::class,
        ]);
    }
}
