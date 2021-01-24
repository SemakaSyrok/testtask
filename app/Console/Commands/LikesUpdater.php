<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class LikesUpdater extends Command
{
    use UpdaterTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daemon:likes {--connection=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Likes Updater';

    public string $key = 'likes';

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
