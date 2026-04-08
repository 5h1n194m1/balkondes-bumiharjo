<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGalleryItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'caption' => ['type' => 'TEXT', 'null' => true],
            'media_type' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'image'],
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'video_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('gallery_items');
    }

    public function down()
    {
        $this->forge->dropTable('gallery_items');
    }
}
