<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->foreignId('category_id')->after('id')->constrained()->restrictOnDelete();
            $table->string('code', 30)->unique()->after('category_id');
            $table->string('location', 150)->nullable()->after('description');
            $table->unsignedInteger('capacity')->default(0)->after('location');
            $table->unsignedInteger('registered_count')->default(0)->after('capacity');
            $table->dateTime('start_at')->nullable()->after('activity_date');
            $table->dateTime('end_at')->nullable()->after('start_at');
            $table->string('poster_path')->nullable()->after('end_at');
            // change status default to draft
            $table->string('status', 20)->default('draft')->change();
            // drop old string column now replaced by category_id FK
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'code', 'location', 'capacity', 'registered_count', 'start_at', 'end_at', 'poster_path']);
        });
    }
};
