<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoFieldsToAreasTable extends Migration
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

        if (!Schema::hasColumn('areas', 'meta_title')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->string('meta_title')->nullable()->after('full_description');
            });
        }
        if (!Schema::hasColumn('areas', 'meta_keywords')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->text('meta_keywords')->nullable()->after('meta_title');
            });
        }
        if (!Schema::hasColumn('areas', 'meta_description')) {
            Schema::table('areas', function (Blueprint $table) {
                $table->text('meta_description')->nullable()->after('meta_keywords');
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
        foreach (['meta_title', 'meta_keywords', 'meta_description'] as $col) {
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
