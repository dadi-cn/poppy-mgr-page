<?php

namespace Demo\Database\Seeds;

use Demo\Models\DemoDb;
use Illuminate\Database\Seeder;
use Poppy\Framework\Exceptions\FakerException;

class DemoDbDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FakerException
     */
    public function run()
    {
        $faker = py_faker();
        for ($start = 0; $start < 50; $start++) {
            $item = [
                'tiny_integer' => $faker->numberBetween(0, 100),
                'u_integer'    => $faker->numberBetween(100, 500),
                'var_char_20'  => $faker->words(8, true),
                'char_20'      => $faker->words(10, true),
                'text'         => $faker->sentence(30),
                'decimal'      => $faker->numberBetween(100, 6),
            ];
            DemoDb::create($item);
        }
    }
}
