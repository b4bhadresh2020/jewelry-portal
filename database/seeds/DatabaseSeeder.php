<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CollectionSeeder::class);
        $this->call(ProductStatusSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserMenuSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(InquiriesSeeder::class);
        $this->call(SellerSeeder::class);
        // exec('rm public/storage');
        // Artisan::call('storage:link');
    }
}
