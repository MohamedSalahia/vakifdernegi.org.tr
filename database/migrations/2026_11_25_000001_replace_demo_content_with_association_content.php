<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Replaces the template/demo content (copied from another organisation) with the
 * association's own content, and hides (soft-deletes) the demo campaigns, sliders,
 * articles and categories. Nothing is hard-deleted.
 *
 * A JSON backup of every row touched is written to storage/app/backups/ first,
 * and down() restores it.
 */
return new class extends Migration
{
    private const DEMO_CAMPAIGNS = [1, 2, 3, 4];
    private const DEMO_SLIDERS = [1, 2, 3];
    private const DEMO_BLOGS = [1, 2, 3];
    private const DEMO_CAMPAIGN_CATEGORIES = [2]; // "Vakıflar" (waqfs): a dernek does not run waqfs
    private const HIDDEN_PAGES = [4];             // "Said about us": quotes about another organisation

    private function backupPath(): string
    {
        return storage_path('app/backups/content_before_2026_11_25.json');
    }

    public function up()
    {
        $content = require database_path('content/pages_2026_11.php');
        $pageIds = array_keys($content);

        // 1) Backup
        $backup = [
            'pages' => DB::table('pages')->whereIn('id', array_merge($pageIds, self::HIDDEN_PAGES))->get(),
            'page_translations' => DB::table('page_translations')->whereIn('page_id', array_merge($pageIds, self::HIDDEN_PAGES))->get(),
            'campaigns' => DB::table('campaigns')->whereIn('id', self::DEMO_CAMPAIGNS)->get(['id', 'deleted_at']),
            'sliders' => DB::table('sliders')->whereIn('id', self::DEMO_SLIDERS)->get(['id', 'deleted_at']),
            'blogs' => DB::table('blogs')->whereIn('id', self::DEMO_BLOGS)->get(['id', 'deleted_at']),
            'campaign_categories' => DB::table('campaign_categories')->whereIn('id', self::DEMO_CAMPAIGN_CATEGORIES)->get(['id', 'deleted_at']),
        ];
        File::ensureDirectoryExists(dirname($this->backupPath()));
        if (!File::exists($this->backupPath())) {
            File::put($this->backupPath(), json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        $now = now();

        DB::transaction(function () use ($content, $now) {
            // 2) Fixed pages: create if missing, then set tr/ar content
            foreach ($content as $pageId => $locales) {
                if (!DB::table('pages')->where('id', $pageId)->exists()) {
                    DB::table('pages')->insert([
                        'id' => $pageId, 'page_category_id' => null, 'image' => null,
                        'header_show' => 0, 'special' => 0, 'locked' => 1,
                        'created_at' => $now, 'updated_at' => $now,
                    ]);
                }
                DB::table('pages')->where('id', $pageId)->update(['deleted_at' => null, 'updated_at' => $now]);

                foreach ($locales as $locale => $fields) {
                    DB::table('page_translations')->updateOrInsert(
                        ['page_id' => $pageId, 'locale' => $locale],
                        ['name' => $fields['name'], 'description' => $fields['description']]
                    );
                }
                // English is hidden on the site; keep it aligned with Turkish instead of the old Arabic copy
                DB::table('page_translations')->updateOrInsert(
                    ['page_id' => $pageId, 'locale' => 'en'],
                    ['name' => $locales['tr']['name'], 'description' => $locales['tr']['description']]
                );
            }

            // 3) Hide demo content (soft delete, reversible)
            DB::table('pages')->whereIn('id', self::HIDDEN_PAGES)->whereNull('deleted_at')->update(['deleted_at' => $now]);
            DB::table('campaigns')->whereIn('id', self::DEMO_CAMPAIGNS)->whereNull('deleted_at')->update(['deleted_at' => $now]);
            DB::table('sliders')->whereIn('id', self::DEMO_SLIDERS)->whereNull('deleted_at')->update(['deleted_at' => $now]);
            DB::table('blogs')->whereIn('id', self::DEMO_BLOGS)->whereNull('deleted_at')->update(['deleted_at' => $now]);
            DB::table('campaign_categories')->whereIn('id', self::DEMO_CAMPAIGN_CATEGORIES)->whereNull('deleted_at')->update(['deleted_at' => $now]);
        });
    }

    public function down()
    {
        if (!File::exists($this->backupPath())) {
            return;
        }
        $backup = json_decode(File::get($this->backupPath()), true);

        DB::transaction(function () use ($backup) {
            foreach (['campaigns', 'sliders', 'blogs', 'campaign_categories'] as $table) {
                foreach ($backup[$table] as $row) {
                    DB::table($table)->where('id', $row['id'])->update(['deleted_at' => $row['deleted_at']]);
                }
            }
            $existingPages = collect($backup['pages'])->pluck('id')->all();
            foreach ($backup['pages'] as $row) {
                DB::table('pages')->where('id', $row['id'])->update(['deleted_at' => $row['deleted_at']]);
            }
            foreach ($backup['page_translations'] as $row) {
                DB::table('page_translations')->updateOrInsert(
                    ['page_id' => $row['page_id'], 'locale' => $row['locale']],
                    ['name' => $row['name'], 'description' => $row['description']]
                );
            }
            // Pages that did not exist before are removed again
            $content = require database_path('content/pages_2026_11.php');
            $created = array_diff(array_keys($content), $existingPages);
            if ($created) {
                DB::table('page_translations')->whereIn('page_id', $created)->delete();
                DB::table('pages')->whereIn('id', $created)->delete();
            }
        });
    }
};
