<?php namespace App\Component\Websocket;

/**
 * Ported From: https://learn.microsoft.com/en-us/dotnet/api/system.net.websockets.websocketstate?view=net-8.0
 */
enum WebSocketState
{
    case None;          // Reserved for future use.
    case Connecting;    // The connection is negotiating the handshake with the remote endpoint.
    case Open;          // The initial state after the HTTP handshake has been completed.
    case CloseSent;     // A close message was sent to the remote endpoint.
    case CloseReceived; // A close message was received from the remote endpoint.
    case Closed;        // Indicates the WebSocket close handshake completed gracefully.
    case Aborted;       // Indicates that the WebSocket has been aborted.
}
