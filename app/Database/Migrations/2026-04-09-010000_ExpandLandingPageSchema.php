<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExpandLandingPageSchema extends Migration
{
    public function up()
    {
        $siteSettingsFields = [
            'hero_kicker' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'company_name'],
            'hero_primary_label' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'hero_subheadline'],
            'hero_primary_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'hero_primary_label'],
            'hero_secondary_label' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'hero_primary_url'],
            'hero_secondary_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'hero_secondary_label'],
            'about_label' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'about_title'],
            'services_label' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'services_title'],
            'gallery_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'services_intro'],
            'gallery_intro' => ['type' => 'TEXT', 'null' => true, 'after' => 'gallery_title'],
            'gallery_label' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'gallery_intro'],
            'video_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'gallery_label'],
            'video_caption' => ['type' => 'TEXT', 'null' => true, 'after' => 'video_title'],
            'video_enabled' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1, 'after' => 'video_caption'],
            'location_title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'address'],
            'location_intro' => ['type' => 'TEXT', 'null' => true, 'after' => 'location_title'],
            'location_label' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'location_intro'],
            'footer_description' => ['type' => 'TEXT', 'null' => true, 'after' => 'footer_title'],
            'instagram_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'whatsapp_message'],
            'facebook_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'instagram_url'],
            'maps_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'facebook_url'],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'maps_url'],
        ];

        foreach ($siteSettingsFields as $field => $definition) {
            if (! $this->db->fieldExists($field, 'site_settings')) {
                $this->forge->addColumn('site_settings', [$field => $definition]);
            }
        }

        $serviceFields = [
            'image_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'description'],
            'highlight_points' => ['type' => 'TEXT', 'null' => true, 'after' => 'image_path'],
        ];

        foreach ($serviceFields as $field => $definition) {
            if (! $this->db->fieldExists($field, 'services')) {
                $this->forge->addColumn('services', [$field => $definition]);
            }
        }

        if (! $this->db->tableExists('booking_links')) {
            $this->forge->addField([
                'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'group_key' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'contact'],
                'label' => ['type' => 'VARCHAR', 'constraint' => 255],
                'description' => ['type' => 'TEXT', 'null' => true],
                'url' => ['type' => 'VARCHAR', 'constraint' => 255],
                'sort_order' => ['type' => 'INT', 'default' => 0],
                'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('booking_links');
        }
    }

    public function down()
    {
        if ($this->db->tableExists('booking_links')) {
            $this->forge->dropTable('booking_links');
        }

        foreach (['image_path', 'highlight_points'] as $field) {
            if ($this->db->fieldExists($field, 'services')) {
                $this->forge->dropColumn('services', $field);
            }
        }

        $fields = [
            'hero_kicker',
            'hero_primary_label',
            'hero_primary_url',
            'hero_secondary_label',
            'hero_secondary_url',
            'about_label',
            'services_label',
            'gallery_title',
            'gallery_intro',
            'gallery_label',
            'video_title',
            'video_caption',
            'video_enabled',
            'location_title',
            'location_intro',
            'location_label',
            'footer_description',
            'instagram_url',
            'facebook_url',
            'maps_url',
            'email',
        ];

        foreach ($fields as $field) {
            if ($this->db->fieldExists($field, 'site_settings')) {
                $this->forge->dropColumn('site_settings', $field);
            }
        }
    }
}
