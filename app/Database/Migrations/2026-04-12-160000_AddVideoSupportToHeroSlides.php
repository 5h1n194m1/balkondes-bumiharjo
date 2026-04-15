<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVideoSupportToHeroSlides extends Migration
{
    public function up()
    {
        $fields = [
            'media_type' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'image', 'after' => 'button_link'],
            'video_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'image_path'],
        ];

        foreach ($fields as $field => $definition) {
            if (! $this->db->fieldExists($field, 'hero_slides')) {
                $this->forge->addColumn('hero_slides', [$field => $definition]);
            }
        }
    }

    public function down()
    {
        foreach (['media_type', 'video_path'] as $field) {
            if ($this->db->fieldExists($field, 'hero_slides')) {
                $this->forge->dropColumn('hero_slides', $field);
            }
        }
    }
}
