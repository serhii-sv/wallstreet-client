<?php

namespace App\Console\Commands;

use App\Http\Controllers\WebSocketController;
use Illuminate\Console\Command;
use Ratchet\App;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\Socket\SecureServer;
use React\Socket\Server;

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
        //$webSock = new \React\Socket\Server($loop);
        $webSock = new \React\Socket\Server('0.0.0.0:6001', $loop);
        //$webSock->listen(6001, '0.0.0.0');
        $server = new \Ratchet\Server\IoServer(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            $webSock,
        $loop
        //6001
        );
        $this->info('Сервер запущен');
        $server->run();
    }
}
