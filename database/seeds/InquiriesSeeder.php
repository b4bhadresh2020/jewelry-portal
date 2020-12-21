<?php

use Illuminate\Database\Seeder;
use App\Inquiry;

class InquiriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Inquiry::class)->times(150)->create();
    }
}
