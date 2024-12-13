<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->connstrained()->onDelete('cascade'); 
            $table->foreignId('product_id')->constrained('product')->onDelete('cascade');
            $table->unsignedBigInteger('cart_id')->nullable()->change();
            $table->string('location');
            $table->string('contact');
            $table->string('date');
            $table->string('bill_no');
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamps();
        });
        
    }
      

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
