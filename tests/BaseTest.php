<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $customer;
    protected $admin;
    protected $roles = ['admin', 'customer'];
    protected $showButton = "<i data-feather='eye'></i>";
    protected $editButton = "<i data-feather='pen'></i>";
    protected $deleteButton = "<i data-feather='trash-2'></i>";

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->create_roles($this->roles);
        $this->customer = $this->create_user('customer');
        $this->admin    = $this->create_user('admin');
        
    }

    public function create_roles($roles)
    {
        foreach ($roles as $key => $role) {
            Role::create([
                'name'          => $role,
                'guar_name'     => 'web'
            ]);
        }
    }

    public function create_user($role)
    {
        $user = User::factory()->create();

        $user->assignRole($role);

        return $user;
    }   
}
