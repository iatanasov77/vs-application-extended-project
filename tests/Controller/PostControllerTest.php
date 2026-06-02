<?php namespace App\Tests\Controller;

use App\Tests\AdminPanelTestCase;

class PostControllerTest extends AdminPanelTestCase
{
    public function testSomething(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();
        
        // Request a specific page
        //$crawler = $client->request( 'GET', '/' );
        $crawler = $client->request( 'GET', \sprintf( '%s/', $this->getUrl() ) );
        
        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains( 'h1', 'Hello World' );
    }
}
