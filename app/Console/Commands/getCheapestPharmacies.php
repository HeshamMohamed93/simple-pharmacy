<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class getCheapestPharmacies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest {product-id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'returns cheapest 5 pharmacies for a product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $productId = $this->argument('product-id');
        $pharmacies = DB::table('pharmacies')
            ->join('pharmacy_product', 'pharmacies.id', '=', 'pharmacy_product.pharmacy_id')
            ->select('pharmacies.id', 'pharmacies.name', 'pharmacy_product.product_price')
            ->where('pharmacy_product.product_id', '=', $productId)
            ->orderBy('product_price', 'asc')
            ->limit(2)
            ->get()->toJson();
        $this->line($pharmacies);
    }
}
