<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name')->nullable();
            $table->string('genetic_name')->nullable();
            $table->string('category')->nullable();
            $table->string('reg_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('status')->nullable();
            $table->string('nafdac_number')->nullable();
            $table->string('sku')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('batch_number')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('drugs');
    }
}
