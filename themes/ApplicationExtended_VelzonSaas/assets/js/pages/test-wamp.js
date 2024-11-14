window.MessagePublished = false;

const autobahn      = require( 'autobahn-browser' );
const url           = window.clientSettings.socketPublisherUrl;
const currentUser   = window.currentUser;
var socket;

var connection = new autobahn.Connection({
    url: url,
    realm: 'realm1'
});

function sendMessage( message )
{
    if ( socket && socket.readyState === socket.OPEN) {
        socket.send( message );
    }
}


function publishMessage( form, dto )
{
    window.MessagePublished = true;
    
    $.ajax({
        type: "POST",
        url: form.attr( 'action' ),
        data: JSON.stringify( dto ),
        dataType: 'json',
        success: function( response )
        {
            window.MessagePublished = false;
        },
        error: function()
        {
            window.MessagePublished = false;
            alert( "SYSTEM ERROR!!!" );
        }
    });    
}

function connectToTopic()
{
    connection.onopen = function ( session ) {
    
        // 1) subscribe to a topic
        function onevent( args ) {
            console.log( "Event:", args );
            
            if ( args[0].data ) {
                $( '#client1_form_message' ).val( '' );
                $( '#client2_form_message' ).val( '' );
                
                let data    = args[0].data;
                let message = data.fromUser + ': ' + data.message;
                let output;
                
                if ( currentUser == data.fromUser ) {
                    output = '<span class="float-end">' + message + '</span><br /><br />';
                } else {
                    output = '<span class="float-start">' + message + '</span><br /><br />';
                }
                
                $( '#ChatConsole' ).append( output ).animate( {scrollTop: $( '#ChatConsole' ).prop( "scrollHeight" ) }, 0 );
            }
        }
        session.subscribe( 'chat', onevent );
        
        // 2) publish an event
        session.publish( 'chat', ['Hello, world!'] );
    };
    
    connection.open();
}

$( function()
{
    if ( connection.isOpen == false ) {
        connectToTopic();
    }
        
    $( '#FormClient1' ).on( 'submit', function( e ) {
        e.preventDefault();
        
        var form    = $( this );
        let dto = {
            user: form.find( 'input[name="user"]' ).val(),
            message: form.find( 'textarea[name="message"]' ).val()
        }
        
        if ( ! window.MessagePublished ) {
            publishMessage( form, dto );
        }
    });
    
    $( '#FormClient2' ).on( 'submit', function( e ) {
        e.preventDefault();
        
        var form    = $( this );
        let dto = {
            user: form.find( 'input[name="user"]' ).val(),
            message: form.find( 'textarea[name="message"]' ).val()
        }
        
        if ( ! window.MessagePublished ) {
            publishMessage( form, dto );
        }
    });
});
