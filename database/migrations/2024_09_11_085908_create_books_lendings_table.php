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
        Schema::create('books_lendings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_book_id')->constrained(
                table: 'transaction_books',
                indexName: 'transaction_books_lending'
            );
            $table->integer('denda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_lendings');
    }
};
