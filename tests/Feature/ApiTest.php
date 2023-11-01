<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_user(): void
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/getUser');

        $response->assertStatus(200);
        $response->assertJsonCount(7,);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'password',
        ]);
    }

    public function test_get_category(): void
    {
        $response = $this->get('/api/category-show');
        $response->assertStatus(200);
        $response->assertJsonCount(9);
        $response->assertJsonStructure([['id', 'title', 'slug']]);
    }
    public function test_get_brands(): void
    {
        $response = $this->get('/api/brand-show');
        $response->assertStatus(200);
        $response->assertJsonCount(6);
        $response->assertJsonStructure([['id', 'thumbnail', 'title', 'slug', 'on_homepage']]);
    }
}
