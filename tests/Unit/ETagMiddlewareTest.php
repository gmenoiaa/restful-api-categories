<?php

namespace Tests\Unit;

use App\Category;
use App\Http\Middleware\ETagMiddleware;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ETagMiddlewareTest extends TestCase
{
    public function testETagMatch()
    {
        $category = Category::create(['name' => 'Root']);
        $json = response()->json($category);
        $request = Request::create(
            "/api/categories/{$category->id}",
            'GET'
        );
        $request->headers->set('If-None-Match', md5($json->getContent()));
        $middleware = new ETagMiddleware();
        $response = $middleware->handle($request, function() use ($json) {
            return $json;
        });
        $this->assertEquals($response->getStatusCode(), 304);
    }

    public function testETagNoMatch()
    {
        $category1 = Category::create(['name' => 'Root']);
        $category2 = Category::create(['name' => 'Root2']);
        $request = Request::create(
            "/api/categories/{$category1->id}",
            'GET'
        );
        $request->headers->set('If-None-Match', md5(response()->json($category1)->getContent()));
        $middleware = new ETagMiddleware();
        $response = $middleware->handle($request, function() use ($category2) {
            return response()->json($category2);
        });
        $this->assertEquals($response->getStatusCode(), 200);
    }
}
