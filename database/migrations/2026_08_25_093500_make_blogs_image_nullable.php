<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeBlogsImageNullable extends Migration
{
    public function up()
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE blogs MODIFY image VARCHAR(255) NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE blogs ALTER COLUMN image DROP NOT NULL');
        } else {
            // sqlite / others: recreate is heavy; try a soft no-op if already nullable
            DB::statement('CREATE TABLE IF NOT EXISTS blogs_image_nullable_tmp AS SELECT 1');
            DB::statement('DROP TABLE IF EXISTS blogs_image_nullable_tmp');
        }
    }

    public function down()
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("UPDATE blogs SET image = '' WHERE image IS NULL");
            DB::statement('ALTER TABLE blogs MODIFY image VARCHAR(255) NOT NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement("UPDATE blogs SET image = '' WHERE image IS NULL");
            DB::statement('ALTER TABLE blogs ALTER COLUMN image SET NOT NULL');
        }
    }
}
