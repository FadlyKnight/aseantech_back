<?php

use App\ProductDetail;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ProductDetail::factory()->count(15)->create();
        factory(App\ProductDetail::class, 10)->create();
    }
}
