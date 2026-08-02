<?php namespace App\Tests\Controller;

use App\Tests\AdminPanelTestCase;
use Vankosoft\UsersBundle\Repository\UsersRepository;

class ProfileControllerTest extends AdminPanelTestCase
{
    public function testVisitingWhileLoggedIn(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get( UsersRepository::class );
        
        // retrieve the test user
        $testUser = $userRepository->findOneByEmail( 'admin@holeshunter.com' );
        
        // simulate $testUser being logged in
        $client->loginUser( $testUser );
        
        // test e.g. the profile page
        $client->request( 'GET', \sprintf( '%s/profile', $this->getUrl() ) );
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains( 'h1', 'Hello Admin!' );
    }
}
