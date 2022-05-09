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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('vinyls', function (Blueprint $table) {
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    public function down()
    {
        Schema::table('vinyls', function (Blueprint $table) {
            $table->dropForeign('vinyls_genre_id_foreign');
            $table->dropColumn('genre_id');
        });
        Schema::dropIfExists('genres');
    }
};
