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

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->bigInteger('team_leader_id')->unsigned();
            $table->foreign('team_leader_id')->references('id')->on('users')->onDelete("cascade")->onUpdate("cascade");
            $table->bigInteger('competition_id')->unsigned();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
