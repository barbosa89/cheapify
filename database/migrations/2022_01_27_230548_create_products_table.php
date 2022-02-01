<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 280);
            $table->string('name', 256);
            $table->string('description', 512);
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 4, 2)->default(0);
            $table->json('maker');
            $table->date('expired_at')->nullable();
            $table->unsignedInteger('stock');
            $table->foreignId('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories');
            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
