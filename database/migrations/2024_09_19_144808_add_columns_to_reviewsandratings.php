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
        Schema::table('reviewsandratings', function (Blueprint $table) {
            $table->string('email');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviewsandratings', function (Blueprint $table) {
            //
        });
    }
};