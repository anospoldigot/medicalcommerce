<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductTest extends BaseTest
{

    public function test_guest_access_product_page_frontend()
    {
        $response = $this->get('/products');  

        $response->assertStatus(200);
    }

    public function test_admin_can_see_product()
    {
        $response = $this->actingAs($this->admin)-> get('/admin/product');  

        $response->assertOk();

        $response->assertSee('Create');
        $response->assert($this->showButton, false);
        $response->assertSee($this->editButton, false);
        $response->assertSee($this->deleteButton, false);

    }
}
