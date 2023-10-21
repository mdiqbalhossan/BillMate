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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string('estimate_number')->unique();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->date('estimate_date');
            $table->decimal('sub_total', 15, 2);
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('tax', 15, 2)->nullable();
            $table->decimal('total', 15, 2);
            $table->text('notes')->nullable();
            $table->enum('status', ['draft', 'sent', 'declined', 'accepted'])->default('draft');
            $table->enum('tax_type', ['percent', 'fixed'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
