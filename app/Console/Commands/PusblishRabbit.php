<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class PusblishRabbit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:rabbit {sendTo} {msg}';

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

        $sendTo = $this->argument('sendTo');

        $routingKey = "routing_" . $sendTo;

        $queueName  = "queue_" . $sendTo;

        $connection = new AMQPStreamConnection(
            '172.18.0.5',
            5672,
            'guest',
            'guest'
        );

        $channel = $connection->channel();

        $msg = new AMQPMessage($this->argument('msg'), [
            'expiration' => 90000,
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
        ]);

        $channel->queue_declare($queueName, false, true, false, false);

        $channel->exchange_declare($exchangeName, 'direct', false, true, false);

        $channel->basic_publish($msg, $exchangeName, $routingKey, false);

        echo " [x] Sent topic to [$sendTo]\n";

        $channel->close();

        $connection->close();
    }
}
