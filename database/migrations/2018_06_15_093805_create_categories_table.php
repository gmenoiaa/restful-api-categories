<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->string('slug');
            $table->boolean('is_visible')->default(false);
            $table->primary('id');
            $table->timestamps();
            $table->string(NestedSet::LFT)->default('');
            $table->string(NestedSet::RGT)->default('');
            $table->string(NestedSet::PARENT_ID)->nullable();
            $table->index(NestedSet::getDefaultColumns());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
