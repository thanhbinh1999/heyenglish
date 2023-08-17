<?php

namespace App\Http\Controllers;

use App\Events\Contact;
use Illuminate\Http\Request;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ContactController extends Controller
{
    public function index()
    {
        $banners = \DB::table('banners')->get();
        event(new Contact('ok'));

        return view('IndexContact', [
            'banners' => $banners
        ]);
    }

    public function call(callable $callback)
    {
        return $callback();
    }

    public function producer()
    {
        $exchangeName  = 'notification';

        $topic = $_GET['topic'];

        $connection = new AMQPStreamConnection(
            '172.20.0.4',
             5672,
            'guest',
            'guest'
        );

        $channel = $connection->channel();
        ///  $channel->queue_declare($exchangeName, false, true, false, false);

        $msg = new AMQPMessage("emai gui $topic " . time(), [
            'expiration' => 9000000,
            'delivery_mode' => 2
        ]);

        $channel->exchange_declare($exchangeName, 'topic', false, false, false);

        $channel->basic_publish($msg, $exchangeName, $topic);

        echo " [x] Sent topic to [$topic]\n";

        $channel->close();

        $connection->close();
    }

    public function form()
    {
        return view('ContactForm');
    }
}
