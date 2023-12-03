<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\BaseTest;
use Tests\TestCase;

class AuthTest extends BaseTest
{
    

    public function test_user_customer_is_failed_login_to_dashboard()
    {

        $response = $this->actingAs($this->customer)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_user_admin_is_success_to_login_dashboard()
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }


    public function test_admin_success_login_from_admin_page()
    {

        $response = $this->post('/admin/login', [
            'email'             => $this->admin->email,
            'password'          => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
    }

    public function test_admin_failed_login_from_admin_page_when_user_not_found()
    {

        $fromUrl = '/admin/login';
        $response = $this->withHeaders(['Referer' => $fromUrl])
            ->post('/admin/login', [
                'email'             => 'ngasal',
                'password'          => 'ngasal'
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect($fromUrl);
    }

    public function test_admin_failed_login_from_admin_page_when_wrong_password()
    {

        $fromUrl = '/admin/login';
        $wrongPassword = 'aosbeqwfliu';
        $response = $this->withHeaders(['Referer' => $fromUrl])
            ->post('/admin/login', [
                'email'             => $this->admin->email,
                'password'          => $wrongPassword
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect($fromUrl);
    }


    public function test_customer_failed_login_from_admin_login_page()
    {

        $fromUrl = '/admin/login';
        $response = $this->withHeaders(['Referer' => $fromUrl])
            ->post('/admin/login', [
                'email'             => $this->customer->email,
                'password'          => 'password'
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
        $response->assertRedirect($fromUrl);
    }
}
