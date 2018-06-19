<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Ramsey\Uuid\Uuid;

class Category extends Model
{
    use NodeTrait;

    public $incrementing = false;

    protected $fillable = ['name', 'slug', 'is_visible', 'parent_id'];
    protected $visible = ['id', 'name', 'slug', 'is_visible', 'children'];
    protected $keyType = 'string';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->id = Uuid::uuid1();
        $this->is_visible = array_key_exists('is_visible', $attributes) ? $attributes['is_visible'] : true;
        $this->slug = array_key_exists('slug', $attributes) ? $attributes['slug'] : str_slug($this->name);
    }
}
