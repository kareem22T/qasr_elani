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
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->unsignedDouble('regular_price');
            $table->unsignedDouble('sale_price')->nullable();
            $table->unsignedDouble('cashback')->default(0);
            $table->unsignedBigInteger('stock');
            $table->foreignId('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->unsignedBigInteger('sort');
            $table->unsignedBigInteger('views')->default(0);
            $table->tinyInteger('is_recommended')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->softDeletes();
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
