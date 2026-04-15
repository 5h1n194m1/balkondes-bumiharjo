<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    private const ADMIN_IDLE_TIMEOUT = 900;

    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $lastActivity = (int) (session()->get('admin_last_activity') ?? 0);

        if ($lastActivity > 0 && (time() - $lastActivity) > self::ADMIN_IDLE_TIMEOUT) {
            session()->destroy();

            return redirect()->to('/admin/login')->with('error', 'Sesi admin berakhir karena tidak ada aktivitas.');
        }

        session()->set('admin_last_activity', time());

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
