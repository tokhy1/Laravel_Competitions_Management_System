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
        Schema::disableForeignKeyConstraints();

        Schema::create('individuals_events_score', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('individual_id')->unsigned();
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete("cascade")->onUpdate("cascade");
            $table->bigInteger('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedInteger('event_score')->default(0);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individuals_events_score');
    }
};
