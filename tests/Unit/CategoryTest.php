<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Category;

class CategoryTest extends TestCase
{
    public function testNewCategory()
    {
        $category = new Category([
            'name' => 'Root',
            'is_visible' => true,
        ]);
        $category->save();
        $categories = Category::all();
        assert($categories->count() == 1, 'Not only one category');
        $first = $categories->first();
        assert($category->id == $first->id, 'Category id is not the same');
    }

    public function testNonEmptySlug()
    {
        $cat = new Category([
            'name' => 'Test',
            'slug' => 'some-custom-slug',
        ]);
        $cat->save();
        $cat->refresh();

        assert($cat->slug == 'some-custom-slug');
    }

}
