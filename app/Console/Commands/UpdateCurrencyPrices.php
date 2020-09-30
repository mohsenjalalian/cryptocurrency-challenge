<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateCurrencyPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currency-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency prices';

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
        dd('command');
    }
}
