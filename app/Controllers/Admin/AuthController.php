<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;

class AuthController extends BaseAdminController
{
    private const ADMIN_IDLE_TIMEOUT = 900;

    public function login()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login', [
            'loginAction' => current_url(),
            'isHiddenEntry' => uri_string() === 'gerbang-senja-bumiharjo',
        ]);
    }

    public function attemptLogin()
    {
        if (! $this->validate([
            'login'    => 'required',
            'password' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Email/username dan password wajib diisi.');
        }

        $login = trim((string) $this->request->getPost('login'));
        $password = (string) $this->request->getPost('password');

        $user = (new UserModel())
            ->groupStart()
            ->where('email', $login)
            ->orWhere('username', $login)
            ->groupEnd()
            ->where('is_active', 1)
            ->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Login tidak valid.');
        }

        session()->set([
            'admin_logged_in' => true,
            'admin_id'        => $user['id'],
            'admin_name'      => $user['name'],
            'admin_email'     => $user['email'],
            'admin_last_activity' => time(),
        ]);

        (new UserModel())->update($user['id'], ['last_login_at' => date('Y-m-d H:i:s')]);

        return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang kembali.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/admin/login')->with('success', 'Anda berhasil logout.');
    }

    public function logoutBeacon()
    {
        if (session()->get('admin_logged_in')) {
            session()->destroy();
        }

        return $this->response->setStatusCode(204);
    }
}
