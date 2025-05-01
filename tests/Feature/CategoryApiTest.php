<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;


class CategoryApiTest extends TestCase
{
    use RefreshDatabase;
    /**
    * Test Case ID: TC004
    * Description: Test getting all categories
    * Precondition: At least 5 categories exist in the database.
    * Test Steps:
    *   1. Send GET request to /api/categories
    * Test Data: None
    * Expected Result: HTTP 200 OK / JSON array with 5 category objects
    * Actual Result: HTTP 200 OK / JSON array with 5 category objects
    * Status: Passed
    * Remark: None
    */

    public function test_can_get_all_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(5,'data');
    }
    /**
    * Test Case ID: TC005
    * Description: Test getting a category by ID
    * Precondition: A category exists in the database.
    * Test Steps:
    *   1. Create a category
    *   2. Send GET request to /api/categories/{id}
    * Test Data: Category ID (auto-generated), Name: "Books"
    * Expected Result: HTTP 200 OK / JSON object containing the category details
    * Actual Result: HTTP 200 OK / JSON object containing the category details
    * Status: Passed
    * Remark: None
    */


    public function test_can_get_category_by_id()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $category->name]);
    }
    /**
    * Test Case ID: TC006
    * Description: Test that an admin can create a category
    * Precondition: A user exists with admin privileges.
    * Test Steps:
    *   1. Send POST request to /api/categories with category name
    * Test Data: Name: "Electronics"
    * Expected Result: HTTP 201 Created / Category stored in database
    * Actual Result: HTTP 201 Created / Category stored in database
    * Status: Passed
    * Remark: None
    */

    public function test_create_category()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'Electronics',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Electronics']);
    }
    /**
    * Test Case ID: TC007
    * Description: Test delete a category
    * Precondition: A category exists in the database and the user can delete
    * Test Steps:
    *   1. Send DELETE request to /api/categories/{id}
    * Test Data: Category ID (auto-generated)
    * Expected Result: HTTP 200 OK / Category deleted from database
    * Actual Result: HTTP 200 OK / Category deleted from database
    * Status: Passed
    * Remark: Category deletion is functioning correctly
    */
    public function test_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
    /**
    * Test Case ID: TC008
    * Description: Test category creation fails when the name field is empty
    * Precondition: The API requires a non-empty name field for category creation
    * Test Steps:
    *   1. Send POST request to /api/categories with an empty name
    * Test Data: name: ""
    * Expected Result: HTTP 422 Unprocessable Entity / Validation error on 'name'
    * Actual Result: HTTP 422 Unprocessable Entity / Validation error on 'name'
    * Status: Passed
    * Remark: Validation is correctly enforced on the 'name' field
    */
    public function test_create_category_fails_without_name()
    {

        $response = $this->postJson('/api/categories', [
            'name' => '',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }

}
