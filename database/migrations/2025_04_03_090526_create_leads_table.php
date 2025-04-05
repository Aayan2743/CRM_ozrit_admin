<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     /*
    Created By Kumar Asapu (03-Apr-2025)
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('lead_name');
            $table->enum('lead_type', ['Person', 'Organization'])->default('Person'); // Lead type with a default value
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('client_companies')->onDelete('cascade')->onUpdate('cascade');
            $table->string('phone');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('source');
            $table->string('industry');
            $table->string('company_logo')->nullable();
            $table->string('owner')->nullable();
            $table->string('status')->default('active');
            $table->string('company_id')->nullable(); 
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['lead_source_id']);
            $table->dropForeign(['lead_status_id']);
            $table->dropForeign(['assigned_to']);
        });
        Schema::dropIfExists('leads');
    }
};
