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
        Schema::create('client_companies', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('company_logo')->nullable(); // Company logo (path to image)
            $table->string('company_name');
            $table->string('email');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('website');
            $table->string('owner')->nullable();
            $table->string('source');
            $table->string('industry');
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state_province')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
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
        Schema::dropIfExists('client_companies');
    }
};
