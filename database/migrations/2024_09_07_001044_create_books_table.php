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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug');
            $table->string('image');
            $table->string('pengarang');
            $table->string('penerbit');
            // $table->foreignId('genre_id')->constrained(
            //     table: 'genres',
            //     indexName: 'genre_book_id'
            // );
            $table->bigInteger('genre_id');
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
