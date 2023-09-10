<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class SubscribeFailedJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:failed-jobs';

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
        $connection = new AMQPStreamConnection(
            '172.18.0.6',
            5672,
            'guest',
            'guest'
        );

        $channel = $connection->channel();

        $channel->exchange_declare('failed_jobs', 'fanout', false, true, false, false);

        $channel->queue_bind('failed_jobs', 'failed_jobs');

        $callback = function ($message) {
            echo $message->body . "\n";
            // $message->ack();
        };

        $channel->basic_consume('failed_jobs', '', false, false, false,  false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
