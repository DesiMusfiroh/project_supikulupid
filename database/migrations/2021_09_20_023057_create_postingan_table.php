<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postingan', function (Blueprint $table) {
            $table->Increments('id_postingan');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('kategori_id');
            $table->unsignedInteger('subKategori_id');
            $table->string('judul',50);
            $table->longText('isi');
            $table->enum('status',['edited','processed','published'])->default('edited');
            $table->dateTime('published_at')->nullable();
            $table->string('gambar');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subKategori_id')->references('id_subkategori')->on('sub_kategoris')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('postingan');
    }
}
