<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * @SWG\Post(
     *   path="/categories/",
     *   summary="Creates a category",
     *   @SWG\Parameter(
     *     name="category",
     *     in="body",
     *     description="The category object.",
     *     required=true,
     *     @SWG\Schema(
     *       @SWG\Property(property="name", type="string"),
     *       @SWG\Property(property="slug", type="string"),
     *       @SWG\Property(property="is_visible", type="boolean"),
     * 	     @SWG\Property(property="parent_id", type="string"),
     * 	   ),
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=400, description="bad request"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
        ]);

        return Category::create($request->all());

    }

    /**
     * @SWG\Get(
     *   path="/categories/{id}",
     *   summary="Get category by ID",
     *   @SWG\Parameter(
     *     name="id",
     *     name="id",
     *     in="path",
     *     description="The category ID.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=304, description="not modified"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * @SWG\Get(
     *   path="/categories/find/{slug}",
     *   summary="Find category by slug",
     *   @SWG\Parameter(
     *     name="slug",
     *     in="path",
     *     description="The category slug.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=304, description="not modified"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function find($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    /**
     * @SWG\Get(
     *   path="/categories/tree/{id}",
     *   summary="Get category tree by ID",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="The category ID.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=304, description="not modified"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function tree($id)
    {
        $category = Category::findOrFail($id);
        $tree = Category::descendantsAndSelf($category->id)->toTree()->first();
        return $tree;
    }

    /**
     * @SWG\Patch(
     *   path="/categories/{id}",
     *   summary="Updates a category visibility",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="The category ID.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="category",
     *     in="body",
     *     description="The category object.",
     *     required=true,
     *     @SWG\Schema(
     * 			@SWG\Property(property="isVisible", type="boolean"),
     * 		),
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=400, description="bad request"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->setAttribute('is_visible', $request->get('is_visible'));
        $category->saveOrFail();
        return $category;
    }
}
