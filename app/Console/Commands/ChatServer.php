<?php

namespace App\Console\Commands;

use App\Http\Controllers\WebSocketController;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Loop;
use React\Socket\SocketServer;

class ChatServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:chat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Websockets for chat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {

        $loop = \React\EventLoop\Factory::create();
        $webSock = new \React\Socket\Server('0.0.0.0:6001', $loop);

        //   $loop = Loop::get();
        //   $webSock = new SocketServer('0.0.0.0:6001', [], $loop);
        //        $webSock->listen(6001, '0.0.0.0');
        //        $server = IoServer::factory(
        $server = new \Ratchet\Server\IoServer(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            $webSock,
            $loop
        );
        $this->info('Сервер запущен');
        $server->run();
    }
}
