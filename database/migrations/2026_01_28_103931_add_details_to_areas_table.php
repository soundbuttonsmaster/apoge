<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('areas')) {
            return;
        }

        if (!Schema::hasColumn('areas', 'slug')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->string('slug')->after('name');
            });
        }
        if (!Schema::hasColumn('areas', 'image')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->string('image')->nullable()->after('slug');
            });
        }
        if (!Schema::hasColumn('areas', 'short_description')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->text('short_description')->nullable()->after('image');
            });
        }
        if (!Schema::hasColumn('areas', 'full_description')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->longText('full_description')->nullable()->after('short_description');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('areas')) {
            return;
        }

        $cols = [];
        foreach (['slug', 'image', 'short_description', 'full_description'] as $col) {
            if (Schema::hasColumn('areas', $col)) {
                $cols[] = $col;
            }
        }
        if ($cols) {
            Schema::table('areas', function (Blueprint $table) use ($cols) {
                $table->dropColumn($cols);
            });
        }
    }
}
