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
        Schema::create('shopping_list_items', function (Blueprint $table) {
             $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('shopping_list_id')
                ->constrained('shopping_lists')
                ->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_purchased')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_list_items');
    }
};
