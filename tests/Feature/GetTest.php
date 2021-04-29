<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_post()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->post('/api/products/add', ['name' => 'Pikachu Test (By Test)', 'provider' => 'Pokémon Center Test', 'price' => 22.99, 'quantity' => 10, 'description' => "This is a small test :3 I hope it works cause I don't want to debug it ;-; But, at least it's way better than vuejs ^-^ !", 'image' => 'https://i.ytimg.com/vi/BAUS7giaWtU/maxresdefault.jpg']);

        $response->assertStatus(200);
    }
    public function test_get()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get('/api/products');

        $response->assertStatus(200);
    }
    public function test_delete()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->delete('/api/products/11');

        $response->assertStatus(200);
    }
}
