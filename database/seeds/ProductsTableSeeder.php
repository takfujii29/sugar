<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { DB::table('products')->insert([
       [ 'name' => '炭酸飲料(500ml)',
        'sugar' => '11',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ],
        [ 'name' => 'プリン',
        'sugar' => '16.2',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ],
        [ 'name' => 'カステラ(1切れ)',
        'sugar' => '31.3',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        ],
    ]);
    }
}
