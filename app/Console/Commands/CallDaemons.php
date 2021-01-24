<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CallDaemons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daemon:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Daemons';

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
        system('php artisan daemon:views --connection=1   >/dev/null 2>&1 &');
        system('php artisan daemon:views --connection=2   >/dev/null 2>&1 &');
        system('php artisan daemon:likes --connection=1   >/dev/null 2>&1 &');
        system('php artisan daemon:likes --connection=2   >/dev/null 2>&1 &');
        return 0;
    }
}
