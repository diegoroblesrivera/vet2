<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
     * @return int
     */
    public function handle()
    {
        $models = glob(app_path('Models/*.php'));
    
        foreach ($models as $model) {
            $this->line(basename($model));
        }
    }
    
}
