<?php

namespace App\Console\Commands\Products;

use App\Models\Product;
use Illuminate\Console\Command;

class SetAllDeliverable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:all_deliverable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set all products to be deliverable';

    protected $products;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->products = Product::all();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->products as $product) {
            $product->deliverable = true;
            $product->save();

        }
    }
}
