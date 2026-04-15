<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDedicatedVideoSectionToSiteSettings extends Migration
{
    public function up()
    {
        $fields = [
            'video_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'video_caption'],
        ];

        foreach ($fields as $field => $definition) {
            if (! $this->db->fieldExists($field, 'site_settings')) {
                $this->forge->addColumn('site_settings', [$field => $definition]);
            }
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('video_path', 'site_settings')) {
            $this->forge->dropColumn('site_settings', 'video_path');
        }
    }
}
