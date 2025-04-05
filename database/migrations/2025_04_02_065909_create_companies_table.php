<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
        // Step 1: Create the companies table
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->unique(); 
            $table->string('company_name');
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('office_phone', 15)->unique(); 
            $table->string('password')->nullable(); 
            $table->string('whatsappnumber');   
            $table->text('address')->nullable(); 
            $table->string('website')->nullable(); 
            $table->string('industry')->nullable(); 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->text('notes')->nullable();
            $table->timestamps(); 
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the companies table
        Schema::dropIfExists('companies');
    }
};
