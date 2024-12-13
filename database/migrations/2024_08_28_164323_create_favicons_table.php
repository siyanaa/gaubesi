<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaviconsTable extends Migration
{
    public function up()
    {
        Schema::create('favicons', function (Blueprint $table) {
            $table->id();
            $table->string('favicon_thirtytwo');
            $table->string('favicon_sixteen');
            $table->string('favicon_ico');
            $table->string('appletouch_icon');
            $table->string('site_manifest');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('favicons');
    }
}
