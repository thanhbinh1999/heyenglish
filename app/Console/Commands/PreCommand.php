<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Events\CommandStarting;

class PreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preCommand';

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
    public function handle(CommandStarting $event)
    {
        ///if (app()->environment(['production'])) {
        logger('Trying to fresh database in production');
        if ($event->command == 'migrate:refresh') {
            $this->output = $event->output;
            $this->info($event->command);
            die();
        }
        //  }
    }
}
