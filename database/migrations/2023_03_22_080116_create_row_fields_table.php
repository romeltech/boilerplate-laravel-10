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
        Schema::create('row_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emailer_id')->constrained();
            $table->string('height',15)->nullable();
            $table->string('width',15)->nullable(); 
            $table->string('padding_left',15)->nullable(); 
            $table->string('padding_right',15)->nullable(); 
            $table->string('padding_top',15)->nullable(); 
            $table->string('padding_bottom',15)->nullable(); 
            $table->string('column_count',10)->nullable(); 
            $table->string('orders',2)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('row_fields');
    }
};
