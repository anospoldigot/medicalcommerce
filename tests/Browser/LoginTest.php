<?php

namespace Tests\Browser;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class LoginTest extends DuskTestCase
{
    // use DatabaseMigrations;
    /**
     * A Dusk test example.
     */

    /**
     * Create the RemoteWebDriver instance.
     */
    // protected function driver(): RemoteWebDriver
    // {
    //     return RemoteWebDriver::create(
    //         'http://localhost:9515',
    //         DesiredCapabilities::chrome()
    //     );
    // }
    public function testExample(): void
    {

        $this->browse(function (Browser $browser) {

            $browser->visit('/admin/login')
                ->type('email', 'developer@example.com')
                ->type('password', 'password')
                ->press('Sign in')
                ->assertPathIs('/admin/dashboard');

            $browser->screenshot('failure-' .  time());
        });
    }
}
