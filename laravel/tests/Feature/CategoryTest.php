<?php

namespace Tests\Feature;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
     /**
     * Test ID: Category-001
     * Description: Check if we can access the get all categories API
     * Precondition: None
     * Test Steps:
     *    1. Hit the get all categories API
     *    2. Check if the response status is 200
     * Test Data: None
     * Expected Result: The response status should be 200
     * Actual Result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_can_access_get_all_categories()
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(200);
    }
    public function test_can_access_create_category()
    {
        $name = 'Test Category ' . uniqid();

        $response = $this->post('/api/categories', [
            'name' => $name,
        ]);

        $response->assertStatus(201);
        $response->assertCreated();
        $this->assertDatabaseHas('categories', [
            'name' => $name ,
        ]);
    }
    public function test_can_access_get_category_by_id()
    {
        $response = $this->get('/api/categories/1');

        $response->assertStatus(200);
    }
    public function test_can_access_update_category()
    {
        $response = $this->patch('/api/categories/1', [
            'name' => 'Updated Category' . uniqid(),
        ]);

        $response->assertStatus(200);
    }
    public function test_can_access_find_all_products_by_category()
    {
        $response = $this->get('/api/categories/1/products');

        $response->assertStatus(200);
    }

    public function test_can_access_search_category()
    {
        $response = $this->get('/api/categories/search?query=test');

        $response->assertStatus(200);
    }


    public function test_can_access_delete_category()
    {

        $response = $this->delete('/api/categories/1');
        // restore the category

        $response->assertStatus(200);
    }

    public function test_can_access_get_limited_categories()
    {
        $response = $this->get('/api/categories/limited_category/4');

        $response->assertStatus(200);
    }
    public function test_can_access_sort_categories()
    {
        $response = $this->get('/api/categories/sort');

        $response->assertStatus(200);
    }

    public function test_can_access_restore_category()
    {
        $response = $this->post('/api/categories/restore/1');

        $response->assertStatus(200);
    }


}
