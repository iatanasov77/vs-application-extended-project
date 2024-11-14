<?php namespace App\Component\Websocket\Client;

interface WebsocketClientInterface
{
    public function send( object $msg ): void;
    public function receive(): string;
    public function close(): void;
    public function subscribe( string $realm, string $topic, \Closure $callback ): void;
}
