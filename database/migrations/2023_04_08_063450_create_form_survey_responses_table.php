<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_survey_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_survey_id');
            $table->text('response');
            $table->timestamps();

            $table->foreign('form_survey_id')->references('id')->on('form_surveys')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_survey_responses');
    }
};
