<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResponsesTable extends Migration
{
    public function up()
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id(); // Unique identifier for each response
            $table->unsignedBigInteger('survey_id'); // References the survey
            $table->text('formatted_answers'); // Stores answers in a structured format
            $table->timestamps(); // created_at and updated_at timestamps

            // Foreign key constraints
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('survey_responses');
    }
}
