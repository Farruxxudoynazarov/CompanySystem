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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('passport_number')->unique();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('positon')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
