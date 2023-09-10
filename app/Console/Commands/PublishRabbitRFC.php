<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class PublishRabbitRFC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:rfc ${value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish RFC';

    private $connection  = '';

    private $channel = '';

    private $callbackQueue = '';

    private $response = '';

    private $corrId = '';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->connection = AMQPStreamConnection::create_connection([
            ['host' => '172.18.0.6', 'port' => 5672, 'user' => 'guest', 'password' => 'guest', 'vhost' => '/'],
            ['host' => '172.18.0.2', 'port' => 5672, 'user' => 'guest', 'password' => 'guest', 'vhost' => '/'],
        ]);

        $this->channel = $this->connection->channel();

        // list($this->callbackQueue) = $this->channel->queue_declare('', false, false, true, true );

        // $this->channel->basic_consume($this->callbackQueue, '', false, true, false, false, [$this, 'onResponse']);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->callTo($this->argument('value'));
    }

    public function onResponse($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {
            $this->response = $rep->body;
        }
    }

    public function callTo($request)
    {
        $this->corrId = uniqid();

        $this->channel->set_ack_handler(function (AMQPMessage $message) {
            echo "set_ack : " . $message->body . "\n";
        });

        $this->channel->set_nack_handler(function (AMQPMessage $message) {
            echo  "set_nack :" . $message->body . "\n";
        });

        $this->channel->confirm_select();

        $this->channel->exchange_declare('topcv', 'direct', false, true, false);

        $this->channel->queue_declare('render_cv', false, true, false, false, false, new AMQPTable(['x-queue-type' => 'quorum']));

        $this->channel->queue_bind('render_cv', 'topcv', 'cv_id', false);

        $this->channel->wait_for_pending_acks();

        $msg = new AMQPMessage(
            $request,
            [
                'expiration' => 900000,
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
            ]
        );

        $this->channel->basic_publish($msg, 'topcv', 'cv_id');

        $this->channel->wait_for_pending_acks();
    }
}
