<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SubsribeRabbitRFC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:rfc';

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

        $channel->exchange_declare('topcv', 'direct', false, true, false, false);

        $callback = function ($message) use ($channel) {

            if ($message->body  < 10) {

                $channel->exchange_declare('failed_jobs', 'fanout', false, true, false);

                $channel->queue_declare('failed_jobs', false, true, false, false, false);

                $msg = new AMQPMessage(
                    $message->body,
                    [
                        'expiration' => 1,
                        'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
                    ]
                );

                $channel->basic_publish($msg, 'failed_jobs', 'failed_id');

                echo $message->body . " ------failed \n";

                $message->ack();
            } else {
                echo $message->body . "\n";
                $message->ack();
            }
        };

        $channel->basic_consume('render_cv', '', false, false, false,  false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait(null, true);
            usleep(1000);
        }

        $channel->close();
        $connection->close();
    }
}
