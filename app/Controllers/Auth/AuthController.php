<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{

    // Login Code

    public function login()
    {
        // Tampilkan halaman login
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        
        // Ambil data dari form login
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validasi login
        $model = new UserModel();
        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Jika login berhasil, set session dan redirect ke halaman dashboard atau halaman setelah login
                $session->set([
                    'isLoggedIn' => true,
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    // Tambahkan data sesuai kebutuhan
                ]);
              
                return redirect()->to('/'); // Ganti dengan halaman yang sesuai setelah login
            } else {
               session()->setFlashdata('message', 'user tidak di temukan , periksa lagi inputan anda');
               session()->setFlashdata('alertType', 'error');
               return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('message', 'user tidak di temukan , periksa lagi inputan anda');
            session()->setFlashdata('alertType', 'error');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        // Hapus session dan redirect ke halaman login
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }







    // Registrasi Code

    public function register()
    {
        // Tampilkan halaman registrasi
        return view('auth/register');
    }

    public function processRegister()
    {
        // Ambil data dari form registrasi
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validasi data
        $validationRules = [
            'username' => 'required|min_length[6]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, kembalikan ke halaman registrasi dengan pesan error
            session()->setFlashdata('message', implode($this->validator->getErrors()));
            session()->setFlashdata('alertType', 'error');
            return redirect()->back();
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data ke database
        $model = new UserModel();
        $model->save([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            // Tambahkan field lain jika diperlukan
        ]);

        // Redirect ke halaman login dengan pesan sukses
        session()->setFlashdata('message', 'Berhasil Buat Data User');
        session()->setFlashdata('alertType', 'success');
        return redirect()->back();
    }

}
