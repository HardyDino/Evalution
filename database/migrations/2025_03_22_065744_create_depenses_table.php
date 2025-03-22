<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_id');
            $table->decimal('montant', 10, 2);
            $table->unsignedInteger('ticket_id')->nullable(); // Lien avec trigger_ticket
            $table->unsignedInteger('lead_id')->nullable(); // Lien avec trigger_lead
            $table->timestamps();

            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
