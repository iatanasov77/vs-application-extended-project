window.MessagePublished = false;

const url           = window.clientSettings.socketChatUrl;
const currentUser   = window.currentUser;
var socket;

function sendMessage( message )
{
    if ( socket && socket.readyState === socket.OPEN) {
        socket.send( message );
    }
}

function connectToTopic()
{
    socket = new WebSocket( url );
    socket.onmessage = onMessage;
    socket.onerror = onError;
    socket.onopen = onOpen;
    socket.onclose = onClose;
}

function onOpen( event )
{
    console.log( 'Open', { event } );
}

function onError( event )
{
    console.error( 'Error', { event } );
}

function onClose( event )
{
    console.log( 'Close', event.reason );
}

// Messages received from server.
function onMessage( message )
{
    console.log( 'Chat Message', message.data );
    const dto = JSON.parse( message.data );
    
    if ( dto.type === 'ChatMessageDto' ) {
        $( '#client1_form_message' ).val( '' );
        $( '#client2_form_message' ).val( '' );
        
        let message = dto.fromUser + ': ' + dto.message;
        //alert( message );
        
        let output;
        if ( currentUser == dto.fromUser ) {
            output = '<span class="float-end">' + message + '</span><br /><br />';
        } else {
            output = '<span class="float-start">' + message + '</span><br /><br />';
        }
        
        //alert( output );
        $( '#ChatConsole' ).append( output ).animate( {scrollTop: $( '#ChatConsole' ).prop( "scrollHeight" ) }, 0 );
    }
}

// sending to server
function sendMessage( message )
{
    const utcNow = new Date().toISOString();
    
    // ChatMessageDto
    const dto = {
        fromUser: currentUser,
        type: 'ChatMessageDto',
        message: message,
        utcDateTime: utcNow
    };
    
    console.log( 'Socket State', socket.readyState );
    if ( socket && socket.readyState === socket.OPEN ) {
        socket.send( JSON.stringify( dto ) );
    }
}

$( function()
{
    connectToTopic();
        
    $( '#FormClient1' ).on( 'submit', function( e ) {
        e.preventDefault();
        
        var form    = $( this );
        if ( ! window.MessagePublished ) {
            sendMessage( form.find( 'textarea[name="message"]' ).val() );
        }
    });
    
    $( '#FormClient2' ).on( 'submit', function( e ) {
        e.preventDefault();
        
        var form    = $( this );
        if ( ! window.MessagePublished ) {
            sendMessage( form.find( 'textarea[name="message"]' ).val() );
        }
    });
});
