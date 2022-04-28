<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PlanSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = array([1, 'FaleMais 30','30', now(), now()],[2, 'FaleMais 60','60', now(), now()],[3, 'FaleMais 120','120', now(), now()]);

        foreach ($sql as $plan) {
            DB::table('plans')->insert(array(
                'name' => $plan[1], 
                'time' => $plan[2], 
                'created_at' => $plan[3], 
                'updated_at' => $plan[4], 
            ));
        }
    }

}
