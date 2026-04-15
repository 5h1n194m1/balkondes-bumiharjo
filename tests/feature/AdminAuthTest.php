<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

final class AdminAuthTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $refresh = true;
    protected $namespace = 'App';
    protected $seed = \App\Database\Seeds\DatabaseSeeder::class;
    protected $basePath = APPPATH . 'Database';

    public function testAdminLoginPageLoads(): void
    {
        $result = $this->get('/admin/login');

        $result->assertStatus(200);
        $result->assertSee('Admin web-balkondes');
    }

    public function testAdminCanLoginWithSeededCredentials(): void
    {
        $result = $this->post('/admin/login', [
            'login' => 'admin@web-balkondes.test',
            'password' => 'Admin123!',
        ]);

        $result->assertRedirectTo(site_url('admin/dashboard'));
    }

    public function testLogoutBeaconDestroysAdminSession(): void
    {
        $result = $this->withSession([
            'admin_logged_in' => true,
            'admin_id' => 1,
            'admin_name' => 'Admin Web Balkondes',
            'admin_email' => 'admin@web-balkondes.test',
            'admin_last_activity' => time(),
        ])->post('/admin/logout-beacon');

        $result->assertStatus(204);
    }

    public function testIdleAdminSessionIsRedirectedToLogin(): void
    {
        $expiredTimestamp = time() - 901;

        $result = $this->withSession([
            'admin_logged_in' => true,
            'admin_id' => 1,
            'admin_name' => 'Admin Web Balkondes',
            'admin_email' => 'admin@web-balkondes.test',
            'admin_last_activity' => $expiredTimestamp,
        ])->get('/admin/dashboard');

        $result->assertRedirectTo(site_url('admin/login'));
    }
}
