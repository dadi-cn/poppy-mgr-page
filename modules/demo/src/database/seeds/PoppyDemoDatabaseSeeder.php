<?php

namespace Demo\Database\Seeds;

use Demo\Models\PoppyDemo;
use Illuminate\Database\Seeder;

class PoppyDemoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PoppyDemo::class, 500)->create();
    }
}
