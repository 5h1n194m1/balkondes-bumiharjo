<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingModel extends Model
{
    protected $table            = 'site_settings';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'company_name',
        'hero_kicker',
        'hero_headline',
        'hero_subheadline',
        'hero_primary_label',
        'hero_primary_url',
        'hero_secondary_label',
        'hero_secondary_url',
        'about_title',
        'about_label',
        'about_content',
        'services_title',
        'services_label',
        'services_intro',
        'gallery_title',
        'gallery_intro',
        'gallery_label',
        'video_title',
        'video_caption',
        'video_path',
        'video_url',
        'video_enabled',
        'footer_title',
        'footer_description',
        'address',
        'location_title',
        'location_intro',
        'location_label',
        'maps_embed_url',
        'opening_hours',
        'whatsapp_number',
        'whatsapp_message',
        'instagram_url',
        'facebook_url',
        'maps_url',
        'email',
    ];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected $useTimestamps          = true;
    protected $createdField           = 'created_at';
    protected $updatedField           = 'updated_at';
}
