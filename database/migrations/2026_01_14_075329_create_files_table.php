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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('path');           // путь до файла
            $table->string('original_name');  // оригинальное имя
            $table->timestamps();             // created_at, updated_at

            $table->unique('path');           // уникальный путь
            $table->index('original_name');   // индекс для поиска
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
