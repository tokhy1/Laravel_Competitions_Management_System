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

        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('competition_name');
            $table->unsignedInteger('num_of_events')->default(5);
            $table->string('description');
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
        Schema::dropIfExists('competitions');
    }
};
