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
        Schema::table('blog', function (Blueprint $table) {
            if (Schema::hasColumn('blog', 'whatever')) {
                $table->dropColumn('whatever');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog', function (Blueprint $table) {
            if (Schema::hasColumn('blog', 'whatever')) {
                $table->string('whatever', 100)->nullable()->after('description');
            }
        });
    }
};
