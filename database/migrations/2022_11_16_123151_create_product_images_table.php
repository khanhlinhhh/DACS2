<?php

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            // $table->increments('id');
            // $table->integer('product_id');
            //   $table->unsignedBigInteger('product_id');
            $table->foreignIdFor(Product::class, 'product_id');

            // $table->foreignId('product_id');
          
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // $table->bigIncrements('id');
           
            // $table->integer('product_id')->unsigned();
            $table->string('image');
            $table->timestamps();
        });
        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}