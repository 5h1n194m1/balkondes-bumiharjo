<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHeroSlidesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'subtitle' => ['type' => 'TEXT', 'null' => true],
            'button_text' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'button_link' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('hero_slides');
    }

    public function down()
    {
        $this->forge->dropTable('hero_slides');
    }
}
