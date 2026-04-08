<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingLinkModel extends Model
{
    protected $table            = 'booking_links';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'group_key',
        'label',
        'description',
        'url',
        'sort_order',
        'is_active',
    ];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected $useTimestamps          = true;
    protected $createdField           = 'created_at';
    protected $updatedField           = 'updated_at';
}
