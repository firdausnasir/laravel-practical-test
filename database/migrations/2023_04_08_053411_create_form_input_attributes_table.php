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
        Schema::create('form_input_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_input_id');
            $table->char('name');
            $table->char('value');
            $table->timestamps();

            $table->foreign('form_input_id')->references('id')->on('form_inputs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_input_attributes');
    }
};
