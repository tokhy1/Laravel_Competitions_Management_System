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
        Schema::disableForeignKeyConstraints();

        Schema::create('teams_competitions_score', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('competition_id')->unsigned();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete("cascade")->onUpdate("cascade");
            $table->bigInteger('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedInteger('total_score')->default(0);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams_competitions_score');
    }
};
