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
        Schema::table('todos', function (Blueprint $table) {

            if (!Schema::hasColumn('todos', 'start_date')) {
                $table->date('start_date')->nullable();
            }

            if (!Schema::hasColumn('todos', 'end_date')) {
                $table->date('end_date')->nullable();
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {

            if (Schema::hasColumn('todos', 'start_date')) {
                $table->dropColumn('start_date');
            }

            if (Schema::hasColumn('todos', 'end_date')) {
                $table->dropColumn('end_date');
            }

        });
    }
};