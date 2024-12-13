<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('office_title');
            $table->json('office_address');
            $table->json('office_contact');
            $table->json('office_email')->nullable();
            $table->text('office_description')->nullable();
            $table->string('established_year')->nullable();
            $table->string('slogan')->nullable();
            $table->string('main_logo');
            $table->string('side_logo')->nullable();
            $table->boolean('status');
            $table->foreignId('social_links_id')->constrained('social_links')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
