<?php namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

// tests needing the AdminPanelKernel to work, now must extend this
// AdminPanelTestCase class instead of the default WebTestCase class
class AdminPanelTestCase extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\AdminPanelKernel::class;
    }
    
    // this is needed because the KernelTestCase class keeps a reference to
    // the previously created kernel in its static $kernel property. Thus,
    // if your functional tests do not run in isolated processes, a later run
    // test for a different kernel will reuse the previously created instance,
    // which points to a different kernel
    protected function tearDown(): void
    {
        parent::tearDown();
        
        static::$class = null;
    }
    
    protected function getUrl(): string
    {
        return \sprintf( '%s://admin.%s', $_ENV['SECURE_SCHEME'], $_ENV['HOST'] );
    }
}