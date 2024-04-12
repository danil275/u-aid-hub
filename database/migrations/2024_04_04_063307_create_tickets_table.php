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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('title');
            $table->string('text');
            $table->time('escalation_time')->nullable();
            $table->time('escalation_update_time')->nullable();
            $table->time('escalation_response_time')->nullable();
            $table->time('escalation_solution_time')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_anon')->default(false);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
