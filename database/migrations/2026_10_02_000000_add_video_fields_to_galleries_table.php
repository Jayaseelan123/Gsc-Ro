<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Gallery items can now be videos: a YouTube link or an uploaded file.
     * "image" becomes optional because it is only the cover picture for a video.
     */
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('media_type', 10)->default('image')->after('description');
            $table->string('video_url')->nullable()->after('image');
            $table->string('video_path')->nullable()->after('video_url');
            $table->string('image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'video_url', 'video_path']);
        });

        // Videos without a cover have no image; they cannot exist once the video columns are gone.
        DB::table('galleries')->whereNull('image')->delete();

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change();
        });
    }
};
