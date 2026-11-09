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
        // 1. Update users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable()->after('profile_pic');
            }
            if (!Schema::hasColumn('users', 'favorite_fandoms')) {
                $table->text('favorite_fandoms')->nullable()->after('is_banned');
            }
            if (!Schema::hasColumn('users', 'categories_of_interest')) {
                $table->text('categories_of_interest')->nullable()->after('favorite_fandoms');
            }
            if (!Schema::hasColumn('users', 'display_preferences')) {
                $table->string('display_preferences')->nullable()->default('system')->after('categories_of_interest');
            }
        });

        // 2. Update categories table
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('slug');
            }
        });

        // 3. Update contents table
        Schema::table('contents', function (Blueprint $table) {
            if (!Schema::hasColumn('contents', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('contents', 'type')) {
                $table->string('type')->nullable()->default('Movie')->after('description');
            }
            if (!Schema::hasColumn('contents', 'release_year')) {
                $table->integer('release_year')->nullable()->after('release_date');
            }
            if (!Schema::hasColumn('contents', 'popularity')) {
                $table->integer('popularity')->default(0)->after('release_year');
            }
            if (!Schema::hasColumn('contents', 'status')) {
                $table->string('status')->nullable()->default('Released')->after('popularity');
            }
        });

        // 4. Update characters table
        Schema::table('characters', function (Blueprint $table) {
            if (!Schema::hasColumn('characters', 'content_id')) {
                $table->foreignId('content_id')->nullable()->after('category_id')->constrained('contents')->onDelete('cascade');
            }
            if (!Schema::hasColumn('characters', 'role')) {
                $table->string('role')->nullable()->after('name');
            }
            if (!Schema::hasColumn('characters', 'bio')) {
                $table->text('bio')->nullable()->after('desc');
            }
        });

        // 5. Update feedbacks table
        Schema::table('feedbacks', function (Blueprint $table) {
            if (!Schema::hasColumn('feedbacks', 'type')) {
                $table->string('type')->default('Query')->after('user_id');
            }
            if (!Schema::hasColumn('feedbacks', 'status')) {
                $table->string('status')->default('Pending')->after('message');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe down
    }
};
