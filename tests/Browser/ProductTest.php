<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductTest extends DuskTestCase
{

    private $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::whereHas('roles', fn ($query) => $query->where('name', 'admin'))->first();
    }

    /**
     * A Dusk test example.
     */

    public function testImageAttachToFIleUploader()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                ->visit('/admin/product/create')
                ->assertSee('Create Product')
                ->attach('input[type="file"]', public_path('source/dummy-product-dusk-test.webp')); // Sesuaikan selector dan path berkas

        });
    }


    public function testCreateProductSuccess(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                ->visit('/admin/product/create')
                ->assertSee('Create Product')
                ->type('title', 'dusk test product 1')
                ->attach('input[type="file"]', public_path('source/dummy-product-dusk-test.webp')) // Sesuaikan selector dan path berkas
                ->typeSlowly('price', 17000, 300)
                ->type('stock', 10)
                ->type('weight', 200)
                ->keys('.note-editable', 'Product gacor dari dusk nomor 1')
                ->press('Tambah');
        });
    }
}
