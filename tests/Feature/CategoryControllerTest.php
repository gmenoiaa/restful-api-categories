<?php

namespace Tests\Feature;

use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    private $rootId;

    public function setUp()
    {
        parent::setUp();
        $response = $this->json('POST', '/api/categories', ['name' => 'Root']);
        $json = $response->decodeResponseJson();
        $this->rootId = $json['id'];
    }

    public function testGetRootCategory()
    {
        $response = $this->json('GET', '/api/categories/' . $this->rootId);
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Root',
                'slug' => 'root',
                'is_visible' => 1
            ]);
    }

    public function testCategoryTree()
    {
        $response = $this->json('POST', '/api/categories', ['name' => 'Sub', 'parent_id' => $this->rootId]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Sub',
                'slug' => 'sub',
                'is_visible' => 1
            ]);

        $response = $this->json('GET', 'api/categories/tree/'. $this->rootId);
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Root',
                'slug' => 'root',
                'is_visible' => 1,
                'children' => [
                    [
                        'name' => 'Sub',
                        'slug' => 'sub',
                        'is_visible' => 1
                    ]
                ]
            ]);
    }

    public function testUpdateVisibility()
    {
        $this->json('PATCH', 'api/categories/'. $this->rootId, [
            'is_visible' => 0
        ]);

        $response = $this->json('GET', '/api/categories/' . $this->rootId);
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Root',
                'slug' => 'root',
                'is_visible' => 0
            ]);
    }


    public function testFindBySlug()
    {
        $response = $this->json('GET', '/api/categories/find/root');
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'Root',
                'slug' => 'root',
                'is_visible' => 1
            ]);
    }
}
