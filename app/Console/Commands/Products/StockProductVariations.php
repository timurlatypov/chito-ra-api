<?php

namespace App\Console\Commands\Products;

use App\Models\ProductVariation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StockProductVariations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:product_variations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        DB::table('stocks')->truncate();
        $variations = ProductVariation::all();

        foreach ($variations as $variation) {
            DB::table('stocks')->insert([
                'quantity'             => 10000000,
                'product_variation_id' => $variation->id,
                'created_at'           => now(),
                'updated_at'           => now(),
            ]);
        }
    }
}
