<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeBlogsScheduledAtToDatetime extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('blogs', 'scheduled_at')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dateTime('scheduled_at')->nullable()->after('status');
            });
            return;
        }

        // Use wall-clock datetime (Asia/Kolkata) instead of MySQL TIMESTAMP conversions
        DB::statement('ALTER TABLE blogs MODIFY scheduled_at DATETIME NULL');
    }

    public function down()
    {
        if (Schema::hasColumn('blogs', 'scheduled_at')) {
            DB::statement('ALTER TABLE blogs MODIFY scheduled_at TIMESTAMP NULL');
        }
    }
}
