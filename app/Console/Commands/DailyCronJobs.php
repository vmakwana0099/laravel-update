<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CronController;

class DailyCronJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailycronjob:pricingset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set product and domain pricing from WHMCS to system';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
		 $this->obj = new CronController();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
		$this->obj->index();
		
    }
}
