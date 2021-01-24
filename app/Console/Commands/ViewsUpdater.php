<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class ViewsUpdater extends Command
{
    use UpdaterTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daemon:views {--connection=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Views Updater';

    public string $key = 'views';

    public static string $model = Post::class;

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
        $this->update($this->option('connection'));
        return 0;
    }
}
