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
        Schema::create('transaction_books', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'pinjam_buku_id'
            );
            $table->foreignId('book_id')->constrained(
                table: 'books',
                indexName: 'books_pinjam_id'
            );
            $table->timestamp('tanggal_di_pinjam');
            $table->integer('batas_pinjam');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_books');
    }
};
