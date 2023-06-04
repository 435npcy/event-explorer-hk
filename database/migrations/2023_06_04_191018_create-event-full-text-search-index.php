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
        Schema::table('events', function (Blueprint $table) {
            $table->fullText('title');
            $table->fullText('description');
            $table->fullText('venue');
            $table->fullText(['title', 'description']);
            $table->fullText(['title', 'description', 'venue']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropFullText('events_title_fulltext');
            $table->dropFullText('events_description_fulltext');
            $table->dropFullText('events_venue_fulltext');
            $table->dropFullText('events_title_description_fulltext');
            $table->dropFullText('events_title_description_venue_fulltext');
        });
    }
};
