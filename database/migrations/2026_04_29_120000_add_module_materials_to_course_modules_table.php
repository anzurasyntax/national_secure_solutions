<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_modules', function (Blueprint $table) {
            $table->json('module_materials')->nullable()->after('video_paths');
        });

        $rows = DB::table('course_modules')->get();
        foreach ($rows as $row) {
            $paths = json_decode($row->video_paths ?? 'null', true);
            if (! is_array($paths) || $paths === []) {
                continue;
            }

            $materials = [];
            foreach ($paths as $path) {
                if (! is_string($path) || $path === '') {
                    continue;
                }
                $materials[] = [
                    'id' => (string) Str::uuid(),
                    'type' => 'video',
                    'path' => $path,
                    'name' => basename($path),
                    'slides' => null,
                ];
            }

            if ($materials !== []) {
                DB::table('course_modules')->where('id', $row->id)->update([
                    'module_materials' => json_encode($materials),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('course_modules', function (Blueprint $table) {
            $table->dropColumn('module_materials');
        });
    }
};
