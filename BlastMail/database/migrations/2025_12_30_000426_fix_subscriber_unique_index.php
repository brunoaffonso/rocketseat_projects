<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Try to drop the old index if it exists (handles cases where the original migration might be missing)
        DB::statement('DROP INDEX IF EXISTS subscribers_email_list_id_email_unique');

        // Create a partial unique index that only applies to non-deleted records
        // This works for SQLite 3.8.0+
        DB::statement('CREATE UNIQUE INDEX subscribers_email_list_id_email_partial_unique ON subscribers (email_list_id, email) WHERE deleted_at IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS subscribers_email_list_id_email_partial_unique');
        DB::statement('DROP INDEX IF EXISTS subscribers_email_list_id_email_unique');

        Schema::table('subscribers', function (Blueprint $table) {
            $table->unique(['email_list_id', 'email'], 'subscribers_email_list_id_email_unique');
        });
    }
};
