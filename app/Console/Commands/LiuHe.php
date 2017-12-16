<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\liuhe\LiuHeService;

class LiuHe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ag:game_record';

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
    public function handle(LiuHeService $service)
    {
        $service->getResult();
    }
}
