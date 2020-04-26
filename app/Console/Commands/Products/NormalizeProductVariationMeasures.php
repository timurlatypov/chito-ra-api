<?php

namespace App\Console\Commands\Products;

use App\Models\ProductVariation;
use Illuminate\Console\Command;

class NormalizeProductVariationMeasures extends Command
{
    protected $variations;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'normalize:measures';

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
        $this->variations = ProductVariation::all();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->variations as $variation) {
            if (preg_match('/[мл]$/', $variation->name)) {
                $variation->name       = trim(str_replace('мл', '', $variation->name));
                $variation->measure_id = 2;
                $variation->save();
            }
        }
    }
}
