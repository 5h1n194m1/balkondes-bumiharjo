<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVideoUrlToSiteSettings extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('video_url', 'site_settings')) {
            $this->forge->addColumn('site_settings', [
                'video_url' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true, 'after' => 'video_path'],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('video_url', 'site_settings')) {
            $this->forge->dropColumn('site_settings', 'video_url');
        }
    }
}
