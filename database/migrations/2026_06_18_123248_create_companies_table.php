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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('initial');
            $table->unsignedBigInteger('userId')->nullable();
            $table->string('email')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->longText('description')->nullable();
            $table->string('city')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
