<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Republishes the association's real campaigns (Zekât, Et Dağıtımı, İftar) with
 * honest Turkish/Arabic texts, locations Türkiye + Suriye and neutral illustrative
 * images (replacing unrelated stock photos). Campaign 3 stays hidden.
 * Backs up the touched rows first; down() restores them.
 */
return new class extends Migration
{
    private function backupPath(): string
    {
        return storage_path('app/backups/campaigns_before_2026_11_26.json');
    }

    public function up()
    {
        $content = require database_path('content/campaigns_2026_11.php');
        $ids = array_keys($content);

        File::ensureDirectoryExists(dirname($this->backupPath()));
        if (!File::exists($this->backupPath())) {
            File::put($this->backupPath(), json_encode([
                'campaigns' => DB::table('campaigns')->whereIn('id', $ids)->get(),
                'campaign_translations' => DB::table('campaign_translations')->whereIn('campaign_id', $ids)->get(),
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        $country = ['tr' => 'Türkiye ve Suriye', 'ar' => 'تركيا وسوريا'];

        DB::transaction(function () use ($content, $country) {
            foreach ($content as $id => $c) {
                if (!DB::table('campaigns')->where('id', $id)->exists()) {
                    continue; // only republish existing rows
                }
                DB::table('campaigns')->where('id', $id)->update([
                    'c_category_id' => $c['category'],
                    'image' => $c['image'],
                    'status' => 'active',
                    'complete' => 'no',
                    'deleted_at' => null,
                    'updated_at' => now(),
                ]);

                foreach (['tr' => 'tr', 'ar' => 'ar', 'en' => 'tr'] as $locale => $source) {
                    $t = $c[$source];
                    DB::table('campaign_translations')->updateOrInsert(
                        ['campaign_id' => $id, 'locale' => $locale],
                        [
                            'name' => $t['name'],
                            'name_slug' => $t['name_slug'],
                            'meta_title' => $t['name'],
                            'meta_description' => $t['meta_description'],
                            'keywords' => null,
                            'image_alt' => $t['name'],
                            'country' => $country[$source],
                            'description' => $t['description'],
                        ]
                    );
                }
            }
        });
    }

    public function down()
    {
        if (!File::exists($this->backupPath())) {
            return;
        }
        $backup = json_decode(File::get($this->backupPath()), true);

        DB::transaction(function () use ($backup) {
            foreach ($backup['campaigns'] as $row) {
                DB::table('campaigns')->where('id', $row['id'])->update([
                    'c_category_id' => $row['c_category_id'], 'image' => $row['image'],
                    'status' => $row['status'], 'complete' => $row['complete'], 'deleted_at' => $row['deleted_at'],
                ]);
            }
            foreach ($backup['campaign_translations'] as $row) {
                $id = $row['id'];
                unset($row['id']);
                DB::table('campaign_translations')->updateOrInsert(['campaign_id' => $row['campaign_id'], 'locale' => $row['locale']], $row);
            }
        });
    }
};
