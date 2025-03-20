<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_to_list_all_categories_api()
    {

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
    }
}
