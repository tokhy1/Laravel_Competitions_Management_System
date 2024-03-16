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

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->unsignedInteger('event_points')->default(0);
            $table->string('event_type');
            $table->bigInteger('competition_id')->unsigned();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete("cascade")->onUpdate("cascade");
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
