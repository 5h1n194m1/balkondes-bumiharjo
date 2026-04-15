<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

final class PublicRoutesTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $refresh = true;
    protected $namespace = 'App';
    protected $seed = \App\Database\Seeds\DatabaseSeeder::class;
    protected $basePath = APPPATH . 'Database';

    public function testBookingPageLoads(): void
    {
        $result = $this->get('/booking');

        $result->assertStatus(200);
        $result->assertSee('Official Booking Hub');
        $result->assertSee('Kembali ke Beranda');
    }

    public function testHiddenAdminEntryLoads(): void
    {
        $result = $this->get('/gerbang-senja-bumiharjo');

        $result->assertStatus(200);
        $result->assertSee('Portal Kontrol Balkondes');
        $result->assertSee('Akses tersembunyi aktif');
    }
}
