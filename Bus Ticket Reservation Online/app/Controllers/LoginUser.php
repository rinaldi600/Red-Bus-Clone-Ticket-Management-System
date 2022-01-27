<?php

namespace App\Controllers;

class LoginUser extends BaseController
{

    private $validation;
    private $userModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userModel = new \App\Models\UserModel();
        $this->validation->setRules([
            'usernameOrEmail' => [
                'label'  => 'Username atau Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Inputan {field} tidak boleh kosong',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required|alpha_numeric|max_length[20]|min_length[8]',
                'errors' => [
                    'required' => 'Inputan {field} tidak boleh kosong',
                    'alpha_numeric' => 'Inputan {field} harus mengandung huruf dan angka',
                    'max_length' => 'Inputan {field} maksimal 20 characters',
                    'min_length' => 'Inputan {field} minimal 8 characters',
                ],
            ],
        ]);
    }

    public function index()
    {
        $data = [
            'title' => 'Login User'
        ];

       return view("LoginUser/LoginView", $data);
    }

    public function login() {
        if ($this->validation->withRequest($this->request)->run()) {
            $usernameOrEmail = $this->request->getPost('usernameOrEmail', FILTER_SANITIZE_STRING);
            $password = $this->request->getPost('password');

            if ($this->userModel->where('username', $usernameOrEmail)->orWhere('email', $usernameOrEmail)->first()) {
                $detailUser = $this->userModel->where('username', $usernameOrEmail)->orWhere('email', $usernameOrEmail)->first();
                $passwordVerify = password_verify($password, $detailUser['password']);

                if ($passwordVerify) {
                    session()->set('idUser', $detailUser['idUser']);
                    return redirect()->to('/tiket');
                } else {
                    session()->setFlashdata('passwordFailed','Password Salah');
                }
            } else {
                session()->setFlashdata('notFound','Username / Email belum terdaftar');
            }
        } else {
            session()->setFlashdata([
               'usernameOrEmail' => $this->validation->getError('usernameOrEmail'),
               'password' => $this->validation->getError('password'),
            ]);
        }

        return redirect()->back()->withInput();
    }
}
