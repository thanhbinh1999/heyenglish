<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SubscribeRabbit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:rabbit';

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
        $exchangeName  = 'notification';

        $connection = new AMQPStreamConnection(
            '172.18.0.5',
            5672,
            'guest',
            'guest'
        );

        $roles = [
            'production', 'dev'
        ];


        $channel = $connection->channel();

        $channel->exchange_declare($exchangeName, 'direct', false, true, false);

        //list($queue_name) =  $channel->queue_declare('', false, true, false, false);

        foreach ($roles as $role) {

            $routingKey = 'routing_' . $role;
            $queue_name  = "queue_" . $role;

            $channel->queue_bind($queue_name, $exchangeName, $routingKey);
        }


        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo $msg->body . "\n";
        };

        foreach ($roles as $role) {
            $queue_name  = "queue_" . $role;
            $channel->basic_consume('queue_' . $role, '', false, true, false, false, $callback);
        }


        while ($channel->is_open()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
