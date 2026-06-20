<?php
namespace App\Controllers;
class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function prosesLogin()
    {
        $session = session();
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $email    = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        $user = $builder->where('email', $email)->get()->getRow();

        if ($user && (string) $password === (string) trim($user->password)) {
            $session->set('login', true);
            $session->set('username', $user->username);
            $session->set('role', $user->role);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Email atau password salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}