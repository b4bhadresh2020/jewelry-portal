<?php

use App\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::insert([
            [
                'name' => 'Men',
            ],
            [
                'name' => 'Woman',
            ],
            [
                'name' => 'Feature',
            ],
            [
                'name' => 'New',
            ],
            [
                'name' => 'Best Sell',
            ],
            [
                'name' => 'Special',
            ]
        ]);
    }
}
