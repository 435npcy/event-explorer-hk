<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('sub_price', 19, 2);
            $table->unsignedInteger('quantity');
            $table->unsignedDecimal('sub_amount', 19, 2);

            // $table->foreignId('event_id')->constrained();
            // $table->foreignId('user_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('ticket_type_id')->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};