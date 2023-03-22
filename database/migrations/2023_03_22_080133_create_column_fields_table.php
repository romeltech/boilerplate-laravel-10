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
        Schema::create('column_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('row_field_id')->constrained();
            $table->string('title')->nullable();
            $table->text('description')->nullable(); 
            $table->decimal('amount',10,2)->nullable(); 
            $table->decimal('sale_amount',10,2)->nullable(); 
            $table->string('align',15)->nullable(); 
            $table->string('link')->nullable(); 
            $table->string('height',15)->nullable(); 
            $table->string('width',15)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('column_fields');
    }
};
