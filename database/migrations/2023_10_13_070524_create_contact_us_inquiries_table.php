<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('product')->nullable();
            $table->string('product_type')->nullable();
            $table->string('business_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('sub_distric')->nullable();
            $table->string('category')->nullable();
            $table->text('detail')->nullable();
            $table->enum('type', ['supplier', 'customer']);
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
        Schema::dropIfExists('contact_us_inquiries');
    }
};
