<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CodeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = array([1, '011', now(), now()],[2, '016', now(), now()],[3, '017', now(), now()],[4, '018', now(), now()]);

        foreach ($sql as $code) {
            DB::table('codes')->insert(array(
                'code' => $code[1], 
                'created_at' => $code[2], 
                'updated_at' => $code[3], 
            ));
        }
    }

}
