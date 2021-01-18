<?php namespace Poppy\Area\Database\Seeds;

use Illuminate\Database\Seeder;
use Poppy\Area\Models\AreaContent;

class AreaContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [];
        $towns = [];
        require_once 'area.php';

        $insertAreas = [];
        foreach ($areas as $area) {
            $insertAreas[] = [
                'id'        => $area[0],
                'title'     => $area[1],
                'parent_id' => $area[2],
            ];
        }
        AreaContent::insert($insertAreas);

        $insertTowns = [];
        foreach ($towns as $town) {
            $insertTowns[] = [
                'title'     => $town[0],
                'parent_id' => $town[1],
            ];
        }
        AreaContent::insert($insertTowns);


    }
}
