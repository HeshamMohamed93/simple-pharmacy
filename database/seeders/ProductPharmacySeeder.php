<?php

namespace Database\Seeders;

use App\Models\ProductPharmacy;
use Illuminate\Database\Seeder;

class ProductPharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductPharmacy::factory()->times(200000)->create();
    }
}
