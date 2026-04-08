<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'company_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Balkondes Bumiharjo'],
            'hero_headline' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'hero_subheadline' => ['type' => 'TEXT', 'null' => true],
            'about_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'about_content' => ['type' => 'TEXT', 'null' => true],
            'services_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'services_intro' => ['type' => 'TEXT', 'null' => true],
            'footer_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'address' => ['type' => 'TEXT', 'null' => true],
            'maps_embed_url' => ['type' => 'TEXT', 'null' => true],
            'opening_hours' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'whatsapp_number' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'whatsapp_message' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('site_settings');
    }

    public function down()
    {
        $this->forge->dropTable('site_settings');
    }
}
