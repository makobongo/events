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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string("TransactionType")->nullable();
            $table->string("TransID")->nullable();
            $table->string("TransTime")->nullable();
            $table->string("BusinessShortCode")->nullable();
            $table->string("BillRefNumber")->nullable();
            $table->string("InvoiceNumber")->nullable();
            $table->string("ThirdPartyTransID")->nullable();
            $table->string("MSISDN")->nullable();
            $table->string("FirstName")->nullable();
            $table->string("MiddleName")->nullable();
            $table->string("LastName")->nullable();
            $table->decimal("TransAmount", 8, 2)->nullable();
            $table->decimal("OrgAccountBalance", 8, 2)->nullable();
            $table->string('ticket_number')->nullable();
            $table->boolean('ticket_is_valid')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
